<?php

namespace App\Http\Controllers\Inventory;

use PDF;
use LOG;

use Carbon\Carbon;

use Illuminate\Http\Request;

use App\Models\Client\Client;

use App\Models\Product\Product;
use App\Models\Product\SoldProduct;
use App\Models\Product\ProductStock;
use App\Models\Product\ProductGroup;
use App\Models\Product\ProductClientOrder;
use App\Models\Product\ProductReturnFromTheClient;

use App\Models\Settlement;

use App\Models\Inventory\Sale;
use App\Models\Inventory\ReturnFromTheClient;
use App\Models\Inventory\Currency;
use App\Models\Inventory\Warehouse;
use App\Models\Inventory\Transaction;
use App\Models\Inventory\PaymentMethod;
use App\Models\Inventory\InventorySetting;

use App\Models\OrderControl\ProductClientOrderControl;
use App\Models\Product\ProductAdminCart;

use Picqer\Barcode\BarcodeGeneratorHTML;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FunctionsController as Functions;
use App\Http\Controllers\Inventory\AddProductController;

class SaleController extends Controller
{
	public function index(Request $request)
    {
		$keyword = $request->get('search');
        if (!empty($keyword))
		{
            $sales = Sale::select('sales.*')
					->join('clients', 'clients.id', '=', 'sales.client_id')
					->where('sales.id', 'LIKE', "%$keyword%")
					->orwhere('sales.comment', 'LIKE', "%$keyword%")
					->orwhere('sales.barcode', 'LIKE', "%$keyword%")
					->orwhere('sales.id', 'LIKE', "%$keyword%")
					->orwhere('clients.name', 'LIKE', "%$keyword%")
					->paginate(25)
					->withQueryString();
        }
		else
		{
			$sales = Sale::paginate(25);
        }

		return view('inventory.sales.index', compact('sales'));
    }

	public function create()
    {
        $clients		= Client::all();
        $warehouses		= Warehouse::all();
        $currencies		= Currency::where('active','=','1')->get();
		
        return view('inventory.sales.create', compact('clients','warehouses','currencies'));
    }
	
    public function store(Request $request, Sale $sale, Client $client)
    {
		$requestData = $request->all();
		
		if(array_key_exists('reference_type', $requestData) && array_key_exists('reference_id', $requestData))
		{
			if($requestData['reference_type'] == "client_order")
			{
				$reference_order_products = ProductClientOrder::where('client_order_id','=',$request->get('reference_id'))->get()->toArray();
			}
			if($requestData['reference_type'] == "admincart")
			{
				$reference_order_products = ProductAdminCart::where('admincart_id','=',$request->get('reference_id'))->get()->toArray();
			}
		}
		else
		{
			$existent = Sale::where('client_id', $request->get('client_id'))->where('finalized_at', null)->get();

			if($existent->count())
			{
				return back()->withError('Существует не проведеный документ "Расходная накладная" для данного покупателя. <a href="'.route('sales.show', $existent->first()).'">Нажмите для перехода</a>');
			}
		}

		$created_at						= Carbon::now();
		$dateprefix						= $created_at->format('Y m d');
		$code_6							= sprintf("%06s",(string)$request->client_id);
		$timeStamp						= Functions::GenerateTimestamp();
		$requestData['discount']		= Client::find($request->client_id)->product_discount;
		$requestData['barcode']			= "" . $dateprefix . " " . $timeStamp . " " . $code_6 ."";
		
		$sale = $sale->create($requestData);
		
		if(isset($reference_order_products))
		{
			foreach($reference_order_products as $product)
			{
				$price = $product['price'] ?? AddProductController::get_product_price($product['product_id'], 'out', $sale->currency);
				
				SoldProduct::insert(['sale_id'				=> $sale->id,
									'product_id'			=> $product['product_id'],
									'currency'				=> $sale->currency,
									'quantity'				=> $product['quantity'],
									'price'					=> $price,									
									'total'					=> $price * $product['quantity'],
									'discount'				=> $price * $product['quantity'] * $sale->discount,
									'total_amount'			=> $price * $product['quantity'] * (1 - $sale->discount/100),
									'warehouse_id'			=> $sale->warehouse_id,
									'client_order_id'		=> ($requestData['reference_type'] == "client_order") ? $sale->reference_id : null,//control									
									'created_at'			=> $created_at,
								]);
			}
		}
        
        return redirect()->route('sales.show', ['sale' => $sale->id])->withStatus('Документ "Расходная накладная" успешно зарегистрирован');
    }
	
    public function show(Sale $sale)
	{
		$docHeaderValues = $this->docHeaderValues($sale);

		$sale->docCount						= $docHeaderValues['docCount'];
		$sale->docDiscountSum				= $docHeaderValues['docDiscountSum'];
		$sale->docDiscountedTotal			= $docHeaderValues['docDiscountedTotal'];
		$sale->docTotal						= $docHeaderValues['docTotal'];
		$sale->docQuantity					= $docHeaderValues['docQuantity'];

        return view('inventory.sales.show', compact('sale'));
    }    
	
	public function destroy(Sale $sale)
    {
		SoldProduct::where('sale_id','=',$sale->id)->delete();
        $sale->delete();

        return redirect()->route('sales.index')->withStatus('Документ "Расходная накладная" удален');
    }

    public function finalize(Sale $sale)
    {
        $finalized_at				= Carbon::now()->toDateTimeString();
		$products_to_sale			= $sale->products;//все продукты из документа, которые списываются

		ProductStock::where('doc_type','=', "sale")->where('doc_id','=', $sale->id)->delete();//перетераем таблицу проводимых товаров

		//проверка остатков перед списанием
		$productsToTest = [];
		foreach($products_to_sale as $product_to_test)
		{
			$product_to_test_quantity		= $product_to_test->quantity;//количество к списанию
			$product_to_test_stock			= ProductStock::where('product_id', '=', $product_to_test->product_id)->where('warehouse_id', '=', $sale->warehouse_id)->sum('quantity');//остаток по товару и складу
			if($product_to_test_stock < $product_to_test_quantity)
			{
				$product = Product::find($product_to_test->product_id)->full_name;
				array_push($productsToTest, $product);			
			}
		}
		if (count($productsToTest) !== 0)
		{
			$productsList = implode("; ", $productsToTest);
			return redirect()->back()->with('error', 'Количество товара: << ' . $productsList .' >> недостаточно!');		
		}
		
		//Запрет списаний дешевле приходной цены
		// $productsToTestPrice = [];
		// foreach($products_to_sale as $product_to_test)
		// {
		// 	$product_to_test_price				= $product_to_test->price; //цена в валюте документа

		// 	$product_to_test_base_price			= AddProductController::get_product_price($product_to_test->product_id, 'in', $sale->currency);;

		// 	if($product_to_test_base_price < $product_to_test_price)
		// 	{
		// 		$product = Product::find($product_to_test->product_id)->full_name;
		// 		array_push($productsToTestPrice, $product);			
		// 	}
		// }
		// if (count($productsToTestPrice) !== 0)
		// {
		// 	$productsList = implode("; ", $productsToTestPrice);
		// 	return redirect()->back()->with('error', 'Запрещено списывать << ' . $productsList .' >> ниже себестоимости !');		
		// }
		
		foreach($products_to_sale as $product_to_sale)
		{
			$product_to_sale_batches			= [];//партии по product_id
			$product_to_sale_id					= $product_to_sale->product_id;//получаем product_id для каждой строки товара
			$batches_request					= ProductStock::select('batch')->where('product_id','=',$product_to_sale_id)->distinct()->get();//получаем РАЗЛИЧНЫЕ!!! партии для товара

			if($batches_request)
			{
				$batches_request				= $batches_request->toArray();

				foreach($batches_request as $batch_item)
				{
					$product_to_sale_batches[] = ['batch' => $batch_item['batch']];
				}
				
				$batch_data			= [];
				$batch_quantity		= 0;				
				foreach($product_to_sale_batches as $product_batch)
				{
					$batch_quantity						= ProductStock::where('batch','=',$product_batch)->sum('quantity');//остатки по партиям
					$batch_price_currency				= ProductStock::select('price','currency')->where('batch','=',$product_batch)->first();//цена - валюта партии
					if($batch_price_currency)
					{
						$batch_price_currency			= $batch_price_currency->toArray();
						$price_in						= $batch_price_currency['price'];//для взаиморасчетов
						$currency_in					= $batch_price_currency['currency'];//для взаиморасчетов	

						$batch_data[]					= ['product_id'				=> $product_to_sale_id,
															'warehouse_id'			=> $product_to_sale->warehouse_id,
															'currency'				=> $currency_in,
															'price'					=> $price_in,
															'batch'					=> $product_batch['batch'],
															'quantity'				=> $batch_quantity];
					}
				}
				
				foreach($batch_data as $product_sales)
				{
					if($product_sales['quantity'] > 0)//остаток по партии > 0
					{
						if($product_to_sale->quantity > $product_sales['quantity'])//если списывается больше чем в одной партии
						{
							ProductStock::Insert(['product_id'	=> $product_to_sale_id,
									'batch'						=> $product_sales['batch'],
									'warehouse_id'				=> $product_to_sale->warehouse_id,
									'quantity'					=> (-1)*$product_sales['quantity'],//списывается количество из партии
									//income data
									'currency'					=> $product_sales['currency'],//для взаиморасчетов
									'price'						=> $product_sales['price'],
									'total'						=> $product_sales['price'] * $product_sales['quantity'],
									//outgo data
									'currency_out'				=> $product_to_sale->currency,
									'price_out'					=> $product_to_sale->price,
									'discount_out'				=> $product_to_sale->price * $product_sales['quantity'] * $sale->discount/100,
									'total_out'					=> $product_to_sale->price * $product_sales['quantity'] * (1 - $sale->discount/100),//списывается количество из партии, цена со скидкой									
									'finalized_at'				=> $finalized_at,
									'doc_type'					=> "sale",
									'doc_id'					=> $sale->id,
								]);
									
									$product_to_sale->quantity	-= $product_sales['quantity'];
						}
						else
						{
							ProductStock::Insert(['product_id'	=> $product_to_sale_id,//если списывается меньше чем в одной партии
									'batch'						=> $product_sales['batch'],
									'warehouse_id'				=> $product_to_sale->warehouse_id,
									'quantity'					=> (-1)*$product_to_sale->quantity,//списывается количество из документа
									//income data
									'currency'					=> $product_sales['currency'],//для взаиморасчетов
									'price'						=> $product_sales['price'],
									'total'						=> $product_sales['price'] * $product_to_sale->quantity,//списывается количество из документа
									//outgo data
									'currency_out'				=> $product_to_sale->currency,
									'price_out'					=> $product_to_sale->price,
									'discount_out'				=> $product_to_sale->price * $product_to_sale->quantity * $sale->discount/100,
									'total_out'					=> $product_to_sale->price * $product_to_sale->quantity * (1 - $sale->discount/100),//списывается количество из документа									
									'finalized_at'				=> $finalized_at,
									'doc_type'					=> "sale",
									'doc_id'					=> $sale->id,
								]);
								break;
						}
					}
				}
			}

			SoldProduct::where('sale_id', '=', $sale->id)->update(['created_at' => $finalized_at]);///for sales statistics in dash diagram
		
			//Sale orders control start
			$doc_type               = "sale";
			$doc_id                 = $sale->id;
			$client_id           	= $sale->client_id;
			$warehouse_id           = $sale->warehouse_id;

			$reference_type			= "client_order";
			$reference_id			= $product_to_sale->client_order_id;
			$product_id				= $product_to_sale->product_id;
			$quantity      		    = $product_to_sale->quantity;

			//reerase product for no doubles
			ProductClientOrderControl::where('doc_type','=',$doc_type)->where('product_id','=',$product_id)->where('doc_id','=',$doc_id)->delete();
			
			$order_uid				= md5($client_id . $product_id . $reference_type . $reference_id);//for search order left
			
			$order_uid_left			= (float)ProductClientOrderControl::where('order_uid','=',$order_uid)->sum('quantity');
			
			if($order_uid_left > 0)
			{
				ProductClientOrderControl::insert(['order_uid'		=> $order_uid,//uid
												'doc_type'          => $doc_type,//sale
												'doc_id'            => $doc_id,//sale->id
												'product_id'        => $product_id,
												'client_id'			=> $client_id,
												'warehouse_id'      => $warehouse_id,
												'quantity'          => (-1)*$quantity,
												'created_at'		=> $finalized_at,
											]);
			}
			//Sale orders control finish
		}
		//products_to_sale
		
		$total						= $products_to_sale->sum('total');//данные без скидки
		$total_amount				= $products_to_sale->sum('total_amount');//данные со скидкой, если есть
		$discount_amount			= $products_to_sale->sum('discount');//данные о скидке, если есть

		//перетераем начисление задолженности, чтоб не задублировался
		Settlement::where('doc_type','=', "sale")->where('doc_id','=', $sale->id)->delete();
		//проводим начисление задолженности
		Settlement::Insert(['doc_type'				=> "sale",
							'doc_id'				=> $sale->id,
							'client_id'				=> $sale->client_id,
							'total_amount'			=> $total_amount*(-1),
							'currency'				=> $sale->currency,
							'user_id'				=> $sale->user_id,
							'created_at'			=> $finalized_at]);

		$sale->total				= $total;
		$sale->total_amount			= $total_amount;
		$sale->discount_amount		= $discount_amount;
        $sale->finalized_at			= $finalized_at;
        $sale->save();

        return back()->withStatus('Документ "Расходная накладная" проведен');
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
                $treejs .= '"text":"' . $group->name . '[' . $group->id . ']",';
                $treejs .= '"children":';
                
            $treejs .= $this->getTreeJS($group->id, $treejs);
            $treejs .= '},';
        }
        $treejs .= ']';
    }

	public function sale_product_selector (Request $request, Sale $sale, SoldProduct $soldproduct)
	{
		$docHeaderValues = $this->docHeaderValues($sale);

		$sale->docCount						= $docHeaderValues['docCount'];
		$sale->docDiscountSum				= $docHeaderValues['docDiscountSum'];
		$sale->docDiscountedTotal			= $docHeaderValues['docDiscountedTotal'];
		$sale->docTotal						= $docHeaderValues['docTotal'];
		$sale->docQuantity					= $docHeaderValues['docQuantity'];

		$root_id = 10001;
		$treejs = '';
		$this->getTreeJS($root_id, $treejs);
		$treeJS = $treejs;

		return view('inventory.sales.addproduct_table', compact('sale', 'treeJS'));
	
	}

	public function sale_products_filter_by_group(Request $request)
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
	
	//product selector
	public static function sale_add_single_product_store(Request $request)
	{
		
		//request data
		$product_id						= $request->productLive;
		$sale_id						= $request->sale_id;
		$price							= floatval($request->price);//????
		$quantity						= $request->quantity;

		//additional data
		$sale							= Sale::findOrFail($sale_id);
		
		$product						= Product::findOrFail($product_id);
		$warehouse_id					= $sale->warehouse_id;
		$stock							= AddProductController::get_product_stocks($product_id, auth()->user()->default_warehouse_id);
		$currency						= $sale->currency;

		$price							= ($price !=0) ? $price : AddProductController::get_product_price($product_id, 'out', $currency);
		$price_in						= AddProductController::get_product_price($product_id, 'in', $currency);
		$total							= $price * $quantity;
		$discount						= $total * ($sale->discount/100);
		$total_amount					= $total - $discount;
		
		$created_at						= Carbon::now();

		//writing into recieved_products table
		$requesteddata['sale_id']			= $sale_id;
		$requesteddata['currency']			= $currency;
		$requesteddata['warehouse_id']		= $warehouse_id;
		$requesteddata['product_id']		= $product_id;
		$requesteddata['price']				= $price;
		$requesteddata['quantity']			= $quantity;
		$requesteddata['total']				= $total;
		$requesteddata['discount']			= $discount;
		$requesteddata['total_amount']		= $total_amount;
		$requesteddata['created_at']		= $created_at;
		
		SoldProduct::create($requesteddata);

		$docHeaderValues = self::docHeaderValues($sale);

		return response()->json([
			'status'  => 1 , 
			'message' => ['Товар добавлен', 'success'],
			'docHeaderValues' => $docHeaderValues,
			'info'    => [
				'product_id'		=> $product_id,
				'sale_id'			=> $sale_id,
				'article'			=> $product->article,
				'brand'				=> $product->brand,
				'name'				=> $product->name,
				'quantity'			=> $quantity,
				'discount'			=> $discount,//+-
				'total'				=> $total,
				'stock'				=> $stock,
				'price'				=> $price,
				'price_in'			=> $price_in,
				'total_amount'		=> $total_amount,
				'created_at'		=> $created_at,

			],
		]);
    }

	public static function sale_add_product(Request $request)
	{
		$edit = "false";
		$product_id						= $request->product_id;
		$sale_id						= $request->sale_id;

		$sale							= Sale::where('id', $sale_id)->first();		
		$product						= Product::select('products.id as product_id','products.article','products.brand','products.name','products.full_name')
												->orderby('products.article', 'asc')
												->where('products.id','=',$product_id)
												->first()->toarray();
				
		//last price
		$product['price']				= AddProductController::get_product_price($product_id, 'out', $sale->currency);
		$product['sale_id']			= $sale_id;

		return view('inventory.sales.addproduct_modal', compact('product','edit'));
	}

	public static function sale_add_product_store(Request $request)
	{
		//request data
		$product_id						= $request->product_id;
		$sale_id						= $request->sale_id;
		$price							= floatval($request->price);//????
		$quantity						= $request->quantity;

		//additional data
		$sale							= Sale::findOrFail($sale_id);
		
		$product						= Product::findOrFail($product_id);
		$warehouse_id					= $sale->warehouse_id;
		$stock							= AddProductController::get_product_stocks($product_id, auth()->user()->default_warehouse_id);
		$currency						= $sale->currency;

		$price							= ($price !=0) ? $price : AddProductController::get_product_price($product_id, 'out', $currency);
		$price_in						= AddProductController::get_product_price($product_id, 'in', $currency);
		$total							= $price * $quantity;
		$discount						= $total * ($sale->discount/100);
		$total_amount					= $total - $discount;

		$created_at						= Carbon::now();

		//writing into recieved_products table
		$requesteddata['sale_id']			= $sale_id;
		$requesteddata['currency']			= $currency;
		$requesteddata['warehouse_id']		= $warehouse_id;
		$requesteddata['product_id']		= $product_id;
		$requesteddata['price']				= $price;
		$requesteddata['quantity']			= $quantity;
		$requesteddata['total']				= $total;
		$requesteddata['discount']			= $discount;
		$requesteddata['total_amount']		= $total_amount;
		$requesteddata['created_at']		= $created_at;
		
		SoldProduct::create($requesteddata);

		$docHeaderValues = self::docHeaderValues($sale);

		return response()->json([
			'status'  => 1 , 
			'message' => ['Товар добавлен', 'success'],
			'docHeaderValues' => $docHeaderValues,
			'info'    => [
				'product_id'		=> $product_id,
				'sale_id'			=> $sale_id,
				'article'			=> $product->article,
				'brand'				=> $product->brand,
				'name'				=> $product->name,
				'quantity'			=> $quantity,
				'stock'				=> $stock,
				'price'				=> $price,
				'price_in'			=> $price_in,
				'total'				=> $total,
				'discount'			=> $discount,//+-
				'total_amount'		=> $total_amount,
				'created_at'		=> $created_at,

			],
		]);
    }

	public function sale_edit_product(Request $request)
    {
		$edit			= "true";
		$sale_id		= $request->sale_id;
		$product_id		= $request->product_id;
		
		$product = SoldProduct::select('sold_products.quantity','sold_products.price','sold_products.sale_id','products.id as product_id','products.article','products.brand','products.name','products.full_name')
					->where('product_id','=',$product_id)
					->join('products', 'products.id', '=', 'sold_products.product_id')
					->where('sale_id','=',$sale_id)
					->first();
		if($sale_id)
		{
			$product = $product->toarray();
		}
		
		return view('inventory.sales.addproduct_modal', compact('product','edit'));
    }
	

	public function sale_update_product_store(Request $request)
	{
		$product_id						= $request->product_id;
		$sale_id						= $request->sale_id;
		$price							= floatval($request->price);//????
		$quantity						= $request->quantity;

		$sale							= Sale::findOrFail($sale_id);
		$price_in						= AddProductController::get_product_price($product_id, 'in', $sale->currency);
		$item							= SoldProduct::where('sale_id','=',$sale_id)->where('product_id','=',$product_id)->get()->first();

		if ($item)
		{
            $old_price			= $item->price;
            $old_quantity		= $item->quantity;

            $new_price			= $request->price;
            $new_quantity		= $request->quantity;
            $new_total			= $new_price * $new_quantity;
            $new_discount		= $new_total * ($sale->discount/100);//
            $new_total_amount	= $new_total - $new_discount;

            if ($old_price != $new_price || $old_quantity != $new_quantity)
			{
                $sale = Sale::find($sale_id);
                if ($sale)
				{
                    $item = $item->update([
                        'price'			=> $new_price,
                        'quantity'		=> $new_quantity,
                        'total'			=> $new_total,
                        'discount'		=> $new_discount,
                        'total_amount'	=> $new_total_amount,
                    ]);

					$docHeaderValues = self::docHeaderValues($sale);

					if ($item) {
                        return response()->json([
                            'status'  => 1 , 
                            'message' => ['Обновлен', 'success'],
                            'docHeaderValues' => $docHeaderValues,
                            'info'    => [
                                    'product_id'		=> $product_id,
									'price'				=> $new_price,
									'price_in'			=> $price_in,
									'quantity'			=> $new_quantity,
									'total'				=> $new_total,
									'discount'			=> $new_discount,
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
    
	public function clear_products_table(Sale $sale, SoldProduct $soldproduct)
    {
		SoldProduct::where('sale_id','=',$sale->id)->delete();
		
		return back()->withStatus('Таблица товаров документа "Расходная накладная" очищена');
    }
	
	public function sale_delete_product(Request $request)
    {
		if (!$request->ajax())
		{
			abort('404');
		};

		$product_id						= (int)$request->product_id;
		$sale_id						= (int)$request->sale_id;

		$item = SoldProduct::where('sale_id','=',$sale_id)->where('product_id','=',$product_id)->get()->first();		
		
		if ($item)
		{
			$old_price    = $item->price;
			$old_quantity = $item->quantity;

			$sale = Sale::find($sale_id);
			if ($sale)
			{
				$item = $item->delete();

				$docHeaderValues = self::docHeaderValues($sale);

				return response()->json([
					'status' 				=> 1 , 
					'message'				=> ['Удалено', 'success'],
					'docHeaderValues'		=> $docHeaderValues,
					'info' => [
							'product_id'	=> $product_id,
						],
					]);
			}
		}
    }
	//////////////////////////////////////////////////////////////

    public function addtransaction(Sale $sale)
    {
        $payment_methods = PaymentMethod::all();

        return view('inventory.sales.addtransaction', compact('sale', 'payment_methods'));
    }

    public function storetransaction(Request $request, Sale $sale, Transaction $transaction)
    {
        switch($request->all()['type'])
		{
            case 'income':
                $request->merge(['title' => 'Оплата полученая по расходной накладной №: ' . $request->get('sale_id')]);
                break;

            case 'expense':
                $request->merge(['title' => 'Возврат оплаты по расходной накладной: ' . $request->all('sale_id')]);

                if($request->get('amount') > 0)
				{
                    $request->merge(['amount' => (float) $request->get('amount') * (-1) ]);
                }
                break;
        }

		$transaction = $transaction->create($request->all());

		//перетераем платеж, чтоб он не задублировался
		Settlement::where('doc_type','=', "income")->where('doc_id','=', $transaction->id)->delete();

		//проводим платеж
		Settlement::Insert(['doc_type'				=> "income",
								'doc_id'			=> $transaction->id,
								'client_id'			=> $sale->client_id,
								'total_amount'		=> $request->amount,
								'currency'			=> $sale->currency,
								'user_id'			=> $sale->user_id,
								'created_at'		=> Carbon::now()]);

        return redirect()->route('sales.show', compact('sale'))->withStatus('Документ "Оплата" зарегистрирован');
    }

    public function edittransaction(Sale $sale, Transaction $transaction)
    {
        $payment_methods = PaymentMethod::all();

        return view('inventory.sales.edittransaction', compact('sale', 'transaction', 'payment_methods'));
    }

    public function updatetransaction(Request $request, Sale $sale, Transaction $transaction)
    {
        switch($request->get('type'))
		{
            case 'income':
                $request->merge(['title' => 'Оплата полученая по расходной накладной №: '. $request->get('sale_id')]);
                break;

            case 'expense':
                $request->merge(['title' => 'Возврат оплаты по расходной накладной: '. $request->get('sale_id')]);

                if($request->get('amount') > 0) {
                    $request->merge(['amount' => (float) $request->get('amount') * (-1)]);
                }
                break;
        }
        $transaction->update($request->all());

        return redirect()->route('sales.show', compact('sale'))->withStatus('Документ "Оплата" обновлен');
    }

    public function destroytransaction(Sale $sale, Transaction $transaction)
    {
        $transaction->delete();

        return back()->withStatus('Документ "Оплата" удален');
    }

    public function print_sale(Sale $sale)
    {
		$products = SoldProduct::select('products.article',
							'products.brand',
							'products.name',
							'sold_products.quantity',
							'sold_products.price',
							'sold_products.total as total',
							'sold_products.discount as discount',
							'sold_products.total_amount as total_amount')
				->leftjoin('products','products.id','=','sold_products.product_id')
				->where('sold_products.sale_id','=',$sale->id)->get();
		
		$client =  Client::where('id','=', $sale->client_id)->first()->toArray();

        $sale["quantity"]				= $products->sum('quantity');
        $sale["subtotal"]				= $products->sum('total');
        $sale["discountValue"]			= $products->sum('discount');
		$sale["tax"]					= 0;
		$sale["total_amount"]			= $sale["subtotal"] - $sale["discountValue"] + $sale["tax"];

		$inventorySettings = InventorySetting::where('id','=', '1')->first()->toArray();
		foreach ($inventorySettings as $key=>$value)
		{
			if ($key === 'id') { continue; }
			$sale[$key] = $value;
		}
		
		$generator = new BarcodeGeneratorHTML();
        $barcode = $generator->getBarcode((string)$sale->barcode, $generator::TYPE_CODE_128, 1, 25);
		
        $pdf = PDF::loadView('inventory.pdf.saleinvoice', compact('sale', 'barcode','products', 'client', 'billingaddress', 'shippingaddress'));
        $file_name = 'sale-' . $sale->id . '.pdf';
        return $pdf->stream($file_name)->header('Content-Type','application/pdf');
    }

	//return
    public static function return_from_the_client(Sale $sale, ReturnFromTheClient $return_from_the_client_model)
    {
		$return_from_the_client								= [];
		$return_from_the_client['reference_type']			= 'sale';
		$return_from_the_client['reference_id']				= $sale->id;
		$return_from_the_client['client_id']				= $sale->client_id;
		$return_from_the_client['currency']					= $sale->currency;
		$return_from_the_client['warehouse_id']				= $sale->warehouse_id;
		$return_from_the_client['user_id']					= auth()->id();

		if(array_key_exists('reference_type', $return_from_the_client) && array_key_exists('reference_id', $return_from_the_client))
		{
			if($return_from_the_client['reference_type'] == "sale")
			{
				$reference_order_products = SoldProduct::where('sale_id','=',$sale->id)->get()->toArray();
			}
		}
		else
		{
			$existent = ReturnFromTheClient::where('client_id', $sale->client_id)->where('finalized_at', null)->get();

			if($existent->count())
			{
				return back()->withError('Существует не проведеный документ "Возврат покупателя" для данного клиента. <a href="'.route('returns_from_the_client.show', $existent->first()).'">Нажмите для перехода</a>');
			}
		}
		
		$created_at									= Carbon::now();
		$dateprefix									= $created_at->format('Y m d');
		$timeStamp									= Functions::GenerateTimestamp();
		$code_6										= sprintf("%06s",(string)$sale->client_id);		
		$return_from_the_client['barcode']			= "" . $dateprefix . " " . $timeStamp . " " . $code_6 ."";
		
		$return_from_the_client = $return_from_the_client_model->create($return_from_the_client);		
		
		if(isset($reference_order_products))
		{
			foreach($reference_order_products as $product)
			{
				$base_price = AddProductController::get_product_price($product['product_id'], 'in', $return_from_the_client->currency);

				ProductReturnFromTheClient::insert(['return_from_the_client_id'		=> $return_from_the_client->id,
												'product_id'						=> $product['product_id'],
												'warehouse_id'						=> $return_from_the_client->warehouse_id,
												'currency'							=> $return_from_the_client->currency,
												'quantity'							=> $product['quantity'],

												'base_price'						=> $base_price,
												'base_total_amount'					=> $base_price * $product['quantity'],

												'price'								=> $product['price'],
												'total_amount'						=> $product['price']* $product['quantity'],
												'created_at'						=> Carbon::now(),
												]);
			}
		}
		
		return redirect()->route('returns_from_the_client.show', $return_from_the_client)->withStatus('Документ "Возврат покупателя" зарегистрирован');
    }

	//client ordered products
	public function add_client_ordered_product_table(Request $request, Sale $sale, SoldProduct $product)
	{
		$docHeaderValues = $this->docHeaderValues($sale);

		$sale->docCount						= $docHeaderValues['docCount'];
		$sale->docDiscountSum				= $docHeaderValues['docDiscountSum'];
		$sale->docDiscountedTotal			= $docHeaderValues['docDiscountedTotal'];
		$sale->docTotal						= $docHeaderValues['docTotal'];
		$sale->docQuantity					= $docHeaderValues['docQuantity'];
		
		//unfinished client orders
		$unfinished_client_orders               = [];
		$client_order_uids                      = ProductClientOrderControl::where('client_id','=', $sale->client_id)->get('order_uid');
		foreach($client_order_uids as $item)
		{
			$item_order_sum = ProductClientOrderControl::where('order_uid','=', $item['order_uid'])->sum('quantity');
			if($item_order_sum !=0)
			{
				$unfinished_client_orders[] = ProductClientOrderControl::where('order_uid','=', $item['order_uid'])->first();
			}
		}
		
		return view('inventory.sales.add_client_ordered_product_table', compact('sale','unfinished_client_orders'));
	}

	// sale_add_client_ordered_product
	public function sale_add_client_ordered_product(Request $request)
	{
		$product_id						= $request->product_id;//продукт
		$client_order_id				= $request->client_order_id;//документ источник
		$sale_id						= $request->sale_id;//документ приемник
		
		$orderInfo						= ProductClientOrderControl::where('doc_id','=', $client_order_id)->where('product_id','=', $product_id)->first();
		
		//additional data
		$sale							= Sale::findOrFail($sale_id);
		$product						= Product::findOrFail($product_id);
		$warehouse_id					= $sale->warehouse_id;
		
		//additional data
		$sale							= Sale::findOrFail($sale_id);
		$product						= Product::findOrFail($product_id);
		$warehouse_id					= $sale->warehouse_id;
		$stock							= AddProductController::get_product_stocks($product_id, auth()->user()->default_warehouse_id);
		$currency						= $sale->currency;
		$price							= AddProductController::get_product_price($product_id, 'out', $currency);
		$total_amount					= $price * $orderInfo->quantity;
		$created_at						= Carbon::now();
		
		//writing into recieved_products table
		$requesteddata['sale_id']					= $sale_id;
		$requesteddata['client_order_id']			= $client_order_id;
		$requesteddata['currency']					= $currency;
		$requesteddata['warehouse_id']				= $warehouse_id;
		$requesteddata['product_id']				= $product_id;
		$requesteddata['price']						= $price;
		$requesteddata['quantity']					= $orderInfo->quantity;
		$requesteddata['total_amount']				= $total_amount;
		$requesteddata['created_at']				= $created_at;
		
		SoldProduct::create($requesteddata);

		return response()->json([
			'status'  => 1 , 
			'message' => ['Товар добавлен', 'success'],
			'info'    => [
				'product_id'				=> $product_id,
				'client_order_id'			=> $client_order_id,
				'sale_id'					=> $sale_id,
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


	//discount % switch++
	public function change_discount(Request $request)
	{
		$discount		= $request->discount;
		$sale			= Sale::findOrFail($request->get('sale'));
		
		$sale->update([
			'discount' => $discount,
		]);

		$products_to_sale			= $sale->products;//все продукты из документа, которые списываются		

		foreach($products_to_sale as $item)
		{
			$item->update([
				'discount'			=> $discount * ($item->price / 100) * $item->quantity,
				'total_amount'		=> $item->price * ((100 - $discount) / 100) * $item->quantity,
			]);
		}
		
		$docHeaderValues	= $this->docHeaderValues($sale);
		
		$saleProductsTable = SoldProduct::select('products.article',
									'products.brand',
									'products.name',
									'sold_products.quantity',
									'sold_products.price',
									'sold_products.total',
									'sold_products.discount',
									'sold_products.total_amount',
									'sold_products.sale_id',
									'products.id as product_id')
						->join('products', 'products.id', '=', 'sold_products.product_id')
						->where('sale_id','=',$sale->id)->get();

		if($saleProductsTable)
		{
			foreach($saleProductsTable as $product)
			{
				$product->stock				= AddProductController::get_product_stocks($product->product_id, $sale->warehouse_id);
				$product->price_in			= AddProductController::get_product_price($product->product_id, 'in', $sale->currency);
			}
			$saleProducts = $saleProductsTable->toArray();
		}

		return response()->json([
					'status'			=> 1 ,
					'message'			=> ['Установлена новая скидка', 'success'],
					'docHeaderValues'	=> $docHeaderValues,
					'info'				=> $saleProducts,
			]);
	}
	
	//sale_add_edit_comment
	public static function sale_comment(Request $request)
	{
		$sale_id						= $request->sale_id;
		$comment							= Sale::where('id', $sale_id)->first()->comment;
	
		return view('inventory.sales.comment', compact('sale_id','comment'));
	}
	
	public static function sale_comment_update(Request $request)
	{
		$comment		= $request->comment;
		$sale		= Sale::findOrFail($request->get('sale_id'));

		$sale->update([
			'comment' => $comment,
		]);
		
		if ($sale)
		{
			$comment	= Sale::where('id', $sale->id)->first()->comment;

			return response()->json([
				'status' 				=> 1 , 
				'message'				=> ['Изменен', 'success'],
				'comment'				=> $comment,
			]);
		}
	}

	public static function sale_comment_delete(Request $request)
	{
		$sale		= Sale::findOrFail($request->get('sale_id'));

		$sale->update([
			'comment' => '',
		]);
		
		if ($sale)
		{
			$comment	= Sale::where('id', $sale->id)->first()->comment;

			return response()->json([
				'status' 				=> 1 , 
				'message'				=> ['Удалено', 'success'],
			]);
		}
	}

	public static function docHeaderValues(Sale $sale)
	{
		$docHeaderValues = [];

		$docCount				= 0;
		$docTotal				= 0;
		$docDiscountSum			= 0;
		$docDiscountedTotal		= 0;
		$docQuantity			= 0;

		$docTotalRequest = SoldProduct::where('sale_id','=',$sale->id)->get();

		$docHeaderValues['docCount']					= $docTotalRequest->count();
		$docHeaderValues['docDiscountSum']				= $docTotalRequest->sum('discount');
		$docHeaderValues['docDiscountedTotal']			= $docTotalRequest->sum('total') - $docTotalRequest->sum('discount');
		$docHeaderValues['docQuantity']					= $docTotalRequest->sum('quantity');
		$docHeaderValues['docTotal']					= $docTotalRequest->sum('total');
		
		return $docHeaderValues;
	}
	//discount % switch--
}