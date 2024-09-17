<?php

namespace App\Http\Controllers\Inventory;

use PDF;
use LOG;

use Carbon\Carbon;

use Illuminate\Http\Request;

use App\Models\Product\Product;
use App\Models\Product\ProductStock;
use App\Models\Product\ProductGroup;
use App\Models\Product\ProductWarehouseWriteOff;

use App\Models\Inventory\WarehouseWriteOff;
use App\Models\Inventory\Currency;
use App\Models\Inventory\Warehouse;
use App\Models\Inventory\InventorySetting;

use Picqer\Barcode\BarcodeGeneratorHTML;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FunctionsController as Functions;
use App\Http\Controllers\Inventory\AddProductController;

class WarehouseWriteOffController extends Controller
{
	public function index(Request $request)
    {
		$keyword = $request->get('search');
        if (!empty($keyword))
		{
            $warehouse_write_offs = WarehouseWriteOff::select('warehouse_write_offs.*')
					->where('warehouse_write_offs.id', 'LIKE', "%$keyword%")
					->orwhere('warehouse_write_offs.comment', 'LIKE', "%$keyword%")
					->orwhere('warehouse_write_offs.barcode', 'LIKE', "%$keyword%")
					->orwhere('warehouse_write_offs.id', 'LIKE', "%$keyword%")
					->paginate(25)
					->withQueryString();
        }
		else
		{
			$warehouse_write_offs = WarehouseWriteOff::paginate(25);
        }

		return view('inventory.warehouse_write_offs.index', compact('warehouse_write_offs'));
    }

	public function create()
    {
        $warehouses		= Warehouse::all();
        $currencies		= Currency::where('active','=','1')->get();
		
        return view('inventory.warehouse_write_offs.create', compact('warehouses','currencies'));
    }

    public function store(Request $request, WarehouseWriteOff $warehouse_write_off)
    {
		$requestData = $request->all();

        $created_at						= Carbon::now();
		$dateprefix						= $created_at->format('Y m d');
		$code_6							= sprintf("%06s",(string)$request->warehouse_id);
		$timeStamp						= Functions::GenerateTimestamp();
		$requestData['barcode']			= "" . $dateprefix . " " . $timeStamp . " " . $code_6 ."";
		
		$warehouse_write_off = $warehouse_write_off->create($requestData);
        
        return redirect()->route('warehouse_write_offs.show', ['warehouse_write_off' => $warehouse_write_off->id])->withStatus('Создан документ "Складское списание"');
    }

    public function show(WarehouseWriteOff $warehouse_write_off)
	{
        $docHeaderValues = $this->docHeaderValues($warehouse_write_off);

		$warehouse_write_off->docCount						= $docHeaderValues['docCount'];
		// $warehouse_write_off->docTotal						= $docHeaderValues['docTotal'];
		$warehouse_write_off->docQuantity					= $docHeaderValues['docQuantity'];

		return view('inventory.warehouse_write_offs.show', compact('warehouse_write_off'));
    }    

    //product selector
	public static function warehouse_write_off_add_single_product_store(Request $request)
	{
		
		//request data
		$product_id						        = $request->productLive;
		$warehouse_write_off_id					= $request->warehouse_write_off_id;
        $quantity					        	= $request->quantity;

		//additional data
		$warehouse_write_off					= WarehouseWriteOff::findOrFail($warehouse_write_off_id);		
		$product					        	= Product::findOrFail($product_id);

		$warehouse_id					        = $warehouse_write_off->warehouse_id;
        $currency						        = $warehouse_write_off->currency;
		$stock							        = AddProductController::get_product_stocks($product_id, $warehouse_id);//именно склад документа!!!!!!!!
		$created_at					        	= Carbon::now();

		//writing into products table
		$requesteddata['warehouse_write_off_id']        = $warehouse_write_off_id;
		$requesteddata['currency']		            	= $currency;
		$requesteddata['warehouse_id']	            	= $warehouse_id;
		$requesteddata['product_id']	            	= $product_id;
		$requesteddata['quantity']		            	= $quantity;
		$requesteddata['created_at']	            	= Carbon::now();
		
		ProductWarehouseWriteOff::create($requesteddata);

		$docHeaderValues = self::docHeaderValues($warehouse_write_off);

		return response()->json([
			'status'  => 1 , 
			'message' => ['Товар добавлен', 'success'],
			'docHeaderValues' => $docHeaderValues,
			'info'    => [
				'product_id'		            => $product_id,
				'warehouse_write_off_id'		=> $warehouse_write_off_id,
				'article'	            		=> $product->article,
				'brand'		            		=> $product->brand,
				'name'		            		=> $product->name,
				'quantity'	            		=> $quantity,
				'stock'			            	=> $stock,
				'created_at'	            	=> Carbon::now(),

			],
		]);
    }

    public function warehouse_write_off_edit_product(Request $request)
    {
		$edit = "true";
		$warehouse_write_off_id = $request->warehouse_write_off_id;
		$product_id = $request->product_id;
		
		$product = ProductWarehouseWriteOff::select('product_warehouse_write_offs.quantity','product_warehouse_write_offs.warehouse_write_off_id','products.id as product_id','products.article','products.brand','products.name','products.full_name')
		->where('product_id','=',$product_id)
		->join('products', 'products.id', '=', 'product_warehouse_write_offs.product_id')
		->where('warehouse_write_off_id','=',$warehouse_write_off_id)
		->first();
		if($warehouse_write_off_id)
		{
			$product = $product->toarray();
		}
		
		return view('inventory.warehouse_write_offs.addproduct_modal', compact('product','edit'));
    }

    public function warehouse_write_off_update_product_store(Request $request)
	{
		$product_id						            = $request->product_id;
		$warehouse_write_off_id						= $request->warehouse_write_off_id;
		$quantity					            	= $request->quantity;

		$warehouse_write_off							= WarehouseWriteOff::findOrFail($warehouse_write_off_id);
        $currency						                = $warehouse_write_off->currency;
		$item							                = ProductWarehouseWriteOff::where('warehouse_write_off_id','=',$warehouse_write_off_id)->where('product_id','=',$product_id)->get()->first();
        
		if ($item)
		{
            $old_quantity		        = $item->quantity;
            $new_quantity		        = $request->quantity;

            if ($old_quantity != $new_quantity)
			{
                $warehouse_write_off = WarehouseWriteOff::find($warehouse_write_off_id);
                if ($warehouse_write_off)
				{
                    $item = $item->update([
                        'quantity'		=> $new_quantity,
                    ]);

					$docHeaderValues = self::docHeaderValues($warehouse_write_off);

					if ($item) {
                        return response()->json([
                            'status'  => 1 , 
                            'message' => ['Обновлен', 'success'],
                            'docHeaderValues' => $docHeaderValues,
                            'info'    => [
                                    'product_id'    => $product_id,
									'quantity'		=> $new_quantity,
                            ],
                        ]);
                    }
                    $error_message = 'Ошибка обновления товара';
                }
                $error_message = 'Неверный номер документа';
            }
            $error_message = 'Вы не изменили значения';
        }
	}

    public function warehouse_write_off_delete_product(Request $request)
    {
		if (!$request->ajax())
		{
			abort('404');
		};

		$product_id					            	= (int)$request->product_id;
		$warehouse_write_off_id						= (int)$request->warehouse_write_off_id;

		$item = ProductWarehouseWriteOff::where('warehouse_write_off_id','=',$warehouse_write_off_id)->where('product_id','=',$product_id)->get()->first();		
		
		if ($item)
		{
			$warehouse_write_off = WarehouseWriteOff::find($warehouse_write_off_id);

			if ($warehouse_write_off)
			{
				$item = $item->delete();

				$docHeaderValues = self::docHeaderValues($warehouse_write_off);

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

    public function finalize(WarehouseWriteOff $warehouse_write_off)
    {
        $total_amount			                   	= 0;
        $finalized_at			                   	= Carbon::now()->toDateTimeString();
		$products_to_warehouse_write_off			= $warehouse_write_off->products;//все продукты из документа, которые списываются

		ProductStock::where('doc_type','=', "warehouse_write_off")->where('doc_id','=', $warehouse_write_off->id)->delete();//перетераем таблицу проводимых товаров

		//проверка остатков перед списанием
		$productsToTest = [];
		foreach($products_to_warehouse_write_off as $product_to_test)
		{
			$product_to_test_quantity		= $product_to_test->quantity;//количество к списанию
			$product_to_test_stock			= ProductStock::where('product_id', '=', $product_to_test->product_id)->where('warehouse_id', '=', $warehouse_write_off->warehouse_id)->sum('quantity');//остаток по товару и складу
			if($product_to_test_stock < $product_to_test_quantity)
			{
				$product = Product::find($product_to_test->product_id)->full_name;
				array_push($productsToTest, $product);			
			}
		}

		if (count($productsToTest) !== 0)
		{
			$productsList = implode("; ", $productsToTest);
			return redirect()->back()->with('error', 'Количество товара: " ' . $productsList .' " недостаточно!');		
		}
		
		foreach($products_to_warehouse_write_off as $product_to_warehouse_write_off)
		{
			$product_to_warehouse_write_off_batches			= [];//партии по product_id
			$product_to_warehouse_write_off_id				= $product_to_warehouse_write_off->product_id;//получаем product_id для каждой строки товара
			$batches_request								= ProductStock::select('batch')->where('product_id','=',$product_to_warehouse_write_off_id)->distinct()->get();//получаем РАЗЛИЧНЫЕ!!! партии для товара

			if($batches_request)
			{
				$batches_request				= $batches_request->toArray();
				// dd(compact('batches_request'));

				foreach($batches_request as $batch_item)
				{
					$product_to_warehouse_write_off_batches[] = ['batch' => $batch_item['batch']];
				}
				
				$batch_data			= [];
				$batch_quantity		= 0;				
				foreach($product_to_warehouse_write_off_batches as $product_batch)
				{
					$batch_quantity						= ProductStock::where('batch', '=', $product_batch)->sum('quantity');//остатки по партиям
					$batch_price_currency				= ProductStock::select('price','currency')->where('batch','=',$product_batch)->first();//цена - валюта партии
					if($batch_price_currency)
					{
						$batch_price_currency			= $batch_price_currency->toArray();
						$price_in						= $batch_price_currency['price'];//для взаиморасчетов
						$currency_in					= $batch_price_currency['currency'];//для взаиморасчетов	

						$batch_data[]					= ['product_id'				=> $product_to_warehouse_write_off_id,
															'warehouse_id'			=> $product_to_warehouse_write_off->warehouse_id,
															'currency'				=> $currency_in,
															'price'					=> $price_in,
															'batch'					=> $product_batch['batch'],
															'quantity'				=> $batch_quantity];
					}
				}
				
				foreach($batch_data as $product_warehouse_write_offs)
				{
					if($product_warehouse_write_offs['quantity'] > 0)//остаток по партии > 0
					{
						if($product_to_warehouse_write_off->quantity > $product_warehouse_write_offs['quantity'])//если списывается больше чем в одной партии
						{
							ProductStock::Insert(['product_id'	=> $product_to_warehouse_write_off_id,
									'batch'						=> $product_warehouse_write_offs['batch'],
									'warehouse_id'				=> $product_to_warehouse_write_off->warehouse_id,
									'quantity'					=> (-1)*$product_warehouse_write_offs['quantity'],//списывается количество из партии
									//income data
									'currency'					=> $product_warehouse_write_offs['currency'],//для взаиморасчетов
									'price'						=> $product_warehouse_write_offs['price'],
									'total'						=> $product_warehouse_write_offs['price'] * $product_warehouse_write_offs['quantity'],
									//outgo data
									'currency_out'				=> $product_to_warehouse_write_off->currency,//0
									'price_out'					=> 0,//0
                                    'discount_out'				=> 0,
									'total_out'					=> 0,//списывается количество из партии, цена со скидкой//0
									
									'finalized_at'				=> $finalized_at,
									'doc_type'					=> "warehouse_write_off",
									'doc_id'					=> $warehouse_write_off->id,
								]);
									$total_amount += $product_warehouse_write_offs['price'] * $product_warehouse_write_offs['quantity'];
									$product_to_warehouse_write_off->quantity	-= $product_warehouse_write_offs['quantity'];
									
						}
						else
						{
							ProductStock::Insert(['product_id'	=> $product_to_warehouse_write_off_id,//если списывается меньше чем в одной партии
									'batch'						=> $product_warehouse_write_offs['batch'],
									'warehouse_id'				=> $product_to_warehouse_write_off->warehouse_id,
									'quantity'					=> (-1)*$product_to_warehouse_write_off->quantity,//списывается количество из документа
									//income data
									'currency'					=> $product_warehouse_write_offs['currency'],//для взаиморасчетов
									'price'						=> $product_warehouse_write_offs['price'],
									'total'						=> $product_warehouse_write_offs['price'] * $product_to_warehouse_write_off->quantity,//списывается количество из документа
									//outgo data
									'currency_out'				=> $product_to_warehouse_write_off->currency,//0
									'price_out'					=> 0,//0
									'discount_out'				=> 0,
									'total_out'					=> 0,//списывается количество из документа//0
									
									'finalized_at'				=> $finalized_at,
									'doc_type'					=> "warehouse_write_off",
									'doc_id'					=> $warehouse_write_off->id,
								]);
								$total_amount += $product_warehouse_write_offs['price'] * $product_to_warehouse_write_off->quantity;
								break;
								
						}
					}
				}
			}
		}

		//products_to_warehouse_write_off
		$warehouse_write_off->total_amount			= $total_amount;//данные по списанию
        $warehouse_write_off->finalized_at			= $finalized_at;
        $warehouse_write_off->save();

        return back()->withStatus('Документ "Складское списание" проведено');
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

	public function warehouse_write_off_product_selector(Request $request, WarehouseWriteOff $warehouse_write_off)
	{
		$docHeaderValues = $this->docHeaderValues($warehouse_write_off);

		$warehouse_write_off->docCount						= $docHeaderValues['docCount'];
		$warehouse_write_off->docQuantity					= $docHeaderValues['docQuantity'];

		$root_id = 10001;
		$treejs = '';
		$this->getTreeJS($root_id, $treejs);
		$treeJS = $treejs;

		return view('inventory.warehouse_write_offs.addproduct_table', compact('warehouse_write_off', 'treeJS'));
	
	}

	public function warehouse_write_off_products_filter_by_group(Request $request)
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
				$product->stock = AddProductController::get_product_stocks($product->id, auth()->user()->default_warehouse_id);
			}
			$data = $q->toArray();
		}
		return response()->json($data);
    }
	
	public static function warehouse_write_off_add_product(Request $request)
	{
		$edit = "false";
		$product_id							= $request->product_id;
		$warehouse_write_off_id				= $request->warehouse_write_off_id;

		$warehouse_write_off				= WarehouseWriteOff::where('id', $warehouse_write_off_id)->first();		
		$product							= Product::select('products.id as product_id','products.article','products.brand','products.name','products.full_name')
												->orderby('products.article', 'asc')
												->where('products.id','=',$product_id)
												->first()->toarray();
												
		$product['warehouse_write_off_id']			= $warehouse_write_off_id;

		return view('inventory.warehouse_write_offs.addproduct_modal', compact('product','edit'));
	}

	public static function warehouse_write_off_add_product_store(Request $request)
	{
		//request data
		$product_id									= $request->product_id;
		$warehouse_write_off_id						= $request->warehouse_write_off_id;
		$to_provider_order_id						= $request->to_provider_order_id;
		$quantity									= $request->quantity;

		//additional data
		$warehouse_write_off						= WarehouseWriteOff::findOrFail($warehouse_write_off_id);
		$product									= Product::findOrFail($product_id);
		$warehouse_id								= $warehouse_write_off->warehouse_id;
		$stock										= AddProductController::get_product_stocks($product_id, auth()->user()->default_warehouse_id);
		$currency									= $warehouse_write_off->currency;
		$created_at									= Carbon::now();


		//writing into recieved_products table
		$requesteddata['warehouse_write_off_id']				= $warehouse_write_off_id;
		$requesteddata['to_provider_order_id']		= $to_provider_order_id;
		$requesteddata['currency']					= $currency;
		$requesteddata['warehouse_id']				= $warehouse_id;
		$requesteddata['product_id']				= $product_id;
		$requesteddata['quantity']					= $quantity;
		$requesteddata['created_at']				= $created_at;
		
		ProductWarehouseWriteOff::create($requesteddata);

		$docHeaderValues = self::docHeaderValues($warehouse_write_off);

		return response()->json([
			'status'  => 1 , 
			'message' => ['Товар добавлен', 'success'],
			'docHeaderValues'						=> $docHeaderValues,
			'info'    => [
				'product_id'						=> $product_id,
				'warehouse_write_off_id'			=> $warehouse_write_off_id,
				'to_provider_order_id'				=> $to_provider_order_id,
				'article'							=> $product->article,
				'brand'								=> $product->brand,
				'name'								=> $product->name,
				'quantity'							=> $quantity,
				'stock'								=> $stock,
				'created_at'						=> $created_at,

			],
		]);
    }

    public function destroy(WarehouseWriteOff $warehouse_write_off)
    {
		ProductWarehouseWriteOff::where('warehouse_write_off_id','=',$warehouse_write_off->id)->delete();
        $warehouse_write_off->delete();

        return redirect()->route('warehouse_write_offs.index')->withStatus('Складское списание удалено');
    }

	//warehouse_write_off_add_edit_comment
	public static function warehouse_write_off_comment(Request $request)
	{
		$warehouse_write_off_id						= $request->warehouse_write_off_id;
		$comment							= WarehouseWriteOff::where('id', $warehouse_write_off_id)->first()->comment;

		return view('inventory.warehouse_write_offs.comment', compact('warehouse_write_off_id','comment'));
	}

	public static function warehouse_write_off_comment_update(Request $request)
	{
		$comment		= $request->comment;
		$warehouse_write_off		= WarehouseWriteOff::findOrFail($request->get('warehouse_write_off_id'));

		$warehouse_write_off->update([
			'comment' => $comment,
		]);
		
		if ($warehouse_write_off)
		{
			$comment	= WarehouseWriteOff::where('id', $warehouse_write_off->id)->first()->comment;

			return response()->json([
				'status' 				=> 1 , 
				'message'				=> ['Изменен', 'success'],
				'comment'				=> $comment,
			]);
		}
	}

	public static function warehouse_write_off_comment_delete(Request $request)
	{
		$warehouse_write_off		= WarehouseWriteOff::findOrFail($request->get('warehouse_write_off_id'));

		$warehouse_write_off->update([
			'comment' => '',
		]);
		
		if ($warehouse_write_off)
		{
			$comment	= WarehouseWriteOff::where('id', $warehouse_write_off->id)->first()->comment;

			return response()->json([
				'status' 				=> 1 , 
				'message'				=> ['Удалено', 'success'],
			]);
		}
	}
    public static function docHeaderValues(WarehouseWriteOff $warehouse_write_off)
	{
		$docHeaderValues = [];

		$docCount				= 0;
		// $docTotal				= 0;
		$docQuantity			= 0;

		$docTotalRequest = ProductWarehouseWriteOff::where('warehouse_write_off_id','=',$warehouse_write_off->id)->get();
		
		$docHeaderValues['docCount']					= $docTotalRequest->count();
		$docHeaderValues['docQuantity']					= $docTotalRequest->sum('quantity');
		
		return $docHeaderValues;
	}
}