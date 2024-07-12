<?php

namespace App\Http\Controllers\Inventory;

use PDF;

use Carbon\Carbon;

use Illuminate\Http\Request;

use App\Models\Inventory\Provider;

use App\Models\Product\Product;

use App\Models\Inventory\Transaction;
use App\Models\Inventory\PaymentMethod;
use App\Models\Inventory\Warehouse;
use App\Models\Inventory\ReturnToProvider;

use App\Models\Settlement;
use App\Models\Product\ReceivedProduct;
use App\Models\Product\ProductPrice;
use App\Models\Product\ProductStock;
use App\Models\Product\ProductReturnToProvider;

use Picqer\Barcode\BarcodeGeneratorHTML;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Inventory\AddProductController;

class ReturnToProviderController extends Controller
{
    public function index()
    {
        $returns_to_provider = ReturnToProvider::paginate(25);

        return view('inventory.returns_to_provider.index', compact('returns_to_provider'));
    }
    
    public function show(ReturnToProvider $return_to_provider)
    {
        return view('inventory.returns_to_provider.show', compact('return_to_provider'));
    }

    public function clear_products_table(ReturnToProvider $return_to_provider)
    {
		ProductReturnToProvider::where('return_to_provider_id','=',$return_to_provider->id)->delete();
		return back()->withStatus('Products table cleared.');
    }

    public function destroy(ReturnToProvider $return_to_provider)
    {
		ProductReturnToProvider::where('return_to_provider_id','=',$return_to_provider->id)->delete();
        $return_to_provider->delete();
        return redirect()->route('returns_to_provider.index')->withStatus('ReturnToProvider successfully removed.');
    }

    public function print_return_to_provider(ReturnToProvider $return_to_provider)
    {
		$products = ProductReturnToProvider::select('products.article',
							'products.brand',
							'products.name',
							'product_returns_to_provider.quantity',
							'product_returns_to_provider.price',
							'product_returns_to_provider.total_amount as total')
				->leftjoin('products','products.id','=','product_returns_to_provider.product_id')
				->where('product_returns_to_provider.return_to_provider_id','=',$return_to_provider->id)->get();
		
		$provider =  Provider::where('id','=', $return_to_provider->provider_id)->first()->toArray();

        $return_to_provider["quantity"]				= $products->sum('quantity');
        $return_to_provider["subtotal"]				= $products->sum('total');
		$return_to_provider["tax"]					= 0;
		$return_to_provider["total_amount"]			= $return_to_provider["subtotal"]+$return_to_provider["tax"];
		
		$generator = new BarcodeGeneratorHTML();
        $barcode = $generator->getBarcode((string)$return_to_provider->barcode, $generator::TYPE_CODE_128, 1, 25);
		
        $pdf = PDF::loadView('inventory.pdf.return_to_providerinvoice', compact('return_to_provider', 'barcode','products', 'provider', 'billingaddress', 'shippingaddress'));
        $file_name = 'return_to_provider-' . $return_to_provider->id . '.pdf';
        return $pdf->stream($file_name)->header('Content-Type','application/pdf');
    }

    public static function return_to_provider_add_single_product(Request $request)
	{
        $all = $request->all();
        
		$return_to_provider_id				= $request->return_to_provider_id;//only from reference doc
		$return_to_provider                 = ReturnToProvider::findOrFail($return_to_provider_id)->toArray();

		$products						= Product::select('products.id as product_id','products.article','products.brand','products.name','products.full_name')
                                                ->leftjoin('received_products','products.id','=','received_products.product_id')

												->orderby('products.article', 'asc')
												->where('received_products.receipt_id','=', $return_to_provider['reference_id'])
                                                ->get()->toarray();

		return view('inventory.returns_to_provider.add_single_product_modal', compact('return_to_provider_id','products'));
	}

    public static function return_to_provider_add_single_product_store(Request $request)
	{
		//request data
		$product_id						= $request->product;
		$return_to_provider_id	    	= $request->return_to_provider_id;
		$price							= floatval($request->price);
		$quantity						= $request->quantity;

		//additional data
		$return_to_provider		    	= ReturnToProvider::findOrFail($return_to_provider_id);
		
		$product						= Product::findOrFail($product_id);
		$warehouse_id					= $return_to_provider->warehouse_id;
		$stock							= AddProductController::get_product_stocks($product_id);
		$currency						= $return_to_provider->currency;
		
		$base_price				  		= ReceivedProduct::where('product_id', $product_id)->where('receipt_id', $return_to_provider->reference_id)->first()->price;
		$price					    	= $price ?? (AddProductController::get_product_price($product_id, 'in', $currency));
       
		
		$total_amount					= $price * $quantity;
		$base_total_amount				= $base_price * $quantity;
		$created_at						= Carbon::now();


		//writing into recieved_products table
		$requesteddata['return_to_provider_id']		    	= $return_to_provider_id;
		$requesteddata['currency']		                	= $currency;
		$requesteddata['warehouse_id']	                	= $warehouse_id;
		$requesteddata['product_id']	                	= $product_id;

		$requesteddata['price']			                	= $price;
		$requesteddata['base_price']		        		= $base_price;
		$requesteddata['quantity']		                	= $quantity;
		$requesteddata['total_amount']	                	= $total_amount;
		$requesteddata['base_total_amount']	            	= $base_total_amount;
		$requesteddata['created_at']	                	= $created_at;
        
		ProductReturnToProvider::create($requesteddata);

		return response()->json([
			'status'  => 1 , 
			'message' => ['Товар добавлен', 'success'],
			'info'    => [
				'product_id'		                => $product_id,
				'return_to_provider_id'			=> $return_to_provider_id,
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

    public function return_to_provider_edit_product(Request $request)
    {
        $all = $request->all();
        
		$edit = "true";
		$return_to_provider_id = $request->return_to_provider_id;
		$product_id = $request->product_id;
		
		$product = ProductReturnToProvider::select('product_returns_to_provider.quantity','product_returns_to_provider.price','product_returns_to_provider.return_to_provider_id',
                                        'products.id as product_id','products.article','products.brand','products.name','products.full_name')
                                    ->where('product_id','=',$product_id)
                                    ->join('products', 'products.id', '=', 'product_returns_to_provider.product_id')
                                    ->where('return_to_provider_id','=',$return_to_provider_id)
                                    ->first();
		if($return_to_provider_id)
		{
			$product = $product->toarray();
		}
		
		return view('inventory.returns_to_provider.addproduct_modal', compact('product','edit'));
    }

    public function return_to_provider_update_product_store(Request $request)
	{
		$product_id						= $request->product_id;
		$return_to_provider_id      = $request->return_to_provider_id;
		$price							= floatval($request->price);//????
		$quantity						= $request->quantity;

		$return_to_provider			= ReturnToProvider::findOrFail($return_to_provider_id);
		$item							= ProductReturnToProvider::where('return_to_provider_id','=',$return_to_provider_id)->where('product_id','=',$product_id)->get()->first();

		if ($item)
		{
            $old_price			= $item->price;
            $old_quantity		= $item->quantity;

            $new_price			= $request->price;
            $new_quantity		= $request->quantity;

            $new_total_amount			= $new_price * $new_quantity;

            if ($old_price != $new_price || $old_quantity != $new_quantity)
			{
                $return_to_provider = ReturnToProvider::find($return_to_provider_id);
                if ($return_to_provider) {
                    $item = $item->update([
                        'price'			=> $new_price,
                        'quantity'		=> $new_quantity,
                        'total_amount'	=> $new_total_amount,
                    ]);

					if ($item) {
                        return response()->json([
                            'status'  => 1 , 
                            'message' => ['Обновлен', 'success'],
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

    public function return_to_provider_delete_product(Request $request)
    {
		if (!$request->ajax())
		{
			abort('404');
		};

		$product_id						            = (int)$request->product_id;
		$return_to_provider_id						= (int)$request->return_to_provider_id;

		$item = ProductReturnToProvider::where('return_to_provider_id','=',$return_to_provider_id)->where('product_id','=',$product_id)->get()->first();
		
		
		if ($item) {
			$old_price    = $item->price;
			$old_quantity = $item->quantity;

			$return_to_provider = ReturnToProvider::find($return_to_provider_id);
			if ($return_to_provider)
			{
				$item = $item->delete();
				return response()->json([
					'status'  => 1 , 
					'message' => ['Удалено', 'success'],
					'info'    => [
							'product_id'    => $product_id,
						],
					]);
			}
		}
    }

    public function finalize(ReturnToProvider $return_to_provider)
    {
		$finalized_at = Carbon::now()->toDateTimeString();
		//перетераем таблицу проводимых товаров
		ProductStock::where('doc_type','=', "return_to_provider")->where('doc_id','=', $return_to_provider->id)->delete();
        //перетераем начисление задолженности, чтоб не задублировался
        Settlement::where('doc_type','=', "return_to_provider")->where('doc_id','=', $return_to_provider->id)->delete();

		foreach($return_to_provider->products as $return_product)
		{
			//product stocks
			ProductStock::Insert(['product_id'			=> $return_product->product_id,
								'batch'					=> md5($return_to_provider->reference_id . $return_product->product_id . $return_product->warehouse_id . $return_product->currency),
								'warehouse_id'			=> $return_product->warehouse_id,
								'doc_id'				=> $return_product->return_to_provider_id,
								'currency'				=> $return_product->currency,
								'quantity'				=> (-1) * $return_product->quantity,
								'price'					=> $return_product->base_price,
								'total'					=> $return_product->base_price*$return_product->quantity,
								'finalized_at'			=> $finalized_at,
								'doc_type'				=> "return_to_provider"]);
        }
		$total_amount = ProductReturnToProvider::where('return_to_provider_id','=', $return_to_provider->id)->sum('total_amount');		
		
		//проводим начисление задолженности
		Settlement::Insert(['doc_type' => "return_to_provider",'doc_id' => $return_to_provider->id,'client_id' => $return_to_provider->client_id,'total_amount' => $total_amount,'currency' => $return_to_provider->currency,'user_id' => $return_to_provider->user_id]);
		
		$return_to_provider->total_amount = $total_amount;
		$return_to_provider->finalized_at = $finalized_at;
        $return_to_provider->save();
		
        return back()->withStatus('ReturnToProvider successfully completed.');
    }

    public function addtransaction(ReturnToProvider $return_to_provider)
    {
        $payment_methods = PaymentMethod::all();

        return view('inventory.returns_from_the_client.addtransaction', compact('return_to_provider', 'payment_methods'));
    }

    public function storetransaction(Request $request, ReturnToProvider $return_to_provider, Transaction $transaction)
    {
        switch($request->all()['type'])
		{
            case 'income':
                $request->merge(['title' => 'Возврат оплаты по возврату поставщику №: ' . $request->get('return_to_provider_id')]);
                break;

            case 'expense':
                $request->merge(['title' => 'Возврат оплаты по расходной накладной: ' . $request->get('return_to_provider_id')]);

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
		Settlement::Insert(['doc_type' => "expense",
								'doc_id' => $transaction->id,
								'client_id' => $return_to_provider->client_id,
								'total_amount' => $request->amount,
								'currency' => $return_to_provider->currency,
								'user_id' => $return_to_provider->user_id,
								'reference' => "/admin/returns_to_provider/" . $return_to_provider->id . "/show"]);

        return redirect()->route('returns_to_provider.show', compact('return_to_provider'))->withStatus('Successfully registered transaction.');
    }
}
