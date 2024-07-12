<?php

namespace App\Http\Controllers\Inventory;

use PDF;

use Carbon\Carbon;

use Illuminate\Http\Request;


use App\Models\Settlement;

use App\Models\Product\Product;
use App\Models\Product\ProductPrice;
use App\Models\Product\ProductStock;
use App\Models\Product\ProductGroup;
use App\Models\Product\ReceivedProduct;
use App\Models\Product\ProductToProviderOrder;
use App\Models\Product\ProductReturnToProvider;

use App\Models\Inventory\Receipt;
use App\Models\Inventory\Provider;
use App\Models\Inventory\Currency;
use App\Models\Inventory\Warehouse;
use App\Models\Inventory\Transaction;
use App\Models\Inventory\PaymentMethod;
use App\Models\Inventory\ReturnToProvider;

use App\Models\OrderControl\ProductToProviderOrderControl;

use Picqer\Barcode\BarcodeGeneratorHTML;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FunctionsController as Functions;
use App\Http\Controllers\Inventory\AddProductController;


class ReceiptController extends Controller
{
    public function index()
    {
        $receipts = Receipt::paginate(25);

        return view('inventory.receipts.index', compact('receipts'));
    }
	
	public function create()
    {
        $providers			= Provider::where('active','=','1')->get();
        $warehouses			= Warehouse::all();
        $currencies			= Currency::where('active','=','1')->get();
		
		return view('inventory.receipts.create', compact('providers','warehouses','currencies'));
    }

    public function store(Request $request, Receipt $receipt)
    {
		$requestData = $request->all();
		if($request->setup_prices == 0)
		{
			$provider			= Provider::findOrFail($request->provider_id);
			
			$requestData['setup_prices'] = 1;
			$requestData['surcharge_coefficient'] = 50;
			$requestData['surcharge'] = $provider->price_extra;
			$requestData['comment'] = 'Настройки цен взяты из поставщика';
		}

		///////////////////////////
		if(array_key_exists('reference_type', $requestData) && array_key_exists('reference_id', $requestData))
		{
			if($requestData['reference_type']=="to_provider_order")
			{
				$reference_order_products = ProductToProviderOrder::where('to_provider_order_id','=',$request->get('reference_id'))->get()->toArray();
			}
		}
		
		$created_at					= Carbon::now();
		$dateprefix					= $created_at->format('Y m d');
		$code_6						= sprintf("%06s",(string)$request->provider_id);
		$timeStamp					= Functions::GenerateTimestamp();
		$requestData['barcode']		= "" . $dateprefix . " " . $timeStamp . " " . $code_6 ."";
		
		$receipt = $receipt->create($requestData);
		if(isset($reference_order_products))
		{
			foreach($reference_order_products as $product)
			{
				$price = AddProductController::get_product_price($product['product_id'], 'in', $receipt->currency);

				ReceivedProduct::insert(['receipt_id' => $receipt->id,
									'product_id' => $product['product_id'],
									'currency' => $receipt->currency,
									'price' => $price,
									'to_provider_order_id' => $receipt->reference_id,
									'total_amount' => $price * $product['quantity'],
									'warehouse_id' => $receipt->warehouse_id,
									'quantity' => $product['quantity'],
								]);
			}
		}
		return redirect()->route('receipts.show', $receipt)->withStatus('Receipt registered successfully, you can start adding the products belonging to it.');
    }

    public function show(Receipt $receipt)
    {
		$docHeaderValues = $this->docHeaderValues($receipt);

		$receipt->docCount						= $docHeaderValues['docCount'];
		$receipt->docTotal						= $docHeaderValues['docTotal'];
		$receipt->docQuantity					= $docHeaderValues['docQuantity'];

		return view('inventory.receipts.show', compact('receipt'));
    }

    public function destroy(Receipt $receipt, ReceivedProduct $receivedproduct)
    {
		ReceivedProduct::where('receipt_id','=',$receipt->id)->delete();
        $receipt->delete();

        return redirect()->route('receipts.index')->withStatus('Receipt successfully removed.');
    }

	public function unfinalize(Receipt $receipt)
	{
		$receipt->update([
			'finalized_at' => null,
		]);

        return back()->withStatus('The <To provider order> has been successfully unfinalized.');
	}

	public function finalize(Receipt $receipt)
    {
		$finalized_at = Carbon::now()->toDateTimeString();
		//перетераем таблицу движений
		ProductStock::where('doc_type','=', "receipt")->where('doc_id','=', $receipt->id)->delete();
		Settlement::where('doc_type','=', "receipt")->where('doc_id','=', $receipt->id)->delete();
		ProductToProviderOrderControl::where('doc_type','=', "receipt")->where('doc_id','=', $receipt->id)->delete();

		foreach($receipt->products as $income_product)
		{
			//product stocks
			ProductStock::Insert(['product_id'			=> $income_product->product_id,
								'batch'					=> md5($income_product->receipt_id . $income_product->product_id . $income_product->warehouse_id . $income_product->currency),
								'warehouse_id'			=> $income_product->warehouse_id,
								'doc_id'				=> $income_product->receipt_id,
								'currency'				=> $income_product->currency,
								'quantity'				=> $income_product->quantity,
								'price'					=> $income_product->price,
								'total'					=> $income_product->price*$income_product->quantity,
								'finalized_at'			=> $finalized_at,
								'doc_type'				=> "receipt"
							]);
			//product prices income
			ProductPrice::Insert(['product_id'			=> $income_product->product_id,
								'document_id'			=> $receipt->id,
								'currency'				=> $income_product->currency,
								'price'					=> $income_product->price,
								'date'					=> Carbon::now()->toDateString(),
								'price_type'			=> "in"
							]);
								
			//product prices outgo
			if($receipt->setup_prices == 1)
			{
				if($income_product->product->product_price_group)
				{
					$surcharge					= (float)$income_product->product->product_price_group->surcharge;
					$surcharge_coefficient		= (float)$income_product->product->product_price_group->surcharge_coefficient;
					
					ProductPrice::Insert(['product_id'		=> $income_product->product_id,
									'document_id'			=> $receipt->id,
									'currency'				=> $income_product->currency,
									'price'					=> $this->ceilCoefficient($income_product->price*(1+($surcharge/100)), $surcharge_coefficient),
									'date'					=> Carbon::now()->toDateString(),
									'price_type'			=> "out",
								]);
				}
				else
				{
					if($receipt->surcharge != 0)
					{
						ProductPrice::Insert(['product_id'		=> $income_product->product_id,
										'document_id'			=> $receipt->id,
										'currency'				=> $income_product->currency,
										'price'					=> $this->ceilCoefficient($income_product->price*(1+($receipt->surcharge/100)), $receipt->surcharge_coefficient),
										'date'					=> Carbon::now()->toDateString(),
										'price_type'			=> "out",
									]);
					}
				}
			}
			
			//To provider orders control start
			$doc_type               = "receipt";
			$doc_id                 = $receipt->id;
			$provider_id            = $receipt->provider_id;
			$warehouse_id           = $receipt->warehouse_id;

			$reference_type		= "to_provider_order";
			$reference_id		= $income_product->to_provider_order_id;
			$product_id         = $income_product->product_id;
			$quantity           = $income_product->quantity;
						
			$order_uid					= md5($provider_id . $product_id . $reference_type . $reference_id);//for search order left
			$order_uid_left				= ProductToProviderOrderControl::where('order_uid','=',$order_uid)->sum('quantity');
			if($order_uid_left > 0)
			{
					ProductToProviderOrderControl::insert(['order_uid'       	=> $order_uid,//uid
														'doc_type'          => $doc_type,//receipt
														'doc_id'            => $doc_id,//receipt->id
														'product_id'        => $product_id,
														'provider_id'       => $provider_id,
														'warehouse_id'      => $warehouse_id,
														'quantity'          => (-1)*$quantity,
														'created_at'		=> $finalized_at,
													]);
			}
			//To provider orders control start
        }
		$total_amount = ReceivedProduct::where('receipt_id','=', $receipt->id)->sum('total_amount');

		if($receipt->is_gratuitous != 1)
		{
			//перетераем начисление задолженности, чтоб не задублировался
			Settlement::where('doc_type','=', "receipt")->where('doc_id','=', $receipt->id)->delete();
			//проводим начисление задолженности
			Settlement::Insert(['doc_type'			=> "receipt",
								'doc_id'			=> $receipt->id,
								'provider_id'		=> $receipt->provider_id,
								'total_amount'		=> $total_amount,
								'currency'			=> $receipt->currency,
								'user_id'			=> $receipt->user_id,
								'created_at'		=> $finalized_at]);
		}
		
		$receipt->total_amount = ($receipt->is_gratuitous != 1) ? $total_amount : 0; //is_gratuitous
		$receipt->finalized_at = $finalized_at;
        $receipt->save();
		
        return back()->withStatus('Receipt successfully completed.');
    }

