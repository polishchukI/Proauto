<?php

namespace App\Http\Controllers\Inventory;

use PDF;

use Carbon\Carbon;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\Inventory\Provider;
use App\Models\Inventory\Currency;
use App\Models\Inventory\Warehouse;
use App\Models\Product\Product;
use App\Models\Product\ProductToProviderOrder;
use App\Models\Product\ProductPrice;
use App\Models\Product\ProductStock;
use App\Models\Product\ProductGroup;
use App\Models\Product\ProductClientOrder;
use App\Models\Product\ProductClientToProviderOrder;
use App\Models\Inventory\InventorySetting;

use App\Models\Inventory\ToProviderOrder;
use App\Models\Inventory\PaymentMethod;
use App\Models\Inventory\Transaction;

use App\Models\OrderControl\ProductClientOrderControl;
use App\Models\OrderControl\ProductToProviderOrderControl;
use App\Models\OrderControl\ProductClientToProviderOrderControl;

use App\Http\Controllers\FunctionsController as Functions;

use Picqer\Barcode\BarcodeGeneratorHTML;

class ToProviderOrdersController extends Controller
{
    public function index()
    {
        $to_provider_orders = ToProviderOrder::paginate(25);

        return view('inventory.to_provider_orders.index', compact('to_provider_orders'));
    }

    public function create(Request $request)
    {

        $providers			= Provider::where('active','=','1')->get();
        $warehouses			= Warehouse::all();
        $currencies			= Currency::where('active','=','1')->get();

        return view('inventory.to_provider_orders.create', compact('providers','warehouses','currencies'));
    }
	
	public function store(Request $request, ToProviderOrder $to_provider_order)
    {
		$requestData = $request->all();

		if(array_key_exists('reference_type', $requestData) && array_key_exists('reference_id', $requestData))
		{
			if($requestData['reference_type']=="client_order")
			{
				$reference_order_products = ProductClientOrder::where('client_order_id','=',$request->get('reference_id'))->get()->toArray();
			}
		}
		else
		{
			$existent = ToProviderOrder::where('provider_id', $request->get('provider_id'))->where('finalized_at', null)->get();
			if($existent->count())
			{
				return back()->withError('Существует не проведеный документ "Заказ поставщику" для данного поставщика. <a href="'.route('to_provider_orders.show', $existent->first()).'">Нажмите для перехода</a>');
			}
		}
		
		$created_at					= Carbon::now();
		$dateprefix					= $created_at->format('Y m d');
		$code_6						= sprintf("%06s",(string)$request->provider_id);
		$timeStamp					= Functions::GenerateTimestamp();
		$requestData['barcode']		= "" . $dateprefix . " " . $timeStamp . " " . $code_6 ."";
		
		$to_provider_order = $to_provider_order->create($requestData);
		if(isset($reference_order_products))
		{
			foreach($reference_order_products as $product)
			{
				$product_price = AddProductController::get_product_price($product['product_id'], 'in', $to_provider_order['currency']);

				ProductToProviderOrder::insert(['to_provider_order_id'		=> $to_provider_order->id,
                            				'product_id'					=> $product['product_id'],
											'currency'						=> $to_provider_order['currency'],
											'price'							=> $product_price,
											'client_ordered'				=> "true",
											'warehouse_id'					=> $to_provider_order->warehouse_id,
											'quantity'						=> $product['quantity'],
											'total_amount'					=> $product['quantity'] * $product_price,
											'created_at'					=> Carbon::now(),
										]);
				
				//test - client to provider order
				ProductClientToProviderOrder::insert(['to_provider_order_id'	=> $to_provider_order->id,
													'product_id'				=> $product['product_id'],
													'client_order_id'			=> $request->get('reference_id'),
													'quantity'					=> $product['quantity'],
													'created_at'				=> Carbon::now(),
												]);
			}
		}

        return redirect()->route('to_provider_orders.show', ['to_provider_order' => $to_provider_order->id])->withStatus('Документ "Заказ поставщику" зарегистрирован');
    }
	
	public function show(ToProviderOrder $to_provider_order)
    {
		$docHeaderValues = $this->docHeaderValues($to_provider_order);

		$to_provider_order->docCount						= $docHeaderValues['docCount'];
		$to_provider_order->docTotal						= $docHeaderValues['docTotal'];
		$to_provider_order->docQuantity						= $docHeaderValues['docQuantity'];

        return view('inventory.to_provider_orders.show', compact('to_provider_order'));
    }
	
	public function destroy(ToProviderOrder $to_provider_order)
    {
		ProductToProviderOrder::where('to_provider_order_id','=',$to_provider_order->id)->delete();
        $to_provider_order->delete();

        return redirect()->route('to_provider_orders.index')->withStatus('Документ "Заказ поставщику" удален');
    }

    public function unfinalize(ToProviderOrder $to_provider_order)
	{
		$to_provider_order->finalized_at = null;
        $to_provider_order->save();

        return back()->withStatus('Отменено проведение документа "Заказ поставщику"');
	}

    public function finalize(ToProviderOrder $to_provider_order)
    {
        //Client orders control start
        $doc_type               = "to_provider_order";
        $doc_id                 = $to_provider_order->id;
        $provider_id            = $to_provider_order->provider_id;
        $warehouse_id           = $to_provider_order->warehouse_id;

		$productstable = ProductToProviderOrder::where('to_provider_order_id','=',$to_provider_order->id)->get();

        //reerase product for no doubles
        ProductToProviderOrderControl::where('doc_type','=',$doc_type)->where('doc_id','=',$doc_id)->delete();

        foreach($productstable as $product_item)
        {
            $product_id         = $product_item['product_id'];
            $quantity           = $product_item['quantity'];
            $order_uid          = md5($provider_id . $product_id . $doc_type . $doc_id);

            ProductToProviderOrderControl::insert(['order_uid'       => $order_uid,
											'doc_type'          => $doc_type,
											'doc_id'            => $doc_id,
											'product_id'        => $product_id,
											'provider_id'       => $provider_id,
											'warehouse_id'      => $warehouse_id,
											'quantity'          => $quantity,
											'created_at'		=> Carbon::now(),
										]);
		}

		$to_provider_order->total_quantity = $productstable->sum('quantity');
		$to_provider_order->total_amount = $productstable->sum('total_amount');
		$to_provider_order->finalized_at = Carbon::now()->toDateTimeString();
        $to_provider_order->save();

        return back()->withStatus('Документ "Заказ поставщику" проведен');
    }
	
	public static function to_provider_order_add_single_product_store(Request $request)
	{
		//request data
		$product_id						= $request->productLive;
		$client_order_id				= $request->client_order_id;
		$to_provider_order_id			= $request->to_provider_order_id;
		$price							= floatval($request->price);//????
		$quantity						= $request->quantity;

		//additional data
		$to_provider_order				= ToProviderOrder::findOrFail($to_provider_order_id);
		$product						= Product::findOrFail($product_id);
		$warehouse_id					= $to_provider_order->warehouse_id;
		$stock							= AddProductController::get_product_stocks($product_id, auth()->user()->default_warehouse_id);
		$currency						= $to_provider_order->currency;
		$price							= ($price !=0) ? $price : AddProductController::get_product_price($product_id, 'in', $currency);
		$total_amount					= $price * $quantity;
		$created_at						= Carbon::now();


		//writing into recieved_products table
		$requesteddata['to_provider_order_id']		= $to_provider_order_id;
		$requesteddata['client_order_id']			= $client_order_id;
		$requesteddata['currency']					= $currency;
		$requesteddata['warehouse_id']				= $warehouse_id;
		$requesteddata['product_id']				= $product_id;
		$requesteddata['price']						= $price;
		$requesteddata['quantity']					= $quantity;
		$requesteddata['total_amount']				= $total_amount;
		$requesteddata['created_at']				= $created_at;
		
		ProductToProviderOrder::create($requesteddata);

		$docHeaderValues = self::docHeaderValues($to_provider_order);

		return response()->json([
			'status'  => 1 , 
			'message' => ['Товар добавлен', 'success'],
			'docHeaderValues'				=> $docHeaderValues,
			'info'    => [
				'product_id'				=> $product_id,
				'client_order_id'			=> $client_order_id,
				'to_provider_order_id'		=> $to_provider_order_id,
				'article'					=> $product->article,
				'brand'						=> $product->brand,
				'name'						=> $product->name,
				'quantity'					=> $quantity,
				'stock'						=> $stock,
				'price'						=> $price,
				'total_amount'				=> $total_amount,
				'created_at'				=> $created_at,
			],
		]);
    }

	public function to_provider_order_product_selector (Request $request, ToProviderOrder $to_provider_order, ProductToProviderOrder $product)
    {
		$docHeaderValues = $this->docHeaderValues($to_provider_order);

		$to_provider_order->docCount						= $docHeaderValues['docCount'];
		$to_provider_order->docTotal						= $docHeaderValues['docTotal'];
		$to_provider_order->docQuantity						= $docHeaderValues['docQuantity'];

        $root_id = 10001;
        $treejs = '';
        $this->getTreeJS($root_id, $treejs);
        $treeJS = $treejs;

        return view('inventory.to_provider_orders.addproduct_table', compact('to_provider_order', 'treeJS'));
    }

    public static function to_provider_order_add_product(Request $request)
	{
		$edit = "false";
		$product_id						= $request->product_id;
		$to_provider_order_id			= $request->to_provider_order_id;

		$to_provider_order				= ToProviderOrder::where('id', $to_provider_order_id)->first();		
		$product						= Product::select('products.id as product_id','products.article','products.brand','products.name','products.full_name')
												->orderby('products.article', 'asc')
												->where('products.id','=',$product_id)
												->first()->toarray();
				
		//last price
		$product['price']						= AddProductController::get_product_price($product_id, 'in', $to_provider_order->currency);
		$product['to_provider_order_id']		= $to_provider_order_id;

		return view('inventory.to_provider_orders.addproduct_modal', compact('product','edit'));
	}

	public static function to_provider_order_add_product_store(Request $request)
	{
		//request data
		$product_id						= $request->product_id;
		$client_order_id				= $request->client_order_id;
		$to_provider_order_id			= $request->to_provider_order_id;
		$price							= floatval($request->price);//????
		$quantity						= $request->quantity;

		//additional data
		$to_provider_order				= ToProviderOrder::findOrFail($to_provider_order_id);
		$product						= Product::findOrFail($product_id);
		$warehouse_id					= $to_provider_order->warehouse_id;
		$stock							= AddProductController::get_product_stocks($product_id, auth()->user()->default_warehouse_id);
		$currency						= $to_provider_order->currency;
		$price							= ($price !=0) ? $price : AddProductController::get_product_price($product_id, 'in', $currency);
		$total_amount					= $price * $quantity;
		$created_at						= Carbon::now();

		//writing into recieved_products table
		$requesteddata['to_provider_order_id']		= $to_provider_order_id;
		$requesteddata['client_order_id']			= $client_order_id;
		$requesteddata['currency']					= $currency;
		$requesteddata['warehouse_id']				= $warehouse_id;
		$requesteddata['product_id']				= $product_id;
		$requesteddata['price']						= $price;
		$requesteddata['quantity']					= $quantity;
		$requesteddata['total_amount']				= $total_amount;
		$requesteddata['created_at']				= $created_at;
		
		ProductToProviderOrder::create($requesteddata);

		$docHeaderValues = self::docHeaderValues($to_provider_order);

		return response()->json([
			'status'  => 1 , 
			'message' => ['Товар добавлен', 'success'],
			'docHeaderValues'				=> $docHeaderValues,
			'info'    => [
				'product_id'				=> $product_id,
				'client_order_id'			=> $client_order_id,
				'to_provider_order_id'		=> $to_provider_order_id,
				'article'					=> $product->article,
				'brand'						=> $product->brand,
				'name'						=> $product->name,
				'quantity'					=> $quantity,
				'stock'						=> $stock,
				'price'						=> $price,
				'total_amount'				=> $total_amount,
				'created_at'				=> $created_at,
			],
		]);
    }

	public function to_provider_order_edit_product(Request $request)
    {
		$edit = "true";
		$to_provider_order_id = $request->to_provider_order_id;
		$product_id = $request->product_id;
		
		$product = ProductToProviderOrder::select('product_to_provider_orders.quantity','product_to_provider_orders.price','product_to_provider_orders.to_provider_order_id','products.id as product_id','products.article','products.brand','products.name','products.full_name')
				->where('product_id','=',$product_id)
				->join('products', 'products.id', '=', 'product_to_provider_orders.product_id')
				->where('to_provider_order_id','=',$to_provider_order_id)
				->first();
		if($to_provider_order_id)
		{
			$product = $product->toarray();
		}
		
		return view('inventory.to_provider_orders.addproduct_modal', compact('product','edit'));
    }
	

	public function to_provider_order_update_product_store(Request $request)
	{
		$product_id						= $request->product_id;
		$to_provider_order_id			= $request->to_provider_order_id;
		$price							= floatval($request->price);//????
		$quantity						= $request->quantity;

		$item = ProductToProviderOrder::where('to_provider_order_id','=',$to_provider_order_id)->where('product_id','=',$product_id)->get()->first();

		if ($item)
		{
            $old_price    = $item->price;
            $old_quantity = $item->quantity;
            $new_price    = $request->price;
            $new_quantity = $request->quantity;
            $new_total_amount = $new_price * $new_quantity;

            if ($old_price != $new_price || $old_quantity != $new_quantity)
			{
                $to_provider_order = ToProviderOrder::find($to_provider_order_id);
                if ($to_provider_order)
				{
                    $item = $item->update([
                        'price' => $new_price,
                        'quantity' => $new_quantity,
                        'total_amount' => $new_total_amount,
                    ]);

					if ($item)
					{
						$docHeaderValues = self::docHeaderValues($to_provider_order);

						return response()->json([
							'status'  => 1 , 
							'message' => ['Товар добавлен', 'success'],
							'docHeaderValues'			=> $docHeaderValues,
                            'info'    => [
                                    'product_id'		=> $product_id,
                                    'price'				=> $new_price,
                                    'quantity'			=> $new_quantity,
                                    'total_amount'		=> $new_total_amount,
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
    
	public function clear_products_table(ToProviderOrder $to_provider_order, ProductToProviderOrder $producttoproviderorder)
    {
		ProductToProviderOrder::where('to_provider_order_id','=',$to_provider_order->id)->delete();
		return back()->withStatus('Products table cleared.');
    }
	
	public function to_provider_order_delete_product(Request $request)
    {
		if (!$request->ajax())
		{
			abort('404');
		};

		$product_id						= (int)$request->product_id;
		$to_provider_order_id			= (int)$request->to_provider_order_id;

		$item = ProductToProviderOrder::where('to_provider_order_id','=',$to_provider_order_id)->where('product_id','=',$product_id)->get()->first();
		
		if ($item)
		{
			$old_price    = $item->price;
			$old_quantity = $item->quantity;

			$to_provider_order = ToProviderOrder::find($to_provider_order_id);

			if ($to_provider_order)
			{
				$item = $item->delete();
				$docHeaderValues = self::docHeaderValues($to_provider_order);

				return response()->json([
					'status'  => 1 , 
					'message' => ['Товар добавлен', 'success'],
					'docHeaderValues'			=> $docHeaderValues,
					'info'    => [
							'product_id'		=> $product_id,
						],
					]);
			}
		}
    }

    public function addtransaction(ToProviderOrder $to_provider_order)
    {
        $payment_methods = PaymentMethod::all();

        return view('inventory.to_provider_orders.addtransaction', compact('to_provider_order', 'payment_methods'));
    }

    public function storetransaction(Request $request, ToProviderOrder $to_provider_order, Transaction $transaction)
    {
        switch($request->all()['type'])
        {
            case 'income':
                $request->merge(['title' => 'Оплата по документу "Заказ поставщику" № ' . $request->get('to_provider_order_id')]);
                break;

            case 'expense':
                $request->merge(['title' => 'Возврат оплаты по документу "Заказ поставщику" № ' . $request->all('to_provider_order_id')]);

                if($request->get('amount') > 0) {
                    $request->merge(['amount' => (float) $request->get('amount') * (-1) ]);
                }
                break;
        }

        $transaction->create($request->all());
		
		$provider = Provider::find($request->get('provider_id'));
		$provider->balance += $request->get('amount');
		$provider->save();

        return redirect()
            ->route('to_provider_orders.show', compact('to_provider_order'))
            ->withStatus('Документ "Оплата" создан');
    }

    public function edittransaction(ToProviderOrder $to_provider_order, Transaction $transaction)
    {
        $payment_methods = PaymentMethod::all();

        return view('inventory.to_provider_orders.edittransaction', compact('to_provider_order', 'transaction', 'payment_methods'));
    }

    public function updatetransaction(Request $request, ToProviderOrder $to_provider_order, Transaction $transaction)
    {
        switch($request->get('type'))
		{
            case 'income':
                $request->merge(['title' => 'Оплата по документу "Заказ поставщику" № '. $request->get('to_provider_order_id')]);
                break;

            case 'expense':
                $request->merge(['title' => 'Возврат оплаты по документу "Заказ поставщику" № '. $request->get('to_provider_order_id')]);

                if($request->get('amount') > 0) {
                    $request->merge(['amount' => (float) $request->get('amount') * (-1)]);
                }
                break;
        }
        $transaction->update($request->all());

        return redirect()
            ->route('to_provider_orders.show', compact('to_provider_order'))
            ->withStatus('Документ "Оплата" обновлен');
    }

    public function destroytransaction(ToProviderOrder $to_provider_order, Transaction $transaction)
    {
        $transaction->delete();

        return back()
            ->withStatus('Документ "Оплата" удален');
    }

	public function to_provider_order_receipt(Request $request, ToProviderOrder $to_provider_order)
	{
        $to_provider_order_id = $request->to_provider_order_id;
        
        $to_provider_order = ToProviderOrder::where('id','=',$to_provider_order_id)->first();

		return view('inventory.receipts.modal_create', compact('to_provider_order'));
    }

	public function print(ToProviderOrder $to_provider_order)
    {
		$products = ProductToProviderOrder::select('products.article',
							'products.brand',
							'products.name',
							'product_to_provider_orders.quantity',
							'product_to_provider_orders.price',
							'product_to_provider_orders.total_amount as total')
				->leftjoin('products','products.id','=','product_to_provider_orders.product_id')
				->where('product_to_provider_orders.to_provider_order_id','=',$to_provider_order->id)->get();
				
				$to_provider_order["quantity"] = $products->sum('quantity');
				$to_provider_order["subtotal"] = $products->sum('total');
				$to_provider_order["tax"] = 0;
				$to_provider_order["total_amount"] = $to_provider_order["subtotal"]+$to_provider_order["tax"];
				
				$inventorySettings = InventorySetting::where('id','=', '1')->first()->toArray();
				foreach ($inventorySettings as $key=>$value)
				{
					if ($key === 'id') { continue; }
					$to_provider_order[$key] = $value;
				}
		
		$provider =  Provider::where('id','=', $to_provider_order->provider_id)->first()->toArray();
		
		$generator = new BarcodeGeneratorHTML();
        $barcode = $generator->getBarcode((string)$to_provider_order->id, $generator::TYPE_CODE_128, 1, 25);

        $pdf = PDF::loadView('inventory.pdf.to_provider_order', compact('to_provider_order', 'products', 'provider', 'billingaddress', 'shippingaddress','barcode'));
        $file_name = 'to_provider_order-' . $to_provider_order->id . '.pdf';
        return $pdf->stream($file_name)->header('Content-Type','application/pdf');
    }

    //product selector
	private function getTreeJS($root_id, &$treejs)
    {
        
        $groups = ProductGroup::where('parent_id', $root_id)->get();
        
        $treejs .= '[';
        foreach($groups as $group)
        {
            $treejs .= '{';
                $treejs .= '"dbid":"' . $group->id . '",';
                $treejs .= '"text":"' . $group->name . ' [' . $group->id . ']",';
                $treejs .= '"children":';
                
            $treejs .= $this->getTreeJS($group->id, $treejs);
            $treejs .= '},';
        }
        $treejs .= ']';
    }

	public function to_provider_order_products_filter_by_group(Request $request)
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
				$product->price = AddProductController::get_product_price($product->id, 'in', auth()->user()->default_currency);
				$product->stock = AddProductController::get_product_stocks($product->id, auth()->user()->default_warehouse_id);
			}
			$data = $q->toArray();
		}
		return response()->json($data);
    }
	//product selector

	//client ordered products
	public function add_client_ordered_product_table(Request $request, ToProviderOrder $to_provider_order, ProductToProviderOrder $product)
    {
        //unfinished client orders
        $unfinished_client_orders               = [];
        $client_order_uids                      = ProductClientOrderControl::select('product_client_order_control.order_uid')
												->leftjoin('product_client_to_provider_order_control','product_client_order_control.order_uid','=','product_client_to_provider_order_control.client_order_uid')
												->whereNull('product_client_to_provider_order_control.client_order_uid')
												->get();
												
        // dd($client_order_uids);
        foreach($client_order_uids as $item)
        {
            $item_order_sum = ProductClientOrderControl::where('order_uid','=', $item['order_uid'])->sum('quantity');

            if($item_order_sum !=0)
            {
                $unfinished_client_orders[] = ProductClientOrderControl::where('order_uid','=', $item['order_uid'])->first();
            }
        }
		
        return view('inventory.to_provider_orders.add_client_ordered_product_table', compact('to_provider_order','unfinished_client_orders'));
    }

	public function add_client_ordered_product(Request $request)
    {
		$product_id						= $request->product_id;//продукт
		$client_order_id				= $request->client_order_id;//документ источник
		$to_provider_order_id			= $request->to_provider_order_id;//документ приемник
		$orderInfo						= ProductClientOrderControl::where('doc_id','=', $client_order_id)->where('product_id','=', $product_id)->first();
		
		//additional data
		$to_provider_order				= ToProviderOrder::findOrFail($to_provider_order_id);
		$product						= Product::findOrFail($product_id);
		$warehouse_id					= $to_provider_order->warehouse_id;
		$stock							= AddProductController::get_product_stocks($product_id, auth()->user()->default_warehouse_id);
		$currency						= $to_provider_order->currency;
		$price							= AddProductController::get_product_price($product_id, 'in', $currency);
		$total_amount					= $price * $orderInfo->quantity;
		$created_at						= Carbon::now();
		
		//writing into recieved_products table
		$requesteddata['to_provider_order_id']		= $to_provider_order_id;
		$requesteddata['client_order_id']			= $client_order_id;
		$requesteddata['product_id']				= $product_id;
		$requesteddata['quantity']					= $orderInfo->quantity;
		$requesteddata['created_at']				= $created_at;

		ProductClientToProviderOrder::create($requesteddata);

		$docHeaderValues = self::docHeaderValues($to_provider_order);

		return response()->json([
			'status'  => 1 , 
			'message' => ['Товар добавлен', 'success'],
			'docHeaderValues'				=> $docHeaderValues,
			'info'    => [
				'product_id'				=> $product_id,
				'client_order'				=> $client_order_id,
				'client_order_id'			=> $client_order_id,
				'to_provider_order_id'		=> $to_provider_order_id,
				'article'					=> $product->article,
				'brand'						=> $product->brand,
				'name'						=> $product->name,
				'quantity'					=> $orderInfo->quantity,
				'total_amount'				=> $total_amount,
				'created_at'				=> $created_at,
			],
		]);
    }

	public function delete_client_to_provider_order_selected_product(Request $request)
    {
		if (!$request->ajax())
		{
			abort('404');
		};

		$product_id						= $request->product_id;
		$client_order_id				= $request->client_order_id;
		$to_provider_order_id			= $request->to_provider_order_id;

		$item = ProductClientToProviderOrder::where('to_provider_order_id','=',$to_provider_order_id)->where('product_id','=',$product_id)->get()->first();
		
		if ($item)
		{
			$to_provider_order = ToProviderOrder::find($to_provider_order_id);

			if ($to_provider_order)
			{
				$item = $item->delete();

				$docHeaderValues = self::docHeaderValues($to_provider_order);

				return response()->json([
					'status'  => 1 , 
					'message' => ['Товар добавлен', 'success'],
					'docHeaderValues'			=> $docHeaderValues,
					'info'    => [
							'product_id'		=> $product_id,
						],
					]);
			}
		}
	}
	
	public function finalize_selection_client_ordered_products(ToProviderOrder $to_provider_order, ProductToProviderOrder $to_provider_order_products)
    {
		$doc_type								= "to_provider_order";
		$to_provider_order_id					= $to_provider_order->id;
		$provider_id							= $to_provider_order->provider_id;
		$warehouse_id							= $to_provider_order->warehouse_id;
		
		$product_ids							= ProductClientToProviderOrder::select('product_id')->where('to_provider_order_id','=',$to_provider_order_id)->distinct()->get();

		//order to provider
		ProductToProviderOrder::where('to_provider_order_id','=',$to_provider_order_id)->where('client_ordered','=','true')->delete();

		foreach($product_ids as $item)
        {
            $item_quantity	= ProductClientToProviderOrder::where('to_provider_order_id','=',$to_provider_order_id)->where('product_id','=', $item['product_id'])->sum('quantity');
			$item_price		= AddProductController::get_product_price($item['product_id'], 'in', $to_provider_order['currency']);
			
			ProductToProviderOrder::insert(['product_id'				=> $item['product_id'],
										'client_ordered'				=> "true",
										'to_provider_order_id'			=> $to_provider_order_id,
										'quantity'						=> $item_quantity,
										'price'							=> $item_price,
										'total_amount'					=> $item_price * $item_quantity,
										'warehouse_id'					=> $warehouse_id,
										'currency'						=> $to_provider_order['currency'],
										'created_at'					=> Carbon::now(),
										]);
        }

		//Client orders control start
		ProductClientToProviderOrderControl::where('to_provider_order_id','=', $to_provider_order_id)->delete();

		$client_to_provider_order_products		= ProductClientToProviderOrder::where('to_provider_order_id','=',$to_provider_order_id)->get();
		
		foreach($client_to_provider_order_products as $client_product_item)
		{
			$product_id						= $client_product_item['product_id'];
			$to_provider_order_uid          = md5($provider_id . $product_id . $doc_type . $to_provider_order_id);
			$client_order_uid				= ProductClientOrderControl::where('doc_id','=', $client_product_item['client_order_id'])->where('product_id','=',$client_product_item['product_id'])->first()->order_uid;
			
			ProductClientToProviderOrderControl::insert(['client_order_uid'				=> $client_order_uid,
														'to_provider_order_uid'			=> $to_provider_order_uid,
														'product_id'					=> $client_product_item['product_id'],
														'quantity'						=> $client_product_item['quantity'],
														'to_provider_order_id'			=> $to_provider_order_id,
														'client_order_id'				=> $client_product_item['client_order_id'],
														'created_at'					=> Carbon::now(),
													]);
		}
		//Client orders control finish
		return redirect()->route('to_provider_orders.show', ['to_provider_order' => $to_provider_order->id])->withStatus('Распределение "Заказов покупателя" завершено');
    }

	public function cancel_selection_client_ordered_products(ToProviderOrder $to_provider_order)
    {
		$to_provider_order_id			= $to_provider_order->id;

		ProductToProviderOrder::where('to_provider_order_id','=',$to_provider_order_id)->delete();
		ProductClientToProviderOrder::where('to_provider_order_id','=',$to_provider_order_id)->delete();

		return redirect()->route('to_provider_orders.show', ['to_provider_order' => $to_provider_order->id])->withError('Распределение "Заказов покупателя" отменено!');
    }

	public static function docHeaderValues(ToProviderOrder $to_provider_order)
	{
		$docHeaderValues = [];

		$docCount				= 0;
		$docTotal				= 0;
		$docQuantity			= 0;

		$docTotalRequest = ProductToProviderOrder::where('to_provider_order_id','=',$to_provider_order->id)->get();
		
		$docHeaderValues['docCount']					= $docTotalRequest->count();
		$docHeaderValues['docQuantity']					= $docTotalRequest->sum('quantity');
		$docHeaderValues['docTotal']					= $docTotalRequest->sum('total_amount');
		
		return $docHeaderValues;
	}
}

