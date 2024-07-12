<?php

namespace App\Http\Controllers\Inventory;

use PDF;

use Carbon\Carbon;

use Illuminate\Http\Request;

use App\Models\Client\Client;

use App\Models\Product\Product;

use App\Models\Inventory\Transaction;
use App\Models\Inventory\PaymentMethod;
use App\Models\Inventory\Warehouse;
use App\Models\Inventory\ReturnFromTheClient;

use App\Models\Settlement;
use App\Models\Product\SoldProduct;
use App\Models\Product\ProductPrice;
use App\Models\Product\ProductStock;
use App\Models\Product\ProductReturnFromTheClient;

use Picqer\Barcode\BarcodeGeneratorHTML;

use App\Http\Controllers\Controller;

use App\Http\Controllers\Inventory\AddProductController;

class ReturnFromTheClientController extends Controller
{
    public function index()
    {
        $returns_from_the_client = ReturnFromTheClient::paginate(25);

        return view('inventory.returns_from_the_client.index', compact('returns_from_the_client'));
    }
    
    public function store(Request $request, ReturnFromTheClient $return_from_the_client)
    {
        return view('inventory.returns_from_the_client.create');
    }
    
    public function show(ReturnFromTheClient $return_from_the_client)
    {
		$docHeaderValues = $this->docHeaderValues($return_from_the_client);

		$return_from_the_client->docCount						= $docHeaderValues['docCount'];
		$return_from_the_client->docTotal						= $docHeaderValues['docTotal'];
		$return_from_the_client->docQuantity					= $docHeaderValues['docQuantity'];

        return view('inventory.returns_from_the_client.show', compact('return_from_the_client'));
    }

    public function clear_products_table(ReturnFromTheClient $return_from_the_client)
    {
		ProductReturnFromTheClient::where('return_from_the_client_id','=',$return_from_the_client->id)->delete();
		return back()->withStatus('Products table cleared.');
    }

    public function finalize(ReturnFromTheClient $return_from_the_client)
    {
		$finalized_at = Carbon::now()->toDateTimeString();
		//перетераем таблицу проводимых товаров
		ProductStock::where('doc_type','=', "return_from_the_client")->where('doc_id','=', $return_from_the_client->id)->delete();
        //перетераем начисление задолженности, чтоб не задублировался
        Settlement::where('doc_type','=', "return_from_the_client")->where('doc_id','=', $return_from_the_client->id)->delete();

		foreach($return_from_the_client->products as $return_product)
		{
			//product stocks
			ProductStock::Insert(['product_id'			=> $return_product->product_id,
								'batch'					=> md5($return_product->return_from_the_client_id . $return_product->product_id . $return_product->warehouse_id . $return_product->currency),
								'warehouse_id'			=> $return_product->warehouse_id,
								'doc_id'				=> $return_product->return_from_the_client_id,
								'currency'				=> $return_product->currency,
								'quantity'				=> $return_product->quantity,
								'price'					=> $return_product->base_price,
								'total'					=> $return_product->base_price*$return_product->quantity,
								'finalized_at'			=> $finalized_at,
								'doc_type'				=> "return_from_the_client"]);
        }

		$total_amount = ProductReturnFromTheClient::where('return_from_the_client_id','=', $return_from_the_client->id)->sum('total_amount');		
		
		//проводим начисление задолженности
		Settlement::Insert(['doc_type' => "return_from_the_client",'doc_id' => $return_from_the_client->id,'client_id' => $return_from_the_client->client_id,'total_amount' => $total_amount,'currency' => $return_from_the_client->currency,'user_id' => $return_from_the_client->user_id]);
		
		$return_from_the_client->total_amount = $total_amount;
		$return_from_the_client->finalized_at = $finalized_at;
        $return_from_the_client->save();
		
        return back()->withStatus('Return from the client successfully completed.');
    }

    public function destroy(ReturnFromTheClient $return_from_the_client)
    {
		ProductReturnFromTheClient::where('return_from_the_client_id','=',$return_from_the_client->id)->delete();
        $return_from_the_client->delete();
		
        return redirect()->route('returns_from_the_client.index')->withStatus('ReturnFromTheClient successfully removed.');
    }

    public function addtransaction(ReturnFromTheClient $return_from_the_client)
    {
        $payment_methods = PaymentMethod::all();

        return view('inventory.returns_from_the_client.addtransaction', compact('return_from_the_client', 'payment_methods'));
    }

    public function storetransaction(Request $request, ReturnFromTheClient $return_from_the_client, Transaction $transaction)
    {
        switch($request->all()['type'])
		{
            case 'income':
                $request->merge(['title' => 'Оплата полученая по расходной накладной №: ' . $request->get('return_from_the_client_id')]);
                break;

            case 'expense':
                $request->merge(['title' => 'Возврат оплаты по документу возврата товара: ' . $request->get('return_from_the_client_id')]);

                if($request->get('amount') > 0)
				{
                    $request->merge(['amount' => (float) $request->get('amount') * (-1) ]);
                }
                break;
        }

        $transaction->create($request->all());

		//перетераем платеж, чтоб он не задублировался
		Settlement::where('doc_type','=', "expense")->where('doc_id','=', $transaction->id)->delete();
		//проводим платеж
		Settlement::Insert(['doc_type'				=> "expense",
								'doc_id'			=> $transaction->id,
								'client_id'			=> $return_from_the_client->client_id,
								'total_amount'		=> $request->amount,
								'currency'			=> $return_from_the_client->currency,
								'user_id'			=> $return_from_the_client->user_id,
								'created_at'		=> Carbon::now()]);

        return redirect()->route('returns_from_the_client.show', compact('return_from_the_client'))->withStatus('Successfully registered transaction.');
    }

    //print_return_from_the_client
    public function print_return_from_the_client(ReturnFromTheClient $return_from_the_client)
    {
		$products = ProductReturnFromTheClient::select('products.article',
							'products.brand',
							'products.name',
							'product_returns_from_the_client.quantity',
							'product_returns_from_the_client.price',
							'product_returns_from_the_client.total_amount as total')
				->leftjoin('products','products.id','=','product_returns_from_the_client.product_id')
				->where('product_returns_from_the_client.return_from_the_client_id','=',$return_from_the_client->id)->get();
		
		$client =  Client::where('id','=', $return_from_the_client->client_id)->first()->toArray();

        $return_from_the_client["quantity"]				= $products->sum('quantity');
        $return_from_the_client["subtotal"]				= $products->sum('total');
		$return_from_the_client["tax"]					= 0;
		$return_from_the_client["total_amount"]			= $return_from_the_client["subtotal"]+$return_from_the_client["tax"];
		
		$generator = new BarcodeGeneratorHTML();
        $barcode = $generator->getBarcode((string)$return_from_the_client->barcode, $generator::TYPE_CODE_128, 1, 25);
		
        $pdf = PDF::loadView('inventory.pdf.return_from_the_clientinvoice', compact('return_from_the_client', 'barcode','products', 'client', 'billingaddress', 'shippingaddress'));
        $file_name = 'return_from_the_client-' . $return_from_the_client->id . '.pdf';
        return $pdf->stream($file_name)->header('Content-Type','application/pdf');
    }

    // return_from_the_client_add_single_product
    public static function return_from_the_client_add_single_product(Request $request)
	{
        $all = $request->all();
        
		$return_from_the_client_id				= $request->return_from_the_client_id;//only from reference doc
		$return_from_the_client                 = ReturnFromTheClient::findOrFail($return_from_the_client_id)->toArray();

		$products						= Product::select('products.id as product_id','products.article','products.brand','products.name','products.full_name')
                                                ->leftjoin('sold_products','products.id','=','sold_products.product_id')

												->orderby('products.article', 'asc')
												->where('sold_products.sale_id','=', $return_from_the_client['reference_id'])
                                                ->get()->toarray();

		return view('inventory.returns_from_the_client.add_single_product_modal', compact('return_from_the_client_id','products'));
	}

    public static function return_from_the_client_add_single_product_store(Request $request)
	{
		//request data
		$product_id						= $request->product;
		$return_from_the_client_id		= $request->return_from_the_client_id;
		$price							= floatval($request->price);
		$quantity						= $request->quantity;

		//additional data
		$return_from_the_client			= ReturnFromTheClient::findOrFail($return_from_the_client_id);
		
		$product						= Product::findOrFail($product_id);
		$warehouse_id					= $return_from_the_client->warehouse_id;
		$stock							= AddProductController::get_product_stocks($product_id);
		$currency						= $return_from_the_client->currency;
		
		$price							= SoldProduct::where('product_id', $product_id)->where('sale_id', $return_from_the_client->reference_id)->first()->price;
		$base_price						= AddProductController::get_product_price($product_id, 'in', $currency);
       
		
		$total_amount					= $price * $quantity;
		$base_total_amount				= $base_price * $quantity;
		$created_at						= Carbon::now();


		//writing into recieved_products table
		$requesteddata['return_from_the_client_id']			= $return_from_the_client_id;
		$requesteddata['currency']		                	= $currency;
		$requesteddata['warehouse_id']						= $warehouse_id;
		$requesteddata['product_id']						= $product_id;

		$requesteddata['price']								= $price;
		$requesteddata['base_price']						= $base_price;
		$requesteddata['quantity']							= $quantity;
		$requesteddata['total_amount']						= $total_amount;
		$requesteddata['base_total_amount']					= $base_total_amount;
		$requesteddata['created_at']						= $created_at;
        
		ProductReturnFromTheClient::create($requesteddata);

		$docHeaderValues = self::docHeaderValues($return_from_the_client);

		return response()->json([
			'status'  => 1 , 
			'message' => ['Товар добавлен', 'success'],
			'docHeaderValues'		=> $docHeaderValues,
			'info'    => [
				'product_id'		                => $product_id,
				'return_from_the_client_id'			=> $return_from_the_client_id,
				'article'		                	=> $product->article,
				'brand'			                	=> $product->brand,
				'name'			                	=> $product->name,
				'quantity'		                	=> $quantity,
				'stock'			                	=> $stock,
				'price'			                	=> $price,
				'total_amount'	                	=> $total_amount,
				'created_at'	                	=> $created_at,
			],
		]);
    }
    
	public function return_from_the_client_edit_product(Request $request)
    {
        $all = $request->all();
        // dd(compact('all'));
		$edit = "true";
		$return_from_the_client_id = $request->return_from_the_client_id;
		$product_id = $request->product_id;
		
		$product = ProductReturnFromTheClient::select('product_returns_from_the_client.quantity','product_returns_from_the_client.price','product_returns_from_the_client.return_from_the_client_id',
                                        'products.id as product_id','products.article','products.brand','products.name','products.full_name')
                                    ->where('product_id','=',$product_id)
                                    ->join('products', 'products.id', '=', 'product_returns_from_the_client.product_id')
                                    ->where('return_from_the_client_id','=',$return_from_the_client_id)
                                    ->first();
		if($return_from_the_client_id)
		{
			$product = $product->toarray();
		}
		
		return view('inventory.returns_from_the_client.addproduct_modal', compact('product','edit'));
    }

    public function return_from_the_client_update_product_store(Request $request)
	{
		$product_id						= $request->product_id;
		$return_from_the_client_id      = $request->return_from_the_client_id;
		$price							= floatval($request->price);//????
		$quantity						= $request->quantity;

		$return_from_the_client			= ReturnFromTheClient::findOrFail($return_from_the_client_id);
		$item							= ProductReturnFromTheClient::where('return_from_the_client_id','=',$return_from_the_client_id)->where('product_id','=',$product_id)->get()->first();

		if ($item)
		{
            $old_price			= $item->price;
            $old_quantity		= $item->quantity;

            $new_price			= $request->price;
            $new_quantity		= $request->quantity;

            $new_total_amount			= $new_price * $new_quantity;

            if ($old_price != $new_price || $old_quantity != $new_quantity)
			{
                $return_from_the_client = ReturnFromTheClient::find($return_from_the_client_id);

                if ($return_from_the_client)
				{
                    $item = $item->update([
                        'price'			=> $new_price,
                        'quantity'		=> $new_quantity,
                        'total_amount'	=> $new_total_amount,
                    ]);

					$docHeaderValues = self::docHeaderValues($return_from_the_client);

					if ($item)
					{
                        return response()->json([
                            'status'  => 1 , 
                            'message' => ['Обновлен', 'success'],
							'docHeaderValues' => $docHeaderValues,
                            'info'    => [
                                    'product_id'    => $product_id,
									'price'			=> $new_price,
									'quantity'		=> $new_quantity,
									'total_amount'	=> $new_total_amount,
                            ],
                        ]);
                    }
                    $error_message = 'Ошибка обновления';
                }
                $error_message = 'Неверный номер документа';
            }
            $error_message = 'Вы не изменили значения';
        }
	}

    public function return_from_the_client_delete_product(Request $request)
    {
		if (!$request->ajax())
		{
			abort('404');
		};

		$product_id										= (int)$request->product_id;
		$return_from_the_client_id						= (int)$request->return_from_the_client_id;

		$item = ProductReturnFromTheClient::where('return_from_the_client_id','=',$return_from_the_client_id)->where('product_id','=',$product_id)->get()->first();
		
		
		if ($item) {
			$old_price    = $item->price;
			$old_quantity = $item->quantity;

			$return_from_the_client = ReturnFromTheClient::find($return_from_the_client_id);

			if ($return_from_the_client)
			{
				$item = $item->delete();

				$docHeaderValues = self::docHeaderValues($return_from_the_client);

				return response()->json([
					'status'  => 1 , 
					'message' => ['Удалено', 'success'],
					'docHeaderValues'		=> $docHeaderValues,
					'info'    => [
							'product_id'    => $product_id,
						],
					]);
			}
		}
    }

	public static function docHeaderValues(ReturnFromTheClient $return_from_the_client)
	{
		$docHeaderValues = [];

		$docCount				= 0;
		$docTotal				= 0;
		$docQuantity			= 0;

		$docTotalRequest = ProductReturnFromTheClient::where('return_from_the_client_id','=',$return_from_the_client->id)->get();
		
		$docHeaderValues['docCount']					= $docTotalRequest->count();
		$docHeaderValues['docQuantity']					= $docTotalRequest->sum('quantity');
		$docHeaderValues['docTotal']					= $docTotalRequest->sum('total_amount');
		
		return $docHeaderValues;
	}

}