	public function ceilCoefficient($price, $rate = 50)
	{
		$price = ceil($price);
		$rest = ceil($price / $rate) * $rate;
		return $rest;
	}

	public function receipt_product_selector (Request $request, Receipt $receipt, ReceivedProduct $receivedproduct)
	{
		$docHeaderValues						= $this->docHeaderValues($receipt);

		$receipt->docCount						= $docHeaderValues['docCount'];
		$receipt->docTotal						= $docHeaderValues['docTotal'];
		$receipt->docQuantity					= $docHeaderValues['docQuantity'];

		$root_id = 10001;
		$treejs = '';
		$this->getTreeJS($root_id, $treejs);
		$treeJS = $treejs;

		return view('inventory.receipts.addproduct_table', compact('receipt', 'treeJS'));
	
	}
		
	public static function receipt_add_single_product_store(Request $request)
	{
		//request data
		$product_id						= $request->productLive;
		$receipt_id						= $request->receipt_id;
		$to_provider_order_id			= $request->to_provider_order_id;
		$price							= floatval($request->price);//????
		$quantity						= $request->quantity;

		//additional data
		$receipt						= Receipt::findOrFail($receipt_id);
		$product						= Product::findOrFail($product_id);
		$warehouse_id					= $receipt->warehouse_id;
		$stock							= AddProductController::get_product_stocks($product_id);
		$currency						= $receipt->currency;
		$price							= ($price !=0) ? $price : AddProductController::get_product_price($product_id, 'in', $currency);
		$total_amount					= $price * $quantity;
		$created_at						= Carbon::now();

		//writing into recieved_products table
		$requesteddata['receipt_id']				= $receipt_id;
		$requesteddata['to_provider_order_id']		= $to_provider_order_id;
		$requesteddata['currency']					= $currency;
		$requesteddata['warehouse_id']				= $warehouse_id;
		$requesteddata['product_id']				= $product_id;
		$requesteddata['price']						= $price;
		$requesteddata['quantity']					= $quantity;
		$requesteddata['total_amount']				= $total_amount;
		$requesteddata['created_at']				= $created_at;
		
		ReceivedProduct::create($requesteddata);

		$docHeaderValues = self::docHeaderValues($receipt);

		return response()->json([
			'status'  => 1 , 
			'message' => ['Товар добавлен', 'success'],
			'docHeaderValues'		=> $docHeaderValues,
			'info'    => [
				'product_id'		=> $product_id,
				'receipt_id'		=> $receipt_id,
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
	
	public static function receipt_add_product(Request $request)
	{
		$edit = "false";
		$product_id						= $request->product_id;
		$receipt_id						= $request->receipt_id;

		$receipt						= Receipt::where('id', $receipt_id)->first();		
		$product						= Product::select('products.id as product_id','products.article','products.brand','products.name','products.full_name')
												->orderby('products.article', 'asc')
												->where('products.id','=',$product_id)
												->first()->toarray();
				
		//last price
		$product['price']				= AddProductController::get_product_price($product_id, 'in', $receipt->currency);
		$product['receipt_id']			= $receipt_id;

		return view('inventory.receipts.addproduct_modal', compact('product','edit'));
	}

	public static function receipt_add_product_store(Request $request)
	{
		//request data
		$product_id						= $request->product_id;
		$receipt_id						= $request->receipt_id;
		$to_provider_order_id						= $request->to_provider_order_id;
		$price							= floatval($request->price);//????
		$quantity						= $request->quantity;

		//additional data
		$receipt						= Receipt::findOrFail($receipt_id);
		$product						= Product::findOrFail($product_id);
		$warehouse_id					= $receipt->warehouse_id;
		$stock							= AddProductController::get_product_stocks($product_id);
		$currency						= $receipt->currency;
		$price							= ($price !=0) ? $price : AddProductController::get_product_price($product_id, 'in', $currency);
		$total_amount					= $price * $quantity;
		$created_at						= Carbon::now();


		//writing into recieved_products table
		$requesteddata['receipt_id']				= $receipt_id;
		$requesteddata['to_provider_order_id']		= $to_provider_order_id;
		$requesteddata['currency']					= $currency;
		$requesteddata['warehouse_id']				= $warehouse_id;
		$requesteddata['product_id']				= $product_id;
		$requesteddata['price']						= $price;
		$requesteddata['quantity']					= $quantity;
		$requesteddata['total_amount']				= $total_amount;
		$requesteddata['created_at']				= $created_at;
		
		ReceivedProduct::create($requesteddata);

		$docHeaderValues = self::docHeaderValues($receipt);

		return response()->json([
			'status'  => 1 , 
			'message' => ['Товар добавлен', 'success'],
			'docHeaderValues'		=> $docHeaderValues,
			'info'    => [
				'product_id'				=> $product_id,
				'receipt_id'				=> $receipt_id,
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

	public function receipt_edit_product(Request $request)
    {
		$edit = "true";
		$receipt_id = $request->receipt_id;
		$product_id = $request->product_id;
		
		$product = ReceivedProduct::select('received_products.quantity','received_products.price','received_products.receipt_id','products.id as product_id','products.article','products.brand','products.name','products.full_name')
		->where('product_id','=',$product_id)
		->join('products', 'products.id', '=', 'received_products.product_id')
		->where('receipt_id','=',$receipt_id)
		->first();
		if($receipt_id)
		{
			$product = $product->toarray();
		}
		
		return view('inventory.receipts.addproduct_modal', compact('product','edit'));
    }
	

	public function receipt_update_product_store(Request $request)
	{
		$product_id						= $request->product_id;
		$receipt_id						= $request->receipt_id;
		$price							= floatval($request->price);//????
		$quantity						= $request->quantity;

		$item = ReceivedProduct::where('receipt_id','=',$receipt_id)->where('product_id','=',$product_id)->get()->first();

		if ($item)
		{
            $old_price    = $item->price;
            $old_quantity = $item->quantity;
            $new_price    = $request->price;
            $new_quantity = $request->quantity;
            $new_total_amount = $new_price * $new_quantity;

            if ($old_price != $new_price || $old_quantity != $new_quantity)
			{
                $receipt = Receipt::find($receipt_id);

                if ($receipt) {
                    $item = $item->update([
                        'price' => $new_price,
                        'quantity' => $new_quantity,
                        'total_amount' => $new_total_amount,
                    ]);

					$docHeaderValues = self::docHeaderValues($receipt);

					if ($item) {
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
                    $error_message = 'Ошибка обновления услуги';
                }
                $error_message = 'Неверный номер заказа';
            }
            $error_message = 'Вы не изменили значения';
        }
	}
    
	public function clear_products_table(Receipt $receipt, ReceivedProduct $receivedproduct)
    {
		ReceivedProduct::where('receipt_id','=',$receipt->id)->delete();
		return back()->withStatus('Products table cleared.');
    }
	
	public function receipt_delete_product(Request $request)
    {
		if (!$request->ajax())
		{
			abort('404');
		};

		$product_id						= (int)$request->product_id;
		$receipt_id						= (int)$request->receipt_id;

		$item = ReceivedProduct::where('receipt_id','=',$receipt_id)->where('product_id','=',$product_id)->get()->first();
		
		if ($item) {
			$old_price			= $item->price;
			$old_quantity		= $item->quantity;
			
			$receipt			= Receipt::findOrFail($receipt_id);

			if ($receipt)
			{
				$item = $item->delete();

				$docHeaderValues = self::docHeaderValues($receipt);

				return response()->json([
					'status' 				=> 1 , 
					'message'				=> ['Удалено', 'success'],
					'docHeaderValues'		=> $docHeaderValues,
					'info'    => [
							'product_id'    => $product_id,
						],
					]);
			}
		}
    }
	
	public function print_receipt(Receipt $receipt)
    {
		$products = ReceivedProduct::select('products.article',
							'products.brand',
							'products.name',
							'received_products.quantity',
							'received_products.price',
							'received_products.total_amount as total')
				->leftjoin('products','products.id','=','received_products.product_id')
				->where('received_products.receipt_id','=',$receipt->id)->get();
		
		$provider =  Provider::where('id','=', $receipt->provider_id)->first()->toArray();
		
		$receipt["quantity"] = $products->sum('quantity');
		$receipt["subtotal"] = $products->sum('total');
		$receipt["tax"] = 0;
		$receipt["total_amount"] = $receipt["subtotal"]+$receipt["tax"];

		$generator = new BarcodeGeneratorHTML();
        $barcode = $generator->getBarcode((string)$receipt->barcode, $generator::TYPE_CODE_128, 1, 25);
		
        $pdf = PDF::loadView('inventory.pdf.receiptinvoice', compact('receipt', 'barcode', 'products', 'provider', 'billingaddress', 'shippingaddress'));
        $file_name = 'receipt-' . $receipt->id . '.pdf';
        return $pdf->stream($file_name)->header('Content-Type','application/pdf');
    }
	
	//reciept payment
	public function addtransaction(Receipt $receipt)
    {
        $payment_methods = PaymentMethod::all();

        return view('inventory.receipts.addtransaction', compact('receipt', 'payment_methods'));
    }

    public function storetransaction(Request $request, Receipt $receipt, Transaction $transaction)
    {
        switch($request->all()['type'])
		{
			case 'income':
				$request->merge(['title' => 'Возврат оплаты по приходной накладной №: ' . $request->get('receipt_id')]);
				break;

            case 'expense':
                $request->merge(['title' => 'Оплата по приходной накладной №: ' . $request->get('receipt_id')]);

                if($request->get('amount') > 0)
				{
                    $request->merge(['amount' => (float) $request->get('amount') * (-1) ]);
                }
                break;
        }
		
		$transaction = $transaction->create($request->all());
	
		//перетераем платеж, чтоб не задублировался
		Settlement::where('doc_type','=', "expense")->where('doc_id','=', $transaction->id)->delete();
		
		//проводим начисление задолженности
		Settlement::Insert(['doc_type'				=> "expense",
								'doc_id'			=> $transaction->id,
								'provider_id'		=> $request->provider_id,
								'total_amount'		=> $request->amount,
								'currency'			=> $receipt->currency,
								'user_id'			=> $request->user_id,
								'created_at'		=> Carbon::now()]);

        return redirect()->route('receipts.show', compact('receipt'))->withStatus('Successfully registered transaction.');
    }

    public function edittransaction(Receipt $receipt, Transaction $transaction)
    {
        $payment_methods = PaymentMethod::all();

        return view('inventory.receipts.edittransaction', compact('receipt', 'transaction', 'payment_methods'));
    }

    public function updatetransaction(Request $request, receipt $receipt, Transaction $transaction)
    {
        switch($request->get('type'))
		{
            case 'income':
				$request->merge(['title' => 'Возврат оплаты по приходной накладной №: ' . $request->get('receipt_id')]);
                break;

            case 'expense':
				$request->merge(['title' => 'Оплата по приходной накладной №: ' . $request->all('receipt_id')]);

                if($request->get('amount') > 0)
				{
                    $request->merge(['amount' => (float) $request->get('amount') * (-1)]);
                }
                break;
        }
        $transaction->update($request->all());

        return redirect()->route('receipts.show', compact('receipt'))->withStatus('Successfully modified transaction.');
    }

    public function destroytransaction(Receipt $receipt, Transaction $transaction)
    {
        $transaction->delete();

        return back()->withStatus('Transaction deleted successfully.');
    }

	//////////////////tree view
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

	public function receipt_products_filter_by_group(Request $request)
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
	
	//to provider ordered products selector
	public function add_to_provider_ordered_product_table(Request $request, Receipt $receipt, ReceivedProduct $receivedproduct)
	{
		$docHeaderValues = $this->docHeaderValues($receipt);

		$receipt->docCount						= $docHeaderValues['docCount'];
		$receipt->docTotal						= $docHeaderValues['docTotal'];
		$receipt->docQuantity					= $docHeaderValues['docQuantity'];

		// //unfinished to provider orders
		$unfinished_to_provider_orders              = [];
		$to_provider_order_uids                     = ProductToProviderOrderControl::where('provider_id','=', $receipt->provider_id)->get('order_uid');
		foreach($to_provider_order_uids as $item)
		{
			$item_order_sum = ProductToProviderOrderControl::where('order_uid','=', $item['order_uid'])->sum('quantity');
			if($item_order_sum !=0)
			{
				$unfinished_to_provider_orders[] = ProductToProviderOrderControl::where('order_uid','=', $item['order_uid'])->first();
			}
		}
		return view('inventory.receipts.add_to_provider_ordered_product_table', compact('receipt', 'unfinished_to_provider_orders'));	
	}

	public function add_to_provider_ordered_product(Request $request)
	{
		$product_id						= $request->product_id;//продукт
		$to_provider_order_id			= $request->to_provider_order_id;//документ источник
		$receipt_id						= $request->receipt_id;//документ приемник
		
		$orderInfo = ProductToProviderOrderControl::where('doc_id','=', $to_provider_order_id)->where('product_id','=', $product_id)->first();
		
		//additional data
		$to_provider_order				= Receipt::findOrFail($receipt_id);
		$product						= Product::findOrFail($product_id);
		$warehouse_id					= $to_provider_order->warehouse_id;

		$receipt						= Receipt::findOrFail($receipt_id);
		$stock							= AddProductController::get_product_stocks($product_id);
		$currency						= $to_provider_order->currency;
		$price							= AddProductController::get_product_price($product_id, 'in', $currency);
		$total_amount					= $price * $orderInfo->quantity;
		$created_at						= Carbon::now();
		
		//writing into recieved_products table
		$requesteddata['receipt_id']				= $receipt_id;
		$requesteddata['to_provider_order_id']		= $to_provider_order_id;
		$requesteddata['currency']					= $currency;
		$requesteddata['warehouse_id']				= $warehouse_id;
		$requesteddata['product_id']				= $product_id;
		$requesteddata['price']						= $price;
		$requesteddata['quantity']					= $orderInfo->quantity;
		$requesteddata['total_amount']				= $total_amount;
		$requesteddata['created_at']				= $created_at;
		
		ReceivedProduct::create($requesteddata);

		$docHeaderValues = self::docHeaderValues($receipt);

		return response()->json([
			'status' 				=> 1 , 
			'message'				=> ['Удалено', 'success'],
			'docHeaderValues'		=> $docHeaderValues,
			'info'    => [
				'product_id'				=> $product_id,
				'to_provider_order_id'		=> $to_provider_order_id,
				'receipt_id'				=> $receipt_id,
				'article'					=> $product->article,
				'brand'						=> $product->brand,
				'name'						=> $product->name,
				'quantity'					=> $orderInfo->quantity,
				'stock'						=> $stock,
				'price'						=> $price,
				'total_amount'				=> $total_amount,
				'created_at'				=> $created_at,
			],
		]);
	}

	// return_to_provider
    public static function return_to_provider(Receipt $receipt, ReturnToProvider $return_to_provider_model)
    {
		$return_to_provider								= [];
		$return_to_provider['reference_type']			= 'receipt';
		$return_to_provider['reference_id']				= $receipt->id;
		$return_to_provider['provider_id']				= $receipt->provider_id;
		$return_to_provider['currency']					= $receipt->currency;
		$return_to_provider['warehouse_id']				= $receipt->warehouse_id;
		$return_to_provider['user_id']					= auth()->id();

		if(array_key_exists('reference_type', $return_to_provider) && array_key_exists('reference_id', $return_to_provider))
		{
			if($return_to_provider['reference_type'] == "receipt")
			{
				$reference_order_products = ReceivedProduct::where('receipt_id','=',$receipt->id)->get()->toArray();
			}
		}
		else
		{
			$existent = ReturnToProvider::where('provider_id', $receipt->provider_id)->where('finalized_at', null)->get();

			if($existent->count())
			{
				return back()->withError('There is already an unfinished receipt belonging to this customer. <a href="'.route('returns_to_provider.show', $existent->first()).'">Click here to go to it</a>');
			}
		}        

		$createdAt									= Carbon::now();
		$dateprefix									= $createdAt->format('Y m d');
		$timeStamp									= Functions::GenerateTimestamp();
		$code_6										= sprintf("%06s",(string)$receipt->provider_id);		
		$return_to_provider['barcode']			= "" . $dateprefix . " " . $timeStamp . " " . $code_6 ."";
		
		$return_to_provider = $return_to_provider_model->create($return_to_provider);	

		foreach($reference_order_products as $product)
		{
			ProductReturnToProvider::insert(['return_to_provider_id'		=> $return_to_provider->id,
											'product_id'						=> $product['product_id'],
											'warehouse_id'						=> $return_to_provider->warehouse_id,
											'currency'							=> $return_to_provider->currency,
											'quantity'							=> $product['quantity'],

											'base_price'						=> $product['price'],
											'base_total_amount'					=> $product['price']* $product['quantity'],

											'price'								=> $product['price'],
											'total_amount'						=> $product['price']* $product['quantity'],
											'created_at'						=> Carbon::now(),
											]);
		}
		
		return redirect()->route('returns_to_provider.show', $return_to_provider)->withStatus('Successfully registered Return from the provider.');
    }

	public static function docHeaderValues(Receipt $receipt)
	{
		$docHeaderValues = [];

		$docCount				= 0;
		$docTotal				= 0;
		$docQuantity			= 0;

		$docTotalRequest = ReceivedProduct::where('receipt_id','=',$receipt->id)->get();
		
		$docHeaderValues['docCount']					= $docTotalRequest->count();
		$docHeaderValues['docQuantity']					= $docTotalRequest->sum('quantity');
		$docHeaderValues['docTotal']					= $docTotalRequest->sum('total_amount');
		
		return $docHeaderValues;
	}
	
	public static function receipt_create_new_provider_store(Request $request, Provider $provider_model)
    {		
		$requesteddata['name']						= $request->name;
		$requesteddata['hasprice']					= $request->hasprice ?? "None";
		$requesteddata['provider_code']				= $request->provider_code ?? $request->name;
		$requesteddata['spares_provider']			= $request->spares_provider;
		$requesteddata['services_provider']			= $request->services_provider;
		$requesteddata['description']				= $request->description;
		$requesteddata['active']					= (int)1;
		$requesteddata['created_at']				= Carbon::now();
				
        $provider = $provider_model->create($requesteddata);

		return response()->json([
			'status'  => 1 , 
			'message' => ['Поставщик добавлен', 'success'],
			'info'    => [
				'id'		=> $provider->id,
				'name'		=> $provider->name,
			],
		]);
	}
}
