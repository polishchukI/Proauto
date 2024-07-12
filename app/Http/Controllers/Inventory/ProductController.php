<?php

namespace App\Http\Controllers\Inventory;

use Carbon\Carbon;

// \Debugbar::disable();//disable debugbar

use Illuminate\Support\Str;

use App\Models\Brand\Brand;

use App\Models\Inventory\Provider;
use App\Models\Inventory\Warehouse;
use App\Models\Inventory\Currency;

use App\Models\Product\Product;
use App\Models\Product\ProductCategory;
use App\Models\Product\ProductStock;
use App\Models\Product\ProductMinimalStocks;
use App\Models\Product\ProductPriceGroup;
use App\Models\Product\ProductCross;
use App\Models\Product\ProductGroup;

use App\Http\Requests\ProductRequest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Controllers\FunctionsController as Functions;

use App\Http\Controllers\Inventory\AddProductController;
use App\Http\Controllers\WSController;

class ProductController extends Controller
{
	
	public function index()
	{
			$root_id = 10001;
			$treejs = '';
			$this->getTreeJS($root_id, $treejs);
			$treeJS = $treejs;
			
        return view('inventory.products.index', compact('treeJS'));
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

    public function create()
    {
        $brands						= Brand::orderBy('brand', 'ASC')->get();
        $categories					= ProductCategory::all();
		$groups						= ProductGroup::all();
		$product_price_groups		= ProductPriceGroup::all();

        return view('inventory.products.create', compact('categories','product_price_groups','groups','brands'));
    }

	public function store(ProductRequest $request, Product $product_model)
    {
		$requestData = $request->all();
		
		//unique control
		$pkey = Functions::SingleKey($request->brand,true) . Functions::SingleKey($request->article);
		
		$product_check = Product::where('pkey','=', $pkey)->first();

		if(!$product_check)
		{
			$requestData['pkey']			= $pkey;
			$requestData['bkey']			= Functions::SingleKey($request->brand,true);
			$requestData['akey']			= Functions::SingleKey($request->article);
			$requestData['full_name']		= $request->name . ", " . $request->brand . ", " . $request->article;

			if(empty($requestData['name']) && $requestData['product_group_id']!=10000)
			{
				$product_name = ProductGroup::findOrFail($requestData['product_group_id'])->name;
				$requestData['name']		= $product_name;
				$requestData['full_name']	= $product_name . ", " . $request->brand . ", " . $request->article;
			}
			
			$product = $product_model->create($requestData);

			return redirect()->route('products.show', ['product' => $product])->withStatus('Product created successfully.');
		}
		else
		{
			return redirect()->route('products.show', ['product' => $product_check])->withStatus('Item already exists.');
		}
			
    }

    public function show(Product $product)
    {
        $uid = "";
		$pkey_uid			= ProductCross::where('pkey','=',$product->pkey)->first();

		$number = $product->pkey;

		if (!is_null($pkey_uid))
		{
			$uid = $pkey_uid->uid;
		}

        /////////////////////////WS
		$result = [];
		$WSWS = Provider::where('cache','=', "1")->where('hasprice','=', "Webservice")->where('active','=', "1")->get();

		if ($WSWS)
		{
			$WSWS = $WSWS->toArray();
			$SearchedArray = [
					"searched"  => true,
					"pkey"      => $number,
					"bkey"      => "",
					"akey"      => $number,
					"article"   => $number,
					"brand"     => "",
					"td_name"   => "",
					"name"      => ""];
			
			$WSpartsArray[$number] = $SearchedArray;
			try
			{
				$WS = new WSController();
				$WS->SearchPrices($WSpartsArray, [], ["cache_mode" => true, "links_take" => "OFF", "pkey" => $number, "search" => "Y", "sid"=>""]);
			}
			catch(\Exception $e)
			{
				$WS = [];
			}
		}
		/////////////////////////
		$crosses			= ProductCross::where('uid','=',$uid)->get();
		$solds				= $product->solds()->latest()->limit(25)->get();
        $receiveds			= $product->receiveds()->latest()->limit(25)->get();

		$productImage = "/images/artmedia/" . $product->bkey . "/" . $product->akey . ".jpg";
		$productImagePath = $_SERVER["DOCUMENT_ROOT"] . $productImage;
		
		if (file_exists($productImagePath))
		{
			$product->image = $productImage;
		}
		else
		{
			$product->image = '/images/admin/image_placeholder.jpg';
		}
        
		$product->price_in		= AddProductController::get_product_price($product->id, 'in', auth()->user()->default_currency);
		$product->price_out		= AddProductController::get_product_price($product->id, 'out', auth()->user()->default_currency);
		
        return view('inventory.products.show', compact('product', 'solds', 'receiveds', 'crosses'));
    }

    public function edit(Product $product)
    {
		$crosses		= [];
		$brands			= Brand::orderBy('brand', 'ASC')->get();
        $categories		= ProductCategory::all();
        $groups			= ProductGroup::all();
		
		$pkey_uid			= ProductCross::where('pkey','=',$product->pkey)->first();

		if (!is_null($pkey_uid))
		{
			$uid = $pkey_uid->uid;			
			$crosses			= ProductCross::where('uid','=',$uid)->get();
		}
		$product_price_groups = ProductPriceGroup::all();

        return view('inventory.products.edit', compact('brands','product','groups','product_price_groups','categories', 'crosses'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        $requestData					= $request->all();
		$requestData['full_name']		= $request->name . ", " . $request->brand . ", " . $request->article;		
		$requestData['pkey']			= Functions::SingleKey($request->brand,true) . Functions::SingleKey($request->article);
		$requestData['bkey']			= Functions::SingleKey($request->brand,true);
		$requestData['akey']			= Functions::SingleKey($request->article);
        
		$product->update($requestData);

		return redirect()->route('products.show', ['product' => $product])->withStatus('Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->withStatus('Product removed successfully.');
    }

	public static function product_create_new_brand_store(Request $request, Brand $brand)
    {
		$requestData = $request->all();
		
		$requestData['brand']			= Str::upper($request->brand);
        $requestData['bkey']			= Functions::SingleKey($request->brand,true);
		$requestData['slug']			= Str::slug($request->brand);
		$requestData['created_at']		= Carbon::now();
		
        $brand->create($requestData);
		$brand_return						= Brand::where('bkey','=',$requestData['bkey'])->first();

		return response()->json([
			'status'  => 1 , 
			'message' => ['Бренд добавлен', 'success'],
			'info'    => [
				'brand'		=> $brand_return->brand,
			],
		]);
	}

	public function products_filter_by_group(Request $request)
    {
		$data = [];
		$product_group_id = $request->selected_group;
		
		if($product_group_id == '10002')
		{
			$q = Product::select('id','article','brand','name','description')->get();
		}
		else
		{
			$q = Product::select('id','article','brand','name','description')->where('product_group_id','=',$product_group_id)->get();
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

	public function products_filter_by_search(Request $request)
    {
		$data					= [];
		$search					= $request->search;
		$product_group_id		= $request->selected_group;
		
		$query = Product::select('id','article','brand','name','description')
				->where('products.article', 'LIKE', "%${search}%")
				->orWhere('products.akey', 'LIKE', "%${search}%")
				->orWhere('products.brand', 'LIKE', "%${search}%")
				->orWhere('products.full_name', 'LIKE', "%${search}%")
				->orWhere('products.description', 'LIKE', "%${search}%")//does not works
				->get();
		
		if($query)
		{
			foreach($query as $product)
			{
				$product->price = AddProductController::get_product_price($product->id, 'out', auth()->user()->default_currency);
				$product->stock = AddProductController::get_product_stocks($product->id, auth()->user()->default_warehouse_id);
			}
			$data = $query->toArray();
		}
		return response()->json($data);
    }
	/////////////////////////////////////////////////////////////////////////// ** min stock ** ///////////////////////////////////////////////////////////////////////////
	public static function product_add_min_stock(Request $request)
	{
		$edit			= "false";
		$product_id		= $request->product_id;
		$warehouses		= Warehouse::where('active','=','1')->get();
		
		return view('inventory.products.min_stock', compact('product_id','warehouses','edit'));
	}
	
	public function product_add_min_stock_store(Request $request, ProductMinimalStocks $min_stocks)
    {
		$existent = ProductMinimalStocks::where('warehouse_id', $request->get('warehouse_id'))->where('product_id', $request->get('product_id'))->first();

		if($existent)
		{
			return response()->json([
				'status'  => 1 , 
				'message' => ['There is already set minimum stock for product in this warehouse!', 'warning'],
			]);
		}
		else
		{
			$product_id						= $request->product_id;
			$warehouse_id					= $request->warehouse_id;
			$quantity						= $request->quantity;
			$created_at						= Carbon::now();
			
			$requesteddata['warehouse_id']		= $warehouse_id;
			$requesteddata['product_id']		= $product_id;
			$requesteddata['quantity']			= $quantity;
			$requesteddata['created_at']		= $created_at;
			
			$min_stocks = $min_stocks->create($requesteddata);

			return response()->json([
				'status'  => 1 , 
				'message' => ['Minimal stock added', 'success'],
				'info'    => [
					'product_id'		=> $product_id,
					'min_stock_id'		=> $min_stocks->id,
					'warehouse'			=> Warehouse::find($warehouse_id)->name,
					'quantity'			=> $quantity,
					'date'				=> $created_at->toDateTimeString(),
	
				],
			]);
		}		
    }
	
	public static function product_edit_min_stock(Request $request)
	{
		$edit				= "true";
		$product_id			= $request->product_id;
		$min_stock_id		= $request->min_stock_id;

		$min_stock			= ProductMinimalStocks::select('quantity','warehouse_id')->where('product_id','=',$product_id)->where('id','=',$min_stock_id)->first()->toArray();
		$warehouse_id		= $min_stock['warehouse_id'];
		$quantity			= $min_stock['quantity'];
		
		$warehouses			= Warehouse::where('active','=','1')->get();

		return view('inventory.products.min_stock', compact('product_id','warehouse_id','warehouses','min_stock_id','quantity','edit'));
	}

	public static function product_update_min_stock(Request $request, ProductMinimalStocks $min_stocks)
    {
		$product_id						= $request->product_id;
		$warehouse_id					= $request->warehouse_id;
		$quantity						= $request->quantity;
		$min_stock_id					= $request->min_stock_id;
		$updated_at						= Carbon::now();
		
		$item = ProductMinimalStocks::where('product_id','=',$product_id)->where('id','=',$min_stock_id)->get()->first();

		if ($item)
		{
			$item = $item->update([
				'warehouse_id'		=> $warehouse_id,
				'quantity'			=> $quantity,
				'updated_at'		=> $updated_at,
			]);

			if ($item) {
				return response()->json([
					'status'  => 1 , 
					'message' => ['Обновлен', 'success'],
					'info'    => [
						'product_id'		=> $product_id,
						'min_stock_id'		=> $min_stock_id,
						'warehouse'			=> Warehouse::find($warehouse_id)->name,
						'quantity'			=> $quantity,
						'date'				=> $updated_at->toDateTimeString(),
					],
				]);
			}
        }
    }
	
	public function product_delete_min_stock(Request $request)
    {
		if (!$request->ajax())
		{
			abort('404');
		};

		$product_id			= $request->product_id;
		$min_stock_id		= $request->min_stock_id;

		$item = ProductMinimalStocks::where('product_id','=',$product_id)->where('id','=',$min_stock_id)->get()->first();
		
		
		if ($item) {

				$item = $item->delete();
				return response()->json([
					'status'  => 1 , 
					'message' => ['Удалено', 'success'],
					'info'    => [
							'min_stock_id'    => $min_stock_id,
						],
					]);
		}
    }

	public function product_stocks_management(Request $request)
    {
		$warehouses		= Warehouse::where('active','=','1')->get();
        $currencies		= Currency::where('active','=','1')->get();
		
		return view('inventory.products.product_stocks_management', compact('warehouses','currencies'));
    }
	/////////////////////////////////////////////////////////////////////////// ** min stock ** ///////////////////////////////////////////////////////////////////////////

	/////////////////////////////////////////////////////////////////////////// ** product_stocks_management_calculate_start ** ///////////////////////////////////////////////////////////////////////////

	public function product_stocks_management_calculate(Request $request)
    {
		$warehouse			= $request->warehouse ?? 1;
		$currency			= $request->currency ?? "RUB";		
		
		$count = 0;
		$style = "progress-bar";
		$product_stocks = [];

		if($request->all_products == "on")
		{
			$q = Product::select('id as product_id')
				->distinct()
				->orderBy('products.name', 'asc')
				->get()->toArray();
		}
		elseif($request->all_products == "min")
		{
			$q = ProductMinimalStocks::select('product_id')
				->join('products','products.id','=','product_minimal_stocks.product_id')
				->orderBy('products.name', 'asc')
				->where('warehouse_id', '=', $warehouse)->get()->toArray();
		}
		else
		{
			$q = ProductStock::select('product_id')
					->join('products','products.id','=','product_stocks.product_id')
					->distinct()
					->orderBy('products.name', 'asc')
					->get()->toArray();
		}
		
		if($q)
		{
			foreach($q as $product)
			{				
				$abn					= Product::select('article', 'brand', 'name')->where('id','=',$product['product_id'])->first()->toArray();
				$quantity				= intval(AddProductController::get_product_stocks($product['product_id']));
				$min_stock_q			= ProductMinimalStocks::where('product_id', '=', $product['product_id'])->where('warehouse_id', '=', $warehouse)->pluck('quantity')->first();
				$min_stock				= intval($min_stock_q) ?? intval(0);
				$price					= AddProductController::get_product_price($product['product_id'], 'in', $currency);
				
				
				if(($quantity > $min_stock) || ($quantity == $min_stock))
				{
					$progress = 100;
					$style = "text-success";
				}
				elseif(($quantity < $min_stock) && $min_stock != 0)
				{
					$progress = 100*($quantity/$min_stock);
					$style = "text-warning";
				}				
				else
				{
					$progress = 0;
					$style = "text-danger";
				}

				// dd(compact('abn'));
				if($request->all_products == "on" || $request->all_products == "min")
				{
					$count++;
					$data[] = ['count' => $count,
								'id' => $product['product_id'],
								'article' => $abn['article'],
								'brand' => $abn['brand'],
								'name' => $abn['name'],
								'quantity' => $quantity,
								'min_stock' => $min_stock,
								'progress' => $progress,
								'price' => $price,
								'style' => $style,
								'total' => $quantity * $price];
				}
				else
				{
					if($quantity > 0)
					{
						$count++;
						$data[] = ['count' => $count,
									'id' => $product['product_id'],
									'article' => $abn['article'],
									'brand' => $abn['brand'],
									'name' => $abn['name'],
									'quantity' => $quantity,
									'min_stock' => $min_stock,
									'progress' => $progress,
									'price' => $price,
									'style' => $style,
									'total' => $quantity * $price];
					}
				}				
			}
		}
		
		return response()->json([
			'currency'			=> $currency,
			'warehouse'			=> $warehouse,
			'stocks_table'		=> $data,
		]);
	}
	
	/////////////////////////////////////////////////////////////////////////// ** product_stocks_management_calculate_finish ** ///////////////////////////////////////////////////////////////////////////

	/////////////////////////////////////////////////////////////////////////// ** crosses ** ///////////////////////////////////////////////////////////////////////////
	public static function product_addcross(Request $request)
	{
		$edit			= "false";
		$product_id		= $request->product_id;
		$brands			= Brand::orderBy('brand', 'ASC')->get();
		$product		= Product::select()->where('id','=', $product_id)->first()->toArray();
		
		return view('inventory.products.crosses', compact('product','brands','edit'));
	}
	
	public function product_addcross_store(Request $request)
	{
		$requestData = $request->all();	
		
		$new_cross							= [];
		$new_cross['article']				= $request->article;
		$new_cross['akey']					= Functions::SingleKey($request->article);
		$new_cross['brand']					= $request->brand;
		$new_cross['bkey']					= Functions::SingleKey($request->brand,true);
		$new_cross['name']					= $request->name;
		$new_cross['pkey']					= $new_cross['bkey'] . $new_cross['akey'];
		$new_cross['main_by_group']			= ($request->main_by_group == 1) ? 1 : 0;
		$new_cross['main_by_brand']			= ($request->main_by_brand == 1) ? 1 : 0;

		$product						= Product::findorfail($request->product_id);//find product		
		$product_uid_request			= ProductCross::where('pkey','=',$product->pkey)->first();//getting crosses group by product
		$cross_uid_request				= ProductCross::where('pkey','=',$new_cross['pkey'])->first();//getting crosses group by cross product
		
		if($product_uid_request && $cross_uid_request)
		{
			$product_uid			= $product_uid_request->uid;//getting product crosses group uid
			$cross_uid				= $cross_uid_request->uid;//getting crosses group uid

			if($cross_uid == $product_uid)//cross already in this group!!!!
			{
				return response()->json([
					'status'  => 1 , 
					'message' => ['Cross already exists in this group!', 'error'],
				]);			
			}
			else
			{
				$crosses_group	= ProductCross::where('uid','=',$cross_uid)->get();//getting crosses group by cross product
				foreach($crosses_group as $cross_item)
				{
					ProductCross::insert(['uid'					=> $product_uid,//adding cross in to new group
										'article'				=> $cross_item['article'],
										'akey'					=> $cross_item['akey'],
										'brand'					=> $cross_item['brand'],
										'bkey'					=> $cross_item['bkey'],
										'pkey'					=> $cross_item['pkey'],
										'name'					=> $cross_item['name'] ?? $product->name,
										'main_by_brand'			=> $cross_item['main_by_brand'],
										'main_by_group'			=> $cross_item['main_by_group']
									]);
					ProductCross::where('uid','=',$cross_uid)->where('pkey','=', $cross_item['pkey'])->delete();//deleting cross from old group
				}
				
				$crosses_group = ProductCross::select('article','brand','name','code','main_by_group','main_by_brand','uid','id')->where('uid','=',$product_uid_request->uid)->get();//getting crosses group by uid
				
				return response()->json([
						'status'  => 1 , 
						'message' => ['Cross groups successfully merged!', 'success'],
						'info'    => $crosses_group,
					]);
			}
		}
		elseif($product_uid_request)
		{
			$product_uid			= $product_uid_request->uid;//getting product crosses group uid

			//inserting cross
			ProductCross::insert(['uid'			=> $product_uid,
						'article'				=> $new_cross['article'],
						'akey'					=> $new_cross['akey'],
						'brand'					=> $new_cross['brand'],
						'bkey'					=> $new_cross['bkey'],
						'pkey'					=> $new_cross['pkey'],
						// 'name'					=> $new_cross['name'],
						'name'					=> $cross_item['name'] ?? $product->name,
						'main_by_brand'			=> $new_cross['main_by_brand'],
						'main_by_group'			=> $new_cross['main_by_group']
					]);
					
			$crosses_group = ProductCross::select('article','brand','name','code','main_by_group','main_by_brand','uid','id')->where('uid','=',$product_uid)->get();//getting crosses group by uid
			
			return response()->json([
					'status'  => 1 , 
					'message' => ['Cross added!', 'success'],
					'info'    => $crosses_group,
				]);
		}
		elseif($cross_uid_request)
		{
			$new_uid			= Str::uuid();
			$cross_uid			= $cross_uid_request->uid;//getting product crosses group uid

			$crosses_group	= ProductCross::where('uid','=',$cross_uid)->get();//getting crosses group by cross product
			foreach($crosses_group as $cross_item)
			{
				ProductCross::insert(['uid'					=> $new_uid,//adding cross in to new group
									'article'				=> $cross_item['article'],
									'akey'					=> $cross_item['akey'],
									'brand'					=> $cross_item['brand'],
									'bkey'					=> $cross_item['bkey'],
									'pkey'					=> $cross_item['pkey'],
									// 'name'					=> $cross_item['name'],
									'name'					=> $cross_item['name'] ?? $product->name,
									'main_by_brand'			=> $cross_item['main_by_brand'],
									'main_by_group'			=> $cross_item['main_by_group']
								]);
				ProductCross::where('uid','=',$cross_uid)->where('pkey','=', $cross_item['pkey'])->delete();//deleting cross from old group
			}
			//inserting product itself
			ProductCross::insert(['uid'						=> $new_uid,
									'article'				=> $product->article,
									'akey'					=> $product->akey,
									'brand'					=> $product->brand,
									'bkey'					=> $product->bkey,
									'pkey'					=> $product->pkey,
									'name'					=> $product->name,
									'main_by_brand'			=> $product->main_by_brand,
									'main_by_group'			=> $product->main_by_group
								]);
			
			$crosses_group = ProductCross::select('article','brand','name','code','main_by_group','main_by_brand','uid','id')->where('uid','=',$new_uid)->get();//getting crosses group by uid
			
			return response()->json([
					'status'  => 1 , 
					'message' => ['Product successfully added to cross group!', 'success'],
					'info'    => $crosses_group,
				]);
		}
		else
		{
			//group does not exists
			$new_uid = Str::uuid();
			//inserting product
			ProductCross::insert(['uid'						=> $new_uid,
									'article'				=> $product->article,
									'akey'					=> $product->akey,
									'brand'					=> $product->brand,
									'bkey'					=> $product->bkey,
									'pkey'					=> $product->pkey,
									'name'					=> $product->name,
									'main_by_brand'			=> $product->main_by_brand,
									'main_by_group'			=> $product->main_by_group
								]);
			//inserting cross
			ProductCross::insert(['uid'						=> $new_uid,
									'article'				=> $new_cross['article'],
									'akey'					=> $new_cross['akey'],
									'brand'					=> $new_cross['brand'],
									'bkey'					=> $new_cross['bkey'],
									'pkey'					=> $new_cross['pkey'],
									// 'name'					=> $new_cross['name'],
									'name'					=> $new_cross['name'] ?? $product->name,
									'main_by_brand'			=> $new_cross['main_by_brand'],
									'main_by_group'			=> $new_cross['main_by_group']
								]);
								
			$crosses_group = ProductCross::select('article','brand','name','code','main_by_group','main_by_brand','uid','id')->where('uid','=',$new_uid)->get();//getting crosses group by uid

			return response()->json([
					'status'  => 1 , 
					'message' => ['Crosses group created, successfully added!', 'success'],
					'info'    => $crosses_group,
				]);
		}
	}

	public static function product_editcross(Request $request)
	{
		$edit				= "true";
		$pkey				= $request->pkey;
		$uid				= $request->uid;
		$brands				= Brand::orderBy('brand', 'ASC')->get();

		$cross				= ProductCross::where('id', '=', $request->cross_id)->where('uid', '=', $uid)->get()->first()->toArray();
		
		return view('inventory.products.crosses', compact('product','cross','edit','brands'));
	}

	public static function product_update_cross(Request $request)
	{
		$cross_id			= $request->cross_id;
		$uid				= $request->uid;
		
		$new_cross							= [];
		$new_cross['article']				= $request->article;
		$new_cross['akey']					= Functions::SingleKey($request->article);
		$new_cross['brand']					= $request->brand;
		$new_cross['bkey']					= Functions::SingleKey($request->brand,true);
		$new_cross['name']					= $request->name;
		$new_cross['code']					= "Local";
		$new_cross['pkey']					= $new_cross['bkey'] . $new_cross['akey'];
		$new_cross['main_by_group']			= ($request->main_by_group == 1) ? 1 : 0 ;
		$new_cross['main_by_brand']			= ($request->main_by_brand == 1) ? 1 : 0 ;

		ProductCross::where('id', '=', $cross_id)->where('uid', '=', $uid)->update($new_cross);

		$crosses_group = ProductCross::select('article','brand','name','code','main_by_group','main_by_brand','uid','id')->where('uid','=',$uid)->get();//getting crosses group by uid

		return response()->json([
				'status'  => 1 , 
				'message' => ['Crosses successfully updated!', 'success'],
				'info'    => $crosses_group,
			]);
	}
	
	public function product_delete_cross(Request $request)
	{
		$cross_id			= $request->cross_id;
		$uid				= $request->uid;
		
		$cross = ProductCross::where('id', '=', $cross_id)->where('uid', '=', $uid)->delete();

		$crosses_group = ProductCross::select('article','brand','name','code','main_by_group','main_by_brand','uid','id')->where('uid','=',$uid)->get();//getting crosses group by uid

		return response()->json([
				'status'  => 1 , 
				'message' => ['Crosses successfully deleted!', 'success'],
				'info'    => $crosses_group,
			]);
	}
	
	/////////////////////////////////////////////////////////////////////////// ** crosses ** ///////////////////////////////////////////////////////////////////////////
	
	//////////////////////////////////////////////////////////////////// ** product Live Search ** ////////////////////////////////////////////////////////////////////
	public static function productLiveSearch(Request $request)
	{
		$search					= strip_tags($request->productLive);

		$data = Product::select('id','article','brand','full_name','description')
			->where('products.article', 'LIKE', "%${search}%")
			->orWhere('products.akey', 'LIKE', "%${search}%")//does not works
			->orWhere('products.brand', 'LIKE', "%${search}%")
			->orWhere('products.full_name', 'LIKE', "%${search}%")
			->orWhere('products.description', 'LIKE', "%${search}%")//does not works
			->get();
		
        return response()->json($data);
	}

}