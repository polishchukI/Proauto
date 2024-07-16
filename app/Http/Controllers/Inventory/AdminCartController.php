<?php

namespace App\Http\Controllers\Inventory;

use Illuminate\Http\Request;

use PDF;

use Carbon\Carbon;

use Illuminate\Support\Str;

use App\Models\Client\Client;
use App\Models\Client\ClientAuto;

use App\Models\Brand\Brand;

use App\Models\Inventory\Currency;
use App\Models\Inventory\Warehouse;
use App\Models\Inventory\AdminCart;
use App\Models\Inventory\Provider;
use App\Models\Inventory\ProviderPrice;
use App\Models\Inventory\InventorySetting;

use App\Models\Product\Product;
use App\Models\Product\ProductStock;
use App\Models\Product\ProductPrice;
use App\Models\Product\ProductCross;
use App\Models\Product\ProductCategory;
use App\Models\Product\ProductGroup;
use App\Models\Product\ProductAdminCart;

use App\Models\Catalog\CatalogArticle;
use App\Models\Catalog\CatalogArticleCross;

use Picqer\Barcode\BarcodeGeneratorHTML;

use App\Http\Controllers\Controller;
use App\Http\Controllers\WSController;
use App\Http\Controllers\Inventory\AddProductController;
use App\Http\Controllers\FunctionsController as Functions;

class AdminCartController extends Controller
{
    public function index()
    {
        $admincarts = AdminCart::paginate(25);

        return view('inventory.admincarts.index', compact('admincarts'));
    }

    public function create()
    {
        $clients			= Client::all();
        $warehouses			= Warehouse::all();
        $currencies			= Currency::where('active','=','1')->get();
		
        return view('inventory.admincarts.create', compact('pricetypes','clients','currencies','warehouses'));
    }
	
	public function store(Request $request, AdminCart $admincart)
    {
		$requestData				=  $request->all();

		$created_at					= Carbon::now();
		$dateprefix					= $created_at->format('Y m d');
		$code_6						= sprintf("%06s",(string)$request->client_id);
		$timeStamp					= Functions::GenerateTimestamp();
		$requestData['barcode']		= "" . $dateprefix . " " . $timeStamp . " " . $code_6 ."";

        $admincart = $admincart->create($requestData);
        
        return redirect()->route('admincarts.show', ['admincart' => $admincart->id])->withStatus('Admincart registered successfully.');
    }
	
    public function show(Request $request, AdminCart $admincart)
    {
		$docHeaderValues = $this->docHeaderValues($admincart);

		$admincart->docCount						= $docHeaderValues['docCount'];
		$admincart->docTotal						= $docHeaderValues['docTotal'];
		$admincart->docQuantity						= $docHeaderValues['docQuantity'];
		
		return view('inventory.admincarts.show', compact('admincart'));
    }

    public function client_vehicles(Request $request)
	{		
		$data = [];
		$client_id = $request->client_id;
		$q = ClientAuto::select('id','name')->where('client_id','=', $client_id)->get();
		if($q)
		{
			$data = $q->toArray();
		}
		return response()->json($data);
		
	}
	//search_in_prices_and_ws_page
	public function admincart_product_search(Request $request, Admincart $admincart, ProductAdminCart $productadmincart)
	{
		return view('inventory.admincarts.addproduct_search', compact('admincart'));
	}

	//search_pricessing_start
    public function admincart_search(Request $request, Admincart $admincart)
	{
		$data			= [];
		$temp_key		= [];
		$count			= 0;
		$result			= [];

		$searchnumber	= $request->admincart_product_search_input;
		$admincart_id	= $request->admincart_id;
		
		$searchnumber_uppercase = Str::upper($searchnumber);
		$search = Functions::SingleKey($searchnumber_uppercase);
        
		$catalog_result = $this->admincart_search_in_catalog($search);//tecdoc request -

		//request to update prices and stocks from webservice
		$ws_result = $this->admincart_search_in_ws($search);

		$crosses_result = $this->admincart_search_in_crosses($search);//crosses
		$oem_result = $this->admincart_search_in_oem_catalog($search);//td oem
		$products_result = $this->admincart_search_in_products($search);//base
		$price_result = $this->admincart_search_in_prices($search);//provider prices+
		$result = array_merge($catalog_result,$crosses_result, $oem_result,$products_result,$price_result);
		
		foreach ($result as $item)
		{
			$count = $count + 1;
			$bkey = Functions::SingleKey($item["brand"], true);
			$akey = Functions::SingleKey($item["article"]);
			$pkey = $bkey . $akey;
			if (!in_array($pkey, $temp_key))
			{
				$temp_key[] = $pkey;
				$product_id = $this->admincart_product_id($pkey);
				$stocks = $this->admincart_productstocks($product_id);
				$price = $this->admincart_productprices($product_id);
				$data[] = ["count"				=> $count,
							"product_id"		=> $product_id,
							"admincart_id"		=> $admincart_id,
							"pkey"				=> $pkey,
							"bkey"				=> $bkey,
							"akey"				=> $akey,
							"article"			=> $item["article"],
							"brand"				=> $item["brand"],
							"name"				=> htmlspecialchars($item["name"], ENT_QUOTES, "utf-8", TRUE), // Converts double and single quotes
							"stocks"			=> (int)$stocks,
							"price"				=> $price,
							"superseded"		=> ""];
			}
		}
		return response()->json($data);
		
	}

	public function admincart_search_in_products($number)
    {
        $result = [];
        $products_q = Product::where('akey','=', $number)->select('bkey', 'akey', 'article', 'brand', 'name')->get();
        if($products_q)
		{
			$result = $products_q->toArray();
		}
		return $result;
    }

	public function admincart_search_in_oem_catalog($number)
	{
		$result = [];
		try{
			$q = CatalogArticleCross::select('article_cross.PartsDataSupplierArticleNumber AS article', 'suppliers.description AS brand',
				'articles.NormalizedDescription AS name', 'suppliers.id AS supplier_id')
				->leftjoin('manufacturers','article_cross.manufacturerId','=','manufacturers.id')
				->leftjoin('suppliers','article_cross.SupplierId','=','suppliers.id')
				->join('articles', function ($join) {$join->on('articles.DataSupplierArticleNumber', '=', 'article_cross.PartsDataSupplierArticleNumber')->on('articles.supplierId', '=', 'article_cross.SupplierId');})
				->where('OENbr','=', $number)
				->orWhere('article_cross.PartsDataSupplierArticleNumber','=', $number)
				->orderBy('article_cross.PartsDataSupplierArticleNumber', 'asc')
				->distinct()->get();
				if($q)
				{
					$result = $q->toArray();
				}
		}
		catch(\Exception $e)
		{
			$result = [];
		}
		return $result;
	}
	
	public function admincart_search_in_prices($number)
    {
        $result = [];
        $prices_q = ProviderPrice::where('akey','=', $number)->select('bkey', 'akey', 'article', 'brand', 'provider_product_name as name')->get();
        if($prices_q)
		{
			$result = $prices_q->toArray();
		}
		return $result;
    }
    
    public function admincart_search_in_ws($number)
    {
        $result = [];
        /////////////////////////WS
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
			if (config('tecdoc_config.request_ws_only_searched') == 1)
			{
				$WSpartsArray[$number] = $SearchedArray;
			}
			else
			{
				$WSpartsArray = $result;
				if (count($WSpartsArray) <= 0)
				{
					$WSpartsArray[$number] = $SearchedArray;
				}
			}
            
			$WS = new WSController();
			$WS->SearchPrices($WSpartsArray, [], ["cache_mode" => true, "links_take" => "OFF", "pkey" => $number, "search" => "Y", "sid"=>""]);
		}
		/////////////////////////
    }
	public  function admincart_search_in_crosses($number)
	{
		$result = [];
		$LinksCount = 0;

		$pkey_uid_array			= ProductCross::where('akey','=',$number)->get();
		
		if (!is_null($pkey_uid_array))
		{
			foreach($pkey_uid_array as $item)
			{
				$uid				= $item->uid;
				$crossesArray			= ProductCross::where('uid','=',$uid)->get();
				foreach($crossesArray as $resultItem)
				{
					$result[$resultItem["pkey"]] = [
										"pkey"			=> $resultItem["pkey"],
										"bkey"			=> $resultItem["bkey"],
										"brand"			=> $resultItem["brand"],
										"akey"			=> $resultItem["akey"],
										"article"		=> $resultItem["article"],
										"link_side"		=> $resultItem["side"],
										"code"			=> $resultItem["code"],
										"name"			=>  $resultItem["name"] ?? ""];
				}
				
			}
			
		}
		return $result;
	}
	public function admincart_search_in_catalog($number)
	{
		$result = [];
		try{
			$q = CatalogArticle::select('article_oe.OENbr as article','articles.NormalizedDescription AS name','manufacturers.description AS brand')
			->leftjoin('article_oe', function ($join) {$join->on('article_oe.datasupplierarticlenumber','=', 'articles.DataSupplierArticleNumber')->on('article_oe.supplierid','=', 'articles.supplierId');})
			->join('manufacturers','article_oe.manufacturerId','=','manufacturers.id')
			->where('article_oe.OENbr','=', $number)
			->get();
			if($q)
			{
				$result = $q->toArray();
			}
		}
		catch(\Exception $e)
		{
			$result = [];
		}
		return $result;
	}
	//search_pricessing_start	
	public static function admincart_product_id($pkey)
	{
		$product_id = "";
		$q = Product::select('products.id')->where('pkey','=', $pkey)->first();
			if($q)
			{
				$product_id = $q->id;
			}
		
		return $product_id;
	}

	public static function admincart_productstocks($product_id)
	{
		$stocks = 0;
		$stocks = ProductStock::where('product_id','=', $product_id)->get()->sum('quantity');
		
		return $stocks;
	}
	
	public static function admincart_productprices($product_id)
	{
		$price = 0;
		$q = ProductPrice::select('price')->where('product_id','=', $product_id)->where('price_type','=', "out")->orderBy('id', 'desc')->first();
			if($q)
			{
				$price = $q->price;
			}
		
		return $price;
	}
	
	public static function admincart_product_by_aid($brand, $article)
	{
		$product = ArticleTecdoc::select('ARTICLES.ART_ID AS aid',
							'ARTICLES.ART_ARTICLE_NR AS article',
							'SUPPLIERS.SUP_BRAND AS brand')
							->where('ARTICLES.ART_ID','=', $aid)
							->join('SUPPLIERS', 'SUPPLIERS.SUP_ID', '=', 'ARTICLES.ART_SUP_ID')
							->first();
		
		return $product;
	}
	
	static function catalog_product_info(Request $request)
	{
		$article = $akey = $request->article;
		$brand = $bkey = $request->brand;
		// mb_internal_encoding("UTF-8");
		$ResultArray = [];
		
		$product = Product::where('pkey','=', $bkey . $akey)->first()->toArray();
		
		$ResultArray["full_name"]				= $product["full_name"];
		$ResultArray["name"]					= $product["name"];
		$ResultArray["brand"]					= Str::upper($product["brand"]);
		$ResultArray["bkey"]					= Functions::SingleKey($product["brand"],true);
		$ResultArray["article"]					= Str::upper($product["article"]);
		$ResultArray["akey"]					= Functions::SingleKey($product["article"]);
		$ResultArray["pkey"]					= Functions::SingleKey($product["brand"],true) . Functions::SingleKey($product["article"]);
		$ResultArray["image"]					= [];
		$ResultArray["applicability"]			= [];
		$ResultArray["prices"]					= [];
		$ResultArray["properties"]				= [];
		$ResultArray["crosses"]					= [];

		/////////////////////////////
		if(isset($ResultArray["pkey"]))
		{
			$ProviderPrices = ProviderPrice::where("pkey", $ResultArray["pkey"])->orderBy('price')->get()->toArray();
			foreach($ProviderPrices as $Price)
			{
				$Price = Functions::FormatPrice($Price);
				$ResultArray["prices"][] = $Price;
			}
		}

		
		//Logo media folder
		$LogoMedia = "/images/logomedia/" . $ResultArray["bkey"] . ".webp";
		$ArtMedia = "/images/artmedia/" . $ResultArray["bkey"] . "/" . $ResultArray["akey"] . ".jpg";
		if(file_exists($_SERVER["DOCUMENT_ROOT"] . $ArtMedia))
		{
			$ResultArray["image"] = $ArtMedia;
		}
		elseif(file_exists($_SERVER["DOCUMENT_ROOT"] . $LogoMedia))
		{
			$ResultArray["image"] = $LogoMedia;
		}
		else
		{
			$ResultArray["image"] = $LogoMedia;
		}
		
		// if(array_key_exists('aid',$ResultArray))
		// {
		// 	if($ResultArray["aid"]>0)
		// 	{
		// 		$Properties = TecdocController::GetProperties($ResultArray["aid"]);
		// 		foreach ($Properties as $Prop)
		// 		{
		// 			$ResultArray["properties"][] = ["name"=>$Prop["name"],"VALUE"=>$Prop["VALUE"]];
		// 		}
		// 	}
		// 	if($ResultArray["aid"]>0)
		// 	{
		// 		$ApplicabilityBrand = TecdocController::GetAppBrands($ResultArray["aid"]);
		// 		foreach ($ApplicabilityBrand as $AppBrand)
		// 		{
		// 			$ResultArray["applicability_brand"][] = ["MFA_BRAND"=>$AppBrand["MFA_BRAND"],"MFA_MFC_CODE"=>$AppBrand["MFA_MFC_CODE"]];
		// 		}
		// 	}
		
		// 	if(array_key_exists('applicability_brand',$ResultArray))
		// 	{
		// 		foreach ($ResultArray["applicability_brand"] as $code)
		// 		{
		// 			$applicability = TecdocController::GetApplicability($ResultArray["aid"],$code["MFA_MFC_CODE"]);
		// 			foreach ($applicability as $App)
		// 			{
		// 				$MODURL = Functions::GetURLNameByModID($App["MFA_BRAND"], $App["MOD_ID"]);
		// 				$URL = Functions::GenerateURL(["brand" => $App["MFA_BRAND"], "MOD_FURL" => $MODURL, "TYP_ID" => $App["TYP_ID"], "ENGINE" => $App["ENG_CODE"], "TYPE_NAME" => $App["TYP_CDS_TEXT"]]);
		// 				$START = Functions::DateFormat($App["TYP_PCON_START"], 'to', 'year');
		// 				$END = Functions::DateFormat($App["TYP_PCON_END"], 'to', 'year');
		// 				$START = substr($START, 2, 2);
		// 				if (0 < intval($END))
		// 				{
		// 					$END = substr($END, 2, 2);
		// 				}
		// 				else
		// 				{
		// 					$END = ' - ';
		// 				}
		// 				$ResultArray["applicability"][$code["MFA_BRAND"]][] = ["TYP_ID"=>$App["TYP_ID"],"MOD_ID"=>$App["MOD_ID"],"MFA_BRAND"=>$App["MFA_BRAND"],
		// 									"MOD_CDS_TEXT"=>$App["MOD_CDS_TEXT"],"TYP_CDS_TEXT"=>$App["TYP_CDS_TEXT"],"START"=>$START,
		// 									"END"=>$END,"TYP_CCM"=>$App["TYP_CCM"],"TYP_KW_FROM"=>$App["TYP_KW_FROM"],
		// 									"TYP_HP_FROM"=>$App["TYP_HP_FROM"],"TYP_CYLINDERS"=>$App["TYP_CYLINDERS"],"ENG_CODE"=>$App["ENG_CODE"],
		// 									"TYP_FUEL_DES_TEXT"=>$App["TYP_FUEL_DES_TEXT"],"TYP_BODY_DES_TEXT"=>$App["TYP_BODY_DES_TEXT"],
		// 									"URL"=>$URL];
		// 			}
		// 		}
		// 	}
		// }
		
		if($ResultArray["pkey"])
		{
			$crosses_group = ProductCross::where('pkey','=', $ResultArray["pkey"])->first();
			if($crosses_group)
			{
				$uid = $crosses_group->uid;
				
				$dataSQL = ProductCross::where('uid','=', $uid)->get()->toArray();

				foreach ($dataSQL as $dataItem)
				{
					$ResultArray["crosses"][] = ["article"			=>$dataItem["article"],
												"brand"				=>$dataItem["brand"],
												"code"				=>$dataItem["code"],
												"name"				=>$dataItem["name"],
												"main_by_group"				=>$dataItem["main_by_group"],
												"main_by_brand"				=>$dataItem["main_by_brand"],
											];
				}
			}
		}
		
    	return view('inventory.admincarts.product_info_modal', compact('ResultArray'));
	}

	public function destroy(AdminCart $admincart)
    {
		ProductAdminCart::where('admincart_id','=',$admincart->id)->delete();
        $admincart->delete();

        return redirect()->route('admincarts.index')->withStatus('Корзина удалена!');
    }

	public static function cart_addproduct(Request $request)
	{
		$requestData = $request->all();
		$edit = "false";
		$admincart = AdminCart::where('id', $request->admincart_id)->first();
		
		$product = Product::select('products.id as product_id', 'products.article', 'products.brand', 'products.name')
				->orderby('products.article', 'asc')
				->where('products.id','=',$request->product_id)
				->first()
				->toarray();
				
		$product['admincart_id'] = $admincart->id;
		
		return view('inventory.admincarts.addproduct_modal', compact('product','edit'));
	}

	//add_to_base_from_search_modal
	public static function catalog_product_add_to_base(Request $request)
	{
		// $req = $request->all();
		$from_search			= "true";
		$admincart_id			= $request->admincart_id;
		$brand					= $request->brand;
		$product_name			= $request->product_name;
		$article				= $request->article;
		$categories				= ProductCategory::all()->toArray();
		$groups					= ProductGroup::all()->toArray();
		
		return view('inventory.admincarts.catalog_product_add_to_base', compact('categories','brand','article','product_name','groups','from_search','admincart_id'));
	}

	//add_to_base_from_search_modal_store
	public static function catalog_product_add_to_base_store(Request $request, Product $product_model)
	{
		$brand						= $request->brand;
		$article					= $request->article;
		$product_name				= $request->product_name;
		$category_id				= $request->category;
		$product_group_id			= $request->group;
		$group_name					= ProductGroup::where('id','=',$product_group_id)->first()->name;
		$akey						= Functions::SingleKey($article);
		$bkey						= Functions::SingleKey($brand,true);
		$pkey						= $bkey . $akey;

		$requestData['article']						= $article;
		$requestData['akey']						= $akey;
		$requestData['brand']						= $brand;		
		$requestData['bkey']						= $bkey;		
		$requestData['pkey']						= $pkey;		
		$requestData['name']						= $product_name ?? $group_name;		
		$requestData['product_category_id']			= $category_id;		
		$requestData['product_group_id']			= $product_group_id;		
		$requestData['full_name']					= ($product_name ?? $group_name). ", " . $brand . ", " . $article;
		
		$new_product = $product_model->create($requestData);
		
		return response()->json([
			'status'  => 1 , 
			'message' => ['Товар добавлен', 'success'],

		]);
	}

	//add_to_base_from_search_start
	public static function catalog_product_create_store(Request $request, Product $product_model)
	{
		$brand						= $request->brand;
		$article					= $request->article;
		$product_name				= $request->product_name;
		$category_id				= $request->category;
		$product_group_id			= $request->group;
		$group_name					= ProductGroup::where('id','=',$product_group_id)->first()->name;
		$akey						= Functions::SingleKey($article);
		$bkey						= Functions::SingleKey($brand,true);
		$pkey						= $bkey . $akey;

		$requestData['article']						= $article;
		$requestData['akey']						= $akey;
		$requestData['brand']						= $brand;		
		$requestData['bkey']						= $bkey;		
		$requestData['pkey']						= $pkey;		
		$requestData['name']						= $product_name ?? $group_name;		
		$requestData['product_category_id']			= $category_id;		
		$requestData['product_group_id']			= $product_group_id;		
		$requestData['full_name']					= ($product_name ?? $group_name). ", " . $brand . ", " . $article;
		
		$new_product = $product_model->create($requestData);
		
		return response()->json([
			'status'  => 1 , 
			'message' => ['Товар добавлен', 'success'],

		]);
	}

	public static function catalog_product_add_to_base_and_cart_store(Request $request, Product $product_model)
	{
		$brand						= $request->brand;
		$article					= $request->article;
		$product_name				= $request->product_name;
		$category_id				= $request->category;
		$product_group_id			= $request->group;
		$group_name					= ProductGroup::where('id','=',$product_group_id)->first()->name;
		$akey						= Functions::SingleKey($article);
		$bkey						= Functions::SingleKey($brand,true);
		$pkey						= $bkey . $akey;

		$requestData['article']						= $article;
		$requestData['akey']						= $akey;
		$requestData['brand']						= $brand;		
		$requestData['bkey']						= $bkey;		
		$requestData['pkey']						= $pkey;		
		$requestData['name']						= $product_name ?? $group_name;		
		$requestData['product_category_id']			= $category_id;		
		$requestData['product_group_id']			= $product_group_id;		
		$requestData['full_name']					= ($product_name ?? $group_name). ", " . $brand . ", " . $article;
		
		$new_product = $product_model->create($requestData);//creating product in to base

		//adding product in to cart
		$product_id						= $new_product->id;
		$admincart_id					= $request->admincart_id;
		$price							= floatval($request->price)??0;//????
		$quantity						= $request->quantity??1;

		//additional data
		$admincart						= AdminCart::findOrFail($admincart_id);
		$product						= Product::findOrFail($product_id);
		$warehouse_id					= $admincart->warehouse_id;
		$stock							= AddProductController::get_product_stocks($product_id);
		$currency						= $admincart->currency;
		$price							= ($price !=0) ? $price : AddProductController::get_product_price($product_id, 'out', $currency);
		$total_amount					= $price * $quantity;
		$created_at						= Carbon::now();


		//writing into recieved_products table
		$requesteddata['admincart_id']		= $admincart_id;
		$requesteddata['currency']			= $currency;
		$requesteddata['warehouse_id']		= $warehouse_id;
		$requesteddata['product_id']		= $product_id;
		$requesteddata['price']				= $price;
		$requesteddata['quantity']			= $quantity;
		$requesteddata['total_amount']		= $total_amount;
		$requesteddata['created_at']		= $created_at;
		
		ProductAdminCart::create($requesteddata);

		$docHeaderValues = self::docHeaderValues($admincart);

		return response()->json([
			'status'  => 1 , 
			'message' => ['Товар добавлен', 'success'],
			'docHeaderValues' => $docHeaderValues,
			'info'    => [
				'product_id'		=> $product_id,
				'admincart_id'		=> $admincart_id,
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

	public static function catalog_product_create_add_to_cart_store(Request $request, Product $product_model)
	{
		$brand						= $request->brand;
		$article					= $request->article;
		$product_name				= $request->product_name;
		$category_id				= $request->category;
		$product_group_id			= $request->group;
		$group_name					= ProductGroup::where('id','=',$product_group_id)->first()->name;
		$akey						= Functions::SingleKey($article);
		$bkey						= Functions::SingleKey($brand,true);
		$pkey						= $bkey . $akey;

		$requestData['article']						= $article;
		$requestData['akey']						= $akey;
		$requestData['brand']						= $brand;		
		$requestData['bkey']						= $bkey;		
		$requestData['pkey']						= $pkey;		
		$requestData['name']						= $product_name ?? $group_name;		
		$requestData['product_category_id']			= $category_id;		
		$requestData['product_group_id']			= $product_group_id;		
		$requestData['full_name']					= ($product_name ?? $group_name). ", " . $brand . ", " . $article;
		
		$new_product = $product_model->create($requestData);//creating product in to base

		//adding product in to cart
		$product_id						= $new_product->id;
		$admincart_id					= $request->admincart_id;
		$price							= floatval($request->price)??0;//????
		$quantity						= $request->quantity??1;

		//additional data
		$admincart						= AdminCart::findOrFail($admincart_id);
		$product						= Product::findOrFail($product_id);
		$warehouse_id					= $admincart->warehouse_id;
		$stock							= AddProductController::get_product_stocks($product_id);
		$currency						= $admincart->currency;
		$price							= ($price !=0) ? $price : AddProductController::get_product_price($product_id, 'out', $currency);
		$total_amount					= $price * $quantity;
		$created_at						= Carbon::now();


		//writing into recieved_products table
		$requesteddata['admincart_id']		= $admincart_id;
		$requesteddata['currency']			= $currency;
		$requesteddata['warehouse_id']		= $warehouse_id;
		$requesteddata['product_id']		= $product_id;
		$requesteddata['price']				= $price;
		$requesteddata['quantity']			= $quantity;
		$requesteddata['total_amount']		= $total_amount;
		$requesteddata['created_at']		= $created_at;
		
		ProductAdminCart::create($requesteddata);

		$docHeaderValues = self::docHeaderValues($admincart);

		return response()->json([
			'status'  => 1 , 
			'message' => ['Товар добавлен в базу и документ', 'success'],
			'docHeaderValues' => $docHeaderValues,
			'info'    => [
				'product_id'		=> $product_id,
				'admincart_id'		=> $admincart_id,
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
	
	public static function catalog_product_create(Request $request)
	{
		$from_search = "false";
		$admincart_id = $request->admincart_id;
		$categories = ProductCategory::all()->toArray();
		$brands = Brand::all()->toArray();
		$groups = ProductGroup::all()->toArray();

		return view('inventory.admincarts.catalog_product_add_to_base', compact('categories','groups','from_search','admincart_id','brands'));
	}

	// public static function cart_product_store(Request $request, AdminCart $admincart, ProductAdminCart $productadmincart)
    // {
	// 	$requesteddata['admincart_id']	= $request->admincart_id;
	// 	$admincart						= AdminCart::findOrFail($request->admincart_id);
	// 	$requesteddata['currency']		= $admincart->currency;
	// 	$requesteddata['warehouse_id']	= $admincart->warehouse_id;
	// 	$requesteddata['product_id']	= $request->product_id;
	// 	$requesteddata['price']			= $request->price;
	// 	$requesteddata['quantity']		= $request->quantity;
	// 	$requesteddata['total_amount']	= $requesteddata['price'] * $requesteddata['quantity'];
	// 	$productadmincart->create($requesteddata);
		
	// 	return back();
	// 	// return response()->json($requesteddata);
    // }

	public function finalize(AdminCart $admincart)
    {
        $finalized_at = Carbon::now()->toDateTimeString();

		$adminCartProducts = ProductAdminCart::where('admincart_id','=',$admincart->id)->get();
		
        $admincart->quantity = $adminCartProducts->sum('quantity');
        $admincart->total_amount = $adminCartProducts->sum('total_amount');
        $admincart->finalized_at = $finalized_at;
		
        $admincart->save();

        return back()->withStatus('Cart successfully completed.');
    }

	/////////////////////////
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

	public function admincart_product_selector(Request $request, Admincart $admincart, ProductAdminCart $productadmincart)
	{
			$root_id			= 10001;
			$treejs				= '';
			$this->getTreeJS($root_id, $treejs);
			$treeJS				= $treejs;

			return view('inventory.admincarts.addproduct_table', compact('admincart', 'treeJS'));
	
	}

	public function admincart_products_filter_by_group(Request $request)
    {
		$data = [];
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
	
	public static function admincart_add_single_product_store(Request $request)
	{
		//request data
		$product_id						= $request->productLive;
		$admincart_id					= $request->admincart_id;
		$price							= floatval($request->price);//????
		$quantity						= $request->quantity;

		//additional data
		$admincart						= AdminCart::findOrFail($admincart_id);
		$product						= Product::findOrFail($product_id);
		$warehouse_id					= $admincart->warehouse_id;
		$stock							= AddProductController::get_product_stocks($product_id);
		$currency						= $admincart->currency;
		$price							= ($price !=0) ? $price : AddProductController::get_product_price($product_id, 'out', $currency);
		$total_amount					= $price * $quantity;
		$created_at						= Carbon::now();

		//writing into recieved_products table
		$requesteddata['admincart_id']		= $admincart_id;
		$requesteddata['currency']			= $currency;
		$requesteddata['warehouse_id']		= $warehouse_id;
		$requesteddata['product_id']		= $product_id;
		$requesteddata['price']				= $price;
		$requesteddata['quantity']			= $quantity;
		$requesteddata['total_amount']		= $total_amount;
		$requesteddata['created_at']		= $created_at;
		
		ProductAdminCart::create($requesteddata);

		$docHeaderValues = self::docHeaderValues($admincart);

		return response()->json([
			'status'  => 1 , 
			'message' => ['Товар добавлен', 'success'],
			'docHeaderValues' => $docHeaderValues,
			'info'    => [
				'product_id'		=> $product_id,
				'admincart_id'		=> $admincart_id,
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

	/////////////////////////
	public static function admincart_add_product(Request $request)
	{
		$edit = "false";
		$product_id							= $request->product_id;
		$admincart_id						= $request->admincart_id;

		$admincart							= AdminCart::where('id', $admincart_id)->first();		
		$product							= Product::select('products.id as product_id','products.article','products.brand','products.name','products.full_name')
												->orderby('products.article', 'asc')
												->where('products.id','=',$product_id)
												->first()->toarray();				
		//last price
		$product['price']				= AddProductController::get_product_price($product_id, 'out', $admincart->currency);
		$product['admincart_id']			= $admincart_id;

		return view('inventory.admincarts.addproduct_modal', compact('product','edit'));
	}

	public static function admincart_add_product_store(Request $request)
	{
		//request data
		$product_id						= $request->product_id;
		$admincart_id					= $request->admincart_id;
		$price							= floatval($request->price);//????
		$quantity						= $request->quantity;

		//additional data
		$admincart						= AdminCart::findOrFail($admincart_id);
		$product						= Product::findOrFail($product_id);
		$warehouse_id					= $admincart->warehouse_id;
		$stock							= AddProductController::get_product_stocks($product_id);
		$currency						= $admincart->currency;
		$price							= ($price !=0) ? $price : AddProductController::get_product_price($product_id, 'out', $currency);
		$total_amount					= $price * $quantity;
		$created_at						= Carbon::now();


		//writing into recieved_products table
		$requesteddata['admincart_id']		= $admincart_id;
		$requesteddata['currency']			= $currency;
		$requesteddata['warehouse_id']		= $warehouse_id;
		$requesteddata['product_id']		= $product_id;
		$requesteddata['price']				= $price;
		$requesteddata['quantity']			= $quantity;
		$requesteddata['total_amount']		= $total_amount;
		$requesteddata['created_at']		= $created_at;
		
		ProductAdminCart::create($requesteddata);

		$docHeaderValues = self::docHeaderValues($admincart);

		return response()->json([
			'status'  => 1 , 
			'message' => ['Товар добавлен', 'success'],
			'docHeaderValues' => $docHeaderValues,
			'info'    => [
				'product_id'		=> $product_id,
				'admincart_id'		=> $admincart_id,
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

	public function admincart_edit_product(Request $request)
    {
		$edit = "true";
		$admincart_id = $request->admincart_id;
		$is_finalized = Admincart::where('id','=',$admincart_id)->first()->finalized_at;

		$product_id = $request->product_id;
		
		$product = ProductAdminCart::select('product_admin_carts.quantity','product_admin_carts.price','product_admin_carts.admincart_id','products.id as product_id','products.article','products.brand','products.name','products.full_name')
					->where('product_id','=',$product_id)
					->join('products', 'products.id', '=', 'product_admin_carts.product_id')
					->where('admincart_id','=',$admincart_id)
					->first();
		if($admincart_id)
		{
			$product = $product->toarray();
		}
		
		return view('inventory.admincarts.addproduct_modal', compact('product','edit'));
    }
	

	public function admincart_update_product_store(Request $request)
	{
		$product_id						= $request->product_id;
		$admincart_id						= $request->admincart_id;
		$price							= floatval($request->price);//????
		$quantity						= $request->quantity;

		$item = ProductAdminCart::where('admincart_id','=',$admincart_id)->where('product_id','=',$product_id)->get()->first();

		if ($item)
		{
            $old_price    = $item->price;
            $old_quantity = $item->quantity;
            $new_price    = $request->price;
            $new_quantity = $request->quantity;
            $new_total_amount = $new_price * $new_quantity;

            if ($old_price != $new_price || $old_quantity != $new_quantity)
			{
                $admincart = AdminCart::find($admincart_id);
                if ($admincart) {
                    $item = $item->update([
                        'price' => $new_price,
                        'quantity' => $new_quantity,
                        'total_amount' => $new_total_amount,
                    ]);

					$docHeaderValues = self::docHeaderValues($admincart);

					if ($item) {
                        return response()->json([
                            'status'  => 1 , 
                            'message' => ['Обновлен', 'success'],
                            'docHeaderValues' => $docHeaderValues,
                            'info'    => [
                                    'product_id'    => $product_id,
                                    'price' => $new_price,
                                    'quantity' => $new_quantity,
                                    'total_amount' => $new_total_amount,
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
    
	public function clear_products_table(AdminCart $admincart, ProductAdminCart $productadmincart)
    {
		ProductAdminCart::where('admincart_id','=',$admincart->id)->delete();
		return back()->withStatus('Products table cleared.');
    }	
	
	public function admincart_delete_product(Request $request)
    {
		if (!$request->ajax()) {
			abort('404');
		};

		$product_id						= (int)$request->product_id;
		$admincart_id						= (int)$request->admincart_id;

		$item = ProductAdminCart::where('admincart_id','=',$admincart_id)->where('product_id','=',$product_id)->get()->first();
		
		if ($item)
		{
			$old_price    = $item->price;
			$old_quantity = $item->quantity;

			$admincart = AdminCart::find($admincart_id);
			if ($admincart)
			{
				$item = $item->delete();

				$docHeaderValues = self::docHeaderValues($admincart);

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
		
	public function admincart_print(Admincart $admincart)
    {
		$products = ProductAdminCart::select('products.article',
							'products.brand',
							'products.name',
							'product_admin_carts.quantity',
							'product_admin_carts.price',
							'product_admin_carts.total_amount as total')
				->leftjoin('products','products.id','=','product_admin_carts.product_id')
				->where('product_admin_carts.admincart_id','=',$admincart->id)->get();
		
		$client =  Client::where('id','=', $admincart->client_id)->first()->toArray();
		
		$admincart["subtotal"] = $products->sum('total');
		$admincart["tax"] = 0;
		$admincart["terms_of_delivery"] = InventorySetting::find(1)->terms_of_delivery;
		$admincart["total_amount"] = $admincart["subtotal"]+$admincart["tax"];

		$generator = new BarcodeGeneratorHTML();
        $barcode = $generator->getBarcode((string)$admincart->barcode, $generator::TYPE_CODE_128, 1, 25);
		
        $pdf = PDF::loadView('inventory.pdf.admincartinvoice', compact('admincart', 'barcode', 'products', 'client', 'billingaddress', 'shippingaddress'));
        $file_name = 'admincart-' . $admincart->id . '.pdf';
        return $pdf->stream($file_name)->header('Content-Type','application/pdf');
    }

	public function admincart_print_client(Admincart $admincart)
    {
		$products = ProductAdminCart::select('products.id as article',
							'products.brand',
							'products.name',
							'product_admin_carts.quantity',
							'product_admin_carts.price',
							'product_admin_carts.total_amount as total')
				->leftjoin('products','products.id','=','product_admin_carts.product_id')
				->where('product_admin_carts.admincart_id','=',$admincart->id)->get();
		
		$client =  Client::where('id','=', $admincart->client_id)->first()->toArray();
		
		$admincart["subtotal"] = $products->sum('total');
		$admincart["tax"] = 0;
		$admincart["terms_of_delivery"] = InventorySetting::find(1)->terms_of_delivery;
		$admincart["total_amount"] = $admincart["subtotal"]+$admincart["tax"];

		$generator = new BarcodeGeneratorHTML();
        $barcode = $generator->getBarcode((string)$admincart->barcode, $generator::TYPE_CODE_128, 1, 25);
		
        $pdf = PDF::loadView('inventory.pdf.admincartinvoice', compact('admincart', 'barcode', 'products', 'client', 'billingaddress', 'shippingaddress'));
        $file_name = 'admincart-' . $admincart->id . '.pdf';
        return $pdf->stream($file_name)->header('Content-Type','application/pdf');
    }

	//admincart_add_edit_comment
	public static function admincart_comment(Request $request)
	{
		$admincart_id						= $request->admincart_id;
		$comment							= AdminCart::where('id', $admincart_id)->first()->comment;
	
		return view('inventory.admincarts.comment', compact('admincart_id','comment'));
	}
	
	public static function admincart_comment_update(Request $request)
	{
		$comment		= $request->comment;
		$admincart		= Admincart::findOrFail($request->get('admincart_id'));

		$admincart->update([
			'comment' => $comment,
		]);
		
		if ($admincart)
		{
			$comment	= AdminCart::where('id', $admincart->id)->first()->comment;

			return response()->json([
				'status' 				=> 1 , 
				'message'				=> ['Изменен', 'success'],
				'comment'				=> $comment,
			]);
		}
	}

	public static function admincart_comment_delete(Request $request)
	{
		$admincart		= Admincart::findOrFail($request->get('admincart_id'));

		$admincart->update([
			'comment' => '',
		]);
		
		if ($admincart)
		{
			$comment	= AdminCart::where('id', $admincart->id)->first()->comment;

			return response()->json([
				'status' 				=> 1 , 
				'message'				=> ['Удалено', 'success'],
			]);
		}
	}

	public static function docHeaderValues(Admincart $admincart)
	{
		$docHeaderValues = [];

		$docCount				= 0;
		$docTotal				= 0;
		$docQuantity			= 0;

		$docTotalRequest = ProductAdminCart::where('admincart_id','=',$admincart->id)->get();

		$docHeaderValues['docCount']					= $docTotalRequest->count();
		$docHeaderValues['docQuantity']					= $docTotalRequest->sum('quantity');
		$docHeaderValues['docTotal']					= $docTotalRequest->sum('total_amount');
		
		return $docHeaderValues;
	}
}
