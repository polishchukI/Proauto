<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;

use Carbon\Carbon;

use PDF;

use App\Models\Client\Client;

use App\Models\Inventory\Currency;
use App\Models\Inventory\Warehouse;
use App\Models\Inventory\Provider;
use App\Models\Inventory\ClientOrder;
use App\Models\Inventory\PaymentMethod;
use App\Models\Inventory\Transaction;

use App\Models\Product\Product;
use App\Models\Product\ProductClientOrder;
use App\Models\Product\ProductPrice;
use App\Models\Product\ProductGroup;
use App\Models\Product\ProductStock;
use App\Models\Product\ProductAdminCart;

use Picqer\Barcode\BarcodeGeneratorHTML;

use App\Models\OrderControl\ProductClientOrderControl;

use App\Http\Controllers\Inventory\AddProductController;
use App\Http\Controllers\FunctionsController as Functions;

use Illuminate\Http\Request;

class ClientOrdersController extends Controller
{
    public function index()
    {
        $client_orders = ClientOrder::paginate(25);

        return view('inventory.client_orders.index', compact('client_orders'));
    }

    public function create()
    {
        $warehouses			= Warehouse::all();
        $currencies			= Currency::where('active','=',1)->get();

        return view('inventory.client_orders.create', compact('warehouses','currencies'));
    }
	
	public function store(Request $request, ClientOrder $client_order)
    {
        $requesteddata = $request->all();
        $requesteddata['client_id'] = $request->clientLive ?? $request->client_id;


        if(array_key_exists('reference_type', $requesteddata) && array_key_exists('reference_id', $requesteddata))
		{
			if($requesteddata['reference_type'] == "admincart")
			{
				$reference_order_products = ProductAdminCart::where('admincart_id','=',$request->get('reference_id'))->get()->toArray();
			}
            // if($requesteddata['reference_type']=="online_client_order")
			// {
				// $reference_order_products = ProductOnlineOrder::where('online_order_id','=',$request->get('reference_id'))->get()->toArray();
			// }
		}
		else
		{
            $existent = ClientOrder::where('client_id', $requesteddata['client_id'])->where('finalized_at', null)->get();
            if($existent->count())
            {
                return back()->withError('There is already an unfinished client_order belonging to this client. <a href="'.route('client_orders.show', $existent->first()).'">Click here to go to it</a>');
            }
        }
		
		$created_at					= Carbon::now();
		$dateprefix					= $created_at->format('Y m d');
		$code_6						= sprintf("%06s",(string)$request->clientLive);
		$timeStamp					= Functions::GenerateTimestamp();
		$requesteddata['barcode']		= "" . $dateprefix . " " . $timeStamp . " " . $code_6 ."";

		$client_order = $client_order->create($requesteddata);
   
		if(isset($reference_order_products))
		{
			foreach($reference_order_products as $product)
			{
				ProductClientOrder::insert(['client_order_id' => $client_order->id,
                            'product_id' => $product['product_id'],
                            'currency' => $client_order->currency,
                            'price' => $product['price'],
                            'total_amount' => $product['total_amount'],
                            'warehouse_id' => $client_order->warehouse_id,
                            'quantity' => $product['quantity']]);
			}
		}
        
        return redirect()->route('client_orders.show', ['client_order' => $client_order->id])->withStatus('ClientOrder registered successfully, you can start registering products and transactions.');
    }
	
	public function show(ClientOrder $client_order)
    {
		$docHeaderValues = $this->docHeaderValues($client_order);

		$client_order->docCount						= $docHeaderValues['docCount'];
		$client_order->docTotal						= $docHeaderValues['docTotal'];
		$client_order->docQuantity					= $docHeaderValues['docQuantity'];

        return view('inventory.client_orders.show', compact('client_order'));
    }
	
	public function destroy(ClientOrder $client_order)
    {
		ProductClientOrder::where('client_order_id','=',$client_order->id)->delete();
		$client_order->delete();

        return redirect()->route('client_orders.index')->withStatus('The ClientOrder record has been successfully deleted.');
    }

    public function finalize(ClientOrder $client_order)
    {
        //Client orders control start
        $doc_type               = "client_order";
        $doc_id                 = $client_order->id;
        $client_id              = $client_order->client_id;
        $warehouse_id           = $client_order->warehouse_id;

		$productstable          = ProductClientOrder::where('client_order_id','=',$doc_id)->get();

        //reerase product for no doubles
        ProductClientOrderControl::where('doc_type','=',$doc_type)->where('doc_id','=',$doc_id)->delete();

        foreach($productstable as $product_item)
        {
            $product_id         = $product_item['product_id'];
            $quantity           = $product_item['quantity'];
            $order_uid          = md5($client_id . $product_id . $doc_type . $doc_id);

            ProductClientOrderControl::insert(['order_uid'				=> $order_uid,
											'doc_type'					=> $doc_type,
											'doc_id'					=> $doc_id,
											'product_id'				=> $product_id,
											'client_id'					=> $client_id,
											'warehouse_id'				=> $warehouse_id,
											'quantity'					=> $quantity,
											'created_at'				=> Carbon::now(),
										]);

        }
        //Client orders control finish

		$client_order->quantity         = $productstable->sum('quantity');
		$client_order->total_amount     = $productstable->sum('total_amount');
		$client_order->finalized_at     = Carbon::now()->toDateTimeString();
        $client_order->save();

        return back()->withStatus('The client_order has been successfully completed.');
    }

    //client_order_add_single_product_store
    public static function client_order_add_single_product_store(Request $request)
	{
		//request data
		$product_id						= $request->productLive;
		$client_order_id				= $request->client_order_id;
		$price							= floatval($request->price);//????
		$quantity						= $request->quantity;

		//additional data
		$client_order					= ClientOrder::findOrFail($client_order_id);
		$product						= Product::findOrFail($product_id);
		$warehouse_id					= $client_order->warehouse_id;
		$stock							= AddProductController::get_product_stocks($product_id);
		$currency						= $client_order->currency;
		$price							= ($price !=0) ? $price : AddProductController::get_product_price($product_id, 'out', $currency);
		$total_amount					= $price * $quantity;
		$created_at						= Carbon::now();

		//writing into recieved_products table
		$requesteddata['client_order_id']		= $client_order_id;
		$requesteddata['currency']				= $currency;
		$requesteddata['warehouse_id']			= $warehouse_id;
		$requesteddata['product_id']			= $product_id;
		$requesteddata['price']					= $price;
		$requesteddata['quantity']				= $quantity;
		$requesteddata['total_amount']			= $total_amount;
		$requesteddata['created_at']			= $created_at;
		
		ProductClientOrder::create($requesteddata);

		$docHeaderValues = self::docHeaderValues($client_order);

		return response()->json([
			'status'  => 1 , 
			'message' => ['Товар добавлен', 'success'],
			'docHeaderValues'		=> $docHeaderValues,
			'info'    => [
				'product_id'		=> $product_id,
				'client_order_id'	=> $client_order_id,
				'article'			=> $product->article,
				'brand'				=> $product->brand,
				'name'				=> $product->name,
				'quantity'			=> $quantity,
				'stock'				=> $stock,
				'price'				=> $price,
				'total_amount'		=> $total_amount,
				'created_at'		=> $created_at,

			],
		]);
    }
	public function client_order_product_selector (Request $request, ClientOrder $client_order, ProductClientOrder $product)
    {
        $root_id = 10001;
        $treejs = '';
        $this->getTreeJS($root_id, $treejs);
        $treeJS = $treejs;

        return view('inventory.client_orders.addproduct_table', compact('client_order', 'treeJS'));
    }

    public static function client_order_add_product(Request $request)
	{
		$edit = "false";
		$product_id						= $request->product_id;
		$client_order_id				= $request->client_order_id;

		$client_order					= ClientOrder::where('id', $client_order_id)->first();		
		$product						= Product::select('products.id as product_id','products.article','products.brand','products.name','products.full_name')
												->orderby('products.article', 'asc')
												->where('products.id','=',$product_id)
												->first()->toarray();
				
		//last price
		$product['price']				= AddProductController::get_product_price($product_id, 'in', $client_order->currency);
		$product['client_order_id']		= $client_order_id;

		return view('inventory.client_orders.addproduct_modal', compact('product','edit'));
	}

	public static function client_order_add_product_store(Request $request)
	{
		//request data
		$product_id						= $request->product_id;
		$client_order_id				= $request->client_order_id;
		$price							= floatval($request->price);//????
		$quantity						= $request->quantity;

		//additional data
		$client_order						= ClientOrder::findOrFail($client_order_id);
		$product						= Product::findOrFail($product_id);
		$warehouse_id					= $client_order->warehouse_id;
		$stock							= AddProductController::get_product_stocks($product_id);
		$currency						= $client_order->currency;
		$price							= ($price !=0) ? $price : AddProductController::get_product_price($product_id, 'in', $currency);
		$total_amount					= $price * $quantity;
		$created_at						= Carbon::now();


		//writing into recieved_products table
		$requesteddata['client_order_id']	= $client_order_id;
		$requesteddata['currency']			= $currency;
		$requesteddata['warehouse_id']		= $warehouse_id;
		$requesteddata['product_id']		= $product_id;
		$requesteddata['price']				= $price;
		$requesteddata['quantity']			= $quantity;
		$requesteddata['total_amount']		= $total_amount;
		$requesteddata['created_at']		= $created_at;
		
		ProductClientOrder::create($requesteddata);

		$docHeaderValues = self::docHeaderValues($client_order);

		return response()->json([
			'status'  => 1 , 
			'message' => ['Товар добавлен', 'success'],
			'docHeaderValues'		=> $docHeaderValues,
			'info'    => [
				'product_id'		=> $product_id,
				'client_order_id'	=> $client_order_id,
				'article'			=> $product->article,
				'brand'				=> $product->brand,
				'name'				=> $product->name,
				'quantity'			=> $quantity,
				'stock'				=> $stock,
				'price'				=> $price,
				'total_amount'		=> $total_amount,
				'created_at'		=> $created_at,

			],
		]);
    }

	public function client_order_edit_product(Request $request)
    {
		$edit = "true";
		$client_order_id = $request->client_order_id;
		$product_id = $request->product_id;
		
		$product = ProductClientOrder::select('product_client_orders.quantity','product_client_orders.price','product_client_orders.client_order_id','products.id as product_id','products.article','products.brand','products.name','products.full_name')
		->where('product_id','=',$product_id)
		->join('products', 'products.id', '=', 'product_client_orders.product_id')
		->where('client_order_id','=',$client_order_id)
		->first();
		if($client_order_id)
		{
			$product = $product->toarray();
		}
		
		return view('inventory.client_orders.addproduct_modal', compact('product','edit'));
    }
	

	public function client_order_update_product_store(Request $request)
	{
		$product_id						= $request->product_id;
		$client_order_id						= $request->client_order_id;
		$price							= floatval($request->price);//????
		$quantity						= $request->quantity;

		$item = ProductClientOrder::where('client_order_id','=',$client_order_id)->where('product_id','=',$product_id)->get()->first();

		if ($item)
		{
            $old_price    = $item->price;
            $old_quantity = $item->quantity;
            $new_price    = $request->price;
            $new_quantity = $request->quantity;
            $new_total_amount = $new_price * $new_quantity;

            if ($old_price != $new_price || $old_quantity != $new_quantity)
			{
                $client_order = ClientOrder::find($client_order_id);
                if ($client_order) {
                    $item = $item->update([
                        'price' => $new_price,
                        'quantity' => $new_quantity,
                        'total_amount' => $new_total_amount,
                    ]);

					if ($item)
					{
						$docHeaderValues = self::docHeaderValues($client_order);

						return response()->json([
							'status'  => 1 , 
							'message' => ['Товар добавлен', 'success'],
							'docHeaderValues'		=> $docHeaderValues,
                            'info'    => [
                                    'product_id'    => $product_id,
                                    'price'			=> $new_price,
                                    'quantity'		=> $new_quantity,
                                    'total_amount'	=> $new_total_amount,
                            ],
                        ]);
                    }
                    $error_message = 'Ошибка обновления услуги';
                }
                $error_message = 'Неверный номер заказа';
            }
            $error_message = 'Вы не изменили значения';
        }
	}
    
	public function clear_products_table(ClientOrder $client_order, ProductClientOrder $receivedproduct)
    {
		ProductClientOrder::where('client_order_id','=',$client_order->id)->delete();
		return back()->withStatus('Products table cleared.');
    }
	
	public function client_order_delete_product(Request $request)
    {
		if (!$request->ajax()) {
			abort('404');
		};

		$product_id						= (int)$request->product_id;
		$client_order_id						= (int)$request->client_order_id;

		$item = ProductClientOrder::where('client_order_id','=',$client_order_id)->where('product_id','=',$product_id)->get()->first();
		
		if ($item) {
			$old_price    = $item->price;
			$old_quantity = $item->quantity;

			$client_order = ClientOrder::find($client_order_id);
			if ($client_order)
			{
				$item = $item->delete();
				
				$docHeaderValues = self::docHeaderValues($client_order);

				return response()->json([
					'status'  => 1 , 
					'message' => ['Товар добавлен', 'success'],
					'docHeaderValues'		=> $docHeaderValues,
					'info'    => [
							'product_id'    => $product_id,
						],
					]);
			}
		}
    }

    public function addtransaction(ClientOrder $client_order)
    {
        $payment_methods = PaymentMethod::all();

        return view('inventory.client_orders.addtransaction', compact('client_order', 'payment_methods'));
    }
	
	public function order_to_provider(ClientOrder $client_order)
    {
		$providers		= Provider::where('active','=','1')->get();
        $warehouses		= Warehouse::all();
        $currencies		= Currency::where('active','=',1)->get();

        return view('inventory.to_provider_orders.create', compact('client_order', 'providers','warehouses','currencies'));
    }
	
	public function client_order_sale(Request $request, ClientOrder $client_order)
    {
        $client_order_id = $request->client_order_id;
        
        $client_order = ClientOrder::where('id','=',$client_order_id)->first();

		return view('inventory.sales.modal_create', compact('client_order'));
    }

    public function storetransaction(Request $request, ClientOrder $client_order, Transaction $transaction)
    {
        switch($request->all()['type'])
		{
            case 'income':
                $request->merge(['title' => 'Payment Received from ClientOrder id: ' . $request->get('client_order_id')]);
                break;

            case 'expense':
                $request->merge(['title' => 'Client Order Return Payment id: ' . $request->all('client_order_id')]);

                if($request->get('amount') > 0)
				{
                    $request->merge(['amount' => (float) $request->get('amount') * (-1) ]);
                }
                break;
        }

        $transaction->create($request->all());
		
		$client = Client::find($request->get('client_id'));
		$client->balance += $request->get('amount');
		$client->save();

        return redirect()
            ->route('client_orders.show', compact('client_order'))
            ->withStatus('Successfully registered transaction.');
    }

    public function edittransaction(ClientOrder $client_order, Transaction $transaction)
    {
        $payment_methods = PaymentMethod::all();

        return view('inventory.client_orders.edittransaction', compact('client_order', 'transaction', 'payment_methods'));
    }

    public function updatetransaction(Request $request, ClientOrder $client_order, Transaction $transaction)
    {
        switch($request->get('type')) {
            case 'income':
                $request->merge(['title' => 'Payment Received from ClientOrder id: '. $request->get('client_order_id')]);
                break;

            case 'expense':
                $request->merge(['title' => 'ClientOrder Return Payment id: '. $request->get('client_order_id')]);

                if($request->get('amount') > 0) {
                    $request->merge(['amount' => (float) $request->get('amount') * (-1)]);
                }
                break;
        }
        $transaction->update($request->all());

        return redirect()
            ->route('client_orders.show', compact('client_order'))
            ->withStatus('Successfully modified transaction.');
    }

    public function destroytransaction(ClientOrder $client_order, Transaction $transaction)
    {
        $transaction->delete();

        return back()->withStatus('Transaction deleted successfully.');
    }

	public function print(ClientOrder $client_order)
    {
		$products = ProductClientOrder::select('products.article',
							'products.brand',
							'products.name',
							'product_client_orders.quantity',
							'product_client_orders.price',
							'product_client_orders.total_amount as total')
				->leftjoin('products','products.id','=','product_client_orders.product_id')
				->where('product_client_orders.client_order_id','=',$client_order->id)->get();
				
				$client_order["subtotal"] = $products->sum('total');
                $client_order["tax"] = 0;
                $client_order["total_amount"] = $client_order["subtotal"]+$client_order["tax"];
		
		$client =  Client::where('id','=', $client_order->client_id)->first()->toArray();
		
		$generator = new BarcodeGeneratorHTML();
        $barcode = $generator->getBarcode((string)$client_order->barcode, $generator::TYPE_CODE_128, 1, 25);

        $pdf = PDF::loadView('inventory.pdf.client_order', compact('client_order', 'products', 'client', 'billingaddress', 'shippingaddress','barcode'));
        $file_name = "client_order - " . $client_order->id . ".pdf";
        return $pdf->stream($file_name)->header('Content-Type','application/pdf');
    }

    private function getTreeJS($root_id, &$treejs)
    {
        
        $groups = ProductGroup::where('parent_id', $root_id)->get();
        
        $treejs .= '[';
        foreach($groups as $group)
        {
            $treejs .= '{';
                $treejs .= '"dbid":"' . $group->id . '",';
                $treejs .= '"text":"' . $group->name . '[' . $group->id . ']",';
                $treejs .= '"children":';
                
            $treejs .= $this->getTreeJS($group->id, $treejs);
            $treejs .= '},';
        }
        $treejs .= ']';
    }

	public function client_order_products_filter_by_group(Request $request)
    {
		$data = '';
		$product_group_id = $request->selected_group;
		if($product_group_id == '10002')
		{
			$q = Product::select('id','article','brand','name')->get();
		}
		else
		{
			$q = Product::select('id','article','brand','name')->where('product_group_id','=',$product_group_id)->get();
		}	
		
		if($q)
		{
			foreach($q as $product)
			{
				$product->price = AddProductController::get_product_price($product->id, 'out', auth()->user()->default_currency);
				$product->stock = AddProductController::get_product_stocks($product->id, auth()->user()->default_warehouse_id);
			}
			$data = $q->toArray();
		}
		return response()->json($data);
    }

	public static function docHeaderValues(ClientOrder $client_order)
	{
		$docHeaderValues = [];

		$docCount				= 0;
		$docTotal				= 0;
		$docQuantity			= 0;

		$docTotalRequest = ProductClientOrder::where('client_order_id','=',$client_order->id)->get();
		
		$docHeaderValues['docCount']					= $docTotalRequest->count();
		$docHeaderValues['docQuantity']					= $docTotalRequest->sum('quantity');
		$docHeaderValues['docTotal']					= $docTotalRequest->sum('total_amount');
		
		return $docHeaderValues;
	}

}

