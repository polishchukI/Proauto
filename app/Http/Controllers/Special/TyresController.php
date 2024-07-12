<?php

namespace App\Http\Controllers\Special;


use Illuminate\Http\Request;

use App\Models\Blog\Post;
use App\Models\Special\Tyre;

use App\Models\Inventory\Provider;
use App\Models\Inventory\ProviderPrice;
use App\Models\Product\ProductRating;
use App\Models\Product\ProductCross;
use App\Models\Product\Product;

use App\Http\Controllers\Prices;
use App\Http\Controllers\Controller;
use App\Http\Controllers\WSController;
use App\Http\Controllers\Shop\ShopController;
use App\Http\Controllers\FunctionsController as Functions;

use Illuminate\Pagination\LengthAwarePaginator;
//////////seo
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
//////////seo;


class TyresController extends Controller
{

	public function index()
    {
        $tyres = Tyre::paginate(25);
        return view('inventory.tyres.index', compact('tyres'));
    }

	public function destroy(Tyre $tyre)
    {
		dd(comapct('tyre'));
        $tyre->delete();
        return redirect()->route('inventory.tyres.index')->withStatus('Tyre item removed successfully.');
    }
	
	public function create(Tyre $tyre)
    {

    }
	
	public function edit(Tyre $tyre)
    {

    }
	
	public function show(Tyre $tyre)
    {
		$bkey = $tyre->bkey;
		$akey = $tyre->akey;
		$pkey = $bkey . $akey;

		$product = Product::where('pkey','=',$pkey)->first();

        $uid = "";

		$pkey_uid			= ProductCross::where('pkey','=',$pkey)->first();

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
					"pkey"      => $akey,
					"bkey"      => "",
					"akey"      => $akey,
					"article"   => $akey,
					"brand"     => "",
					"td_name"   => "",
					"name"      => ""];
			
			$WSpartsArray[$akey] = $SearchedArray;
			try
			{
				$WS = new WSController();
				$WS->SearchPrices($WSpartsArray, [], ["cache_mode" => true, "links_take" => "OFF", "pkey" => $akey, "search" => "Y", "sid"=>""]);
			}
			catch(\Exception $e)
			{
				$WS = [];
			}
		}
		/////////////////////////
		$crosses			= ProductCross::where('uid','=',$uid)->get();
		if($product)
		{
			$solds				= $product->solds()->latest()->limit(25)->get();
			$receiveds			= $product->receiveds()->latest()->limit(25)->get();
		}

		$productImage		= "/images/tyres/" . $bkey . "/" . $akey . ".jpg";
		$productImagePath	= $_SERVER["DOCUMENT_ROOT"] . $productImage;

		if (file_exists($productImagePath))
		{
			$tyre->image = $productImage;
		}
		else
		{
			$tyre->image = '/images/admin/image_placeholder.jpg';
		}
		
        return view('inventory.tyres.show', compact('tyre', 'solds', 'receiveds', 'crosses'));
    }

	public function TyresFullList(Request $request)
    {
		$partsNoPArray = [];

		$ResultArray = [
			"art_logos" => [],
			"parts" => [],
			"prices" => [],
			"all_brands" => [],
			"all_size" => [],
			"all_width" => [],
			"properties_name" => [],
			"ab_min_price" => [],
			"filtrable" => true,
			"latestpost" => Post::orderBy('created_at','desc')->first()->toArray(),
			"brands_parts_count" => [],
			"width_parts_count" => [],
			"seasons_parts_count" => [],
			"size_parts_count" => [],
			"ab_min_price_f" => [],
			"randomproducts" => ShopController::RandomProductsWidget()];
			
		$TyresArray = Tyre::filter()->get();
		
		if ($TyresArray)
		{
			$TyresArray = $TyresArray->toArray();
			foreach ($TyresArray as $TyresItem)
			{
				
				$TyresItem["pkey"] = $TyresItem["bkey"] . $TyresItem["akey"];
				$partsNoPArray[$TyresItem["pkey"]] = [
						"pkey" => $TyresItem["pkey"],
						"bkey" => $TyresItem["bkey"],
						"akey" => $TyresItem["akey"],
						"article" => $TyresItem["article"],
						"brand" => $TyresItem["brand"],
						"name" => $TyresItem["name"],
						"aid" => $TyresItem["ean"],
						"prices_count" => "",
						"prices" => [],
						"properties_count" => "",
						"properties" =>
						[
							"size" => $TyresItem["size"],
							"width" => $TyresItem["width"],
							"height" => $TyresItem["height"],
							"type" => $TyresItem["type"] . $TyresItem["size"],
							"season" => $TyresItem["season"],
						],
						"superseded" => "",
						"img_src" => "/images/logomedia/" . $TyresItem["bkey"] . ".webp"];
			}
		}
		
		/////////////////////////WS
		$WSWS = Provider::where('cache','=', "1")->where('hasprice','=', "Webservice")->where('active','=', "1")->get();
		if ($WSWS)
		{
			$WSWS = $WSWS->toArray();

			$arWsSparts = $partsNoPArray;
			if (count($arWsSparts) <= 0)
			{
				$arWsSparts[$SEARCH] = $SearchedArray;
			}
			try
			{
				$WS = new WSController();
				$WS->SearchPrices($arWsSparts, [], ["cache_mode" => true, "links_take" => "OFF", "pkey" => $SEARCH, "srch" => "Y", "sid"=>""]);
			}
			catch(\Exception $e)
			{
				$WS = [];
			}
		}
		/////////////////////////Tyres
		foreach($partsNoPArray as $pkey=>$TPartArray)
		{
			//All Brands
			$ResultArray['all_brands'][$TPartArray['bkey']] = $TPartArray['brand'];
			if (isset($ResultArray['brands_parts_count'][$TPartArray['brand']]))
			{
				$ResultArray['brands_parts_count'][$TPartArray['brand']]++;
			}
			else
			{
				$ResultArray['brands_parts_count'][$TPartArray['brand']] = 1;
			}
			//All size
			$ResultArray['all_size'][$TPartArray['properties']['size']] = $TPartArray['properties']['size'];
			if (isset($ResultArray['sizes_parts_count'][$TPartArray['properties']['size']]))
			{
				$ResultArray['sizes_parts_count'][$TPartArray['properties']['size']]++;
			}
			else
			{
				$ResultArray['sizes_parts_count'][$TPartArray['properties']['size']] = 1;
			}
			//All width
			$ResultArray['all_width'][$TPartArray['properties']['width']] = $TPartArray['properties']['width'];
			if (isset($ResultArray['widths_parts_count'][$TPartArray['properties']['width']]))
			{
				$ResultArray['widths_parts_count'][$TPartArray['properties']['width']]++;
			}
			else
			{
				$ResultArray['widths_parts_count'][$TPartArray['properties']['width']] = 1;
			}
			//All season
			$ResultArray['all_seasons'][$TPartArray['properties']['season']] = $TPartArray['properties']['season'];
			if (isset($ResultArray['seasons_parts_count'][$TPartArray['properties']['season']]))
			{
				$ResultArray['seasons_parts_count'][$TPartArray['properties']['season']]++;
			}
			else
			{
				$ResultArray['seasons_parts_count'][$TPartArray['properties']['season']] = 1;
			}
			//All height
			$ResultArray['all_height'][$TPartArray['properties']['height']] = $TPartArray['properties']['height'];
			if (isset($ResultArray['height_parts_count'][$TPartArray['properties']['height']]))
			{
				$ResultArray['heights_parts_count'][$TPartArray['properties']['height']]++;
			}
			else
			{
				$ResultArray['heights_parts_count'][$TPartArray['properties']['height']] = 1;
			}
		}
		
		$arPARTS = $partsNoPArray;
		///////////////
		foreach ($arPARTS as $pkey => $TPartArray)
		{
			//star rating
			$rate = ProductRating::where('pkey',$TPartArray["bkey"] . $TPartArray["akey"])->avg('rating');
			if($rate)
			{
				$arPARTS[$pkey]["rating"]					= $rate;
				$arPARTS[$pkey]["rating_left"]				= 5 - $rate;
				$arPARTS[$pkey]["reviewscount"]				= ProductRating::where('pkey',$TPartArray["bkey"] . $TPartArray["akey"])->count('client_id');
			}
			else
			{
				$arPARTS[$pkey]["rating"]					= intval(0);
				$arPARTS[$pkey]["rating_left"]				= intval(5);
				$arPARTS[$pkey]["reviewscount"]				= intval(0);
			}
		}
			
		// 
		foreach ($arPARTS as $NumKey => $PartArray)
		{
			$ResultArray["parts"][$PartArray["bkey"] . $PartArray["akey"]] = $PartArray;
		}
		
		if (0 < count($partsNoPArray))
		{
			if (0 < count($partsNoPArray))
			{
				$i = 0;
				foreach ($partsNoPArray as $TPartArray)
				{
					$q = ProviderPrice::where('akey','=', $TPartArray["akey"])->where('bkey','=', $TPartArray["bkey"]);

					if($i < 1)
					{
						$PrcsSQL = $q;
					}
					else
					{
						$PrcsSQL->union($q);
					}
					$i = $i + 1;
				}
				
				$PricesArray = $PrcsSQL->get()->toArray();

				// $arNmC = [];
				// foreach ($PricesArray as $PriceItem)
				// {
				// 	if (config('tecdoc_config.hide_prices_noavail') == 1 && $PriceItem["available"] < 1)
				// 	{
				// 		continue;
				// 	}
				// 	$PrPKey = $PriceItem["bkey"] . $PriceItem["akey"];
				// 	$PriceItem = Functions::FormatPrice($PriceItem);
				// 	$ResultArray["prices"][$PrPKey][] = $PriceItem;
					
				// 	//my counter undefied index error fix
				// 	if(isset($partsNoPArray[$PrPKey]["prices_count"]))
				// 	{
				// 		$partsNoPArray[$PrPKey]["prices_count"]++;
				// 	}
				// 	else
				// 	{
				// 		$partsNoPArray[$PrPKey]["prices_count"] = 0;
				// 	}
				// 	//error fix end
					
				// 	//Maximal avail for sorting
				// 	if (isset($MaxAvailableArray[$PrPKey]) && ($MaxAvailableArray[$PrPKey]==0 OR $PriceItem["available"]>$MaxAvailableArray[$PrPKey]))
				// 	{
				// 		$MaxAvailableArray[$PrPKey] = $PriceItem["available"];
				// 	}
				// 	//Minimal prices for sorting
				// 	if (isset($MinPricesArray[$PrPKey]) && ($MinPricesArray[$PrPKey]==0 OR $PriceItem["price_converted"] < $MinPricesArray[$PrPKey]))
				// 	{
				// 		$MinPricesArray[$PrPKey] = $PriceItem["price_converted"];
				// 	}
				// 	//Minimal day for sorting
				// 	//Что бы товары без цен были всёравно в конце даже если дней доставки =0
				// 	$ItemDAY = intval($PriceItem["day"]) + 1;
				// 	if(!isset($MinDaysArray[$PrPKey]) OR $ItemDAY<$MinDaysArray[$PrPKey])
				// 	{
				// 		$MinDaysArray[$PrPKey] = $ItemDAY;
				// 	}
				// }
				
				// unset($arNmC);
			}
		}
		
		////////////////////////////////
		$total = count($ResultArray["parts"]);
		$perPage = 15;
		$page = $request->page??1;
		$offSet = ($page * $perPage) - $perPage;  
		$itemsForCurrentPage = array_slice($ResultArray["parts"], $offSet, $perPage, true); 
		$Numbers = new LengthAwarePaginator($itemsForCurrentPage, $total, $perPage, $page,['path'  => $request->url(),'query' => $request->query(),]);
		////////////////////////////////
		$SEO = "";
		foreach ($ResultArray["parts"] as $PartArray)
		{
			$SEO .= implode([$PartArray["brand"] . " " . $PartArray["article"] . ", "]);
		}
		
		SEOMeta::setTitle('Шины автомобильные:  ' . $SEO . '');
		SEOMeta::setDescription('Шины автомобильные:  ' . $SEO . '');
		OpenGraph::setTitle('Шины автомобильные:  ' . $SEO . '');
        OpenGraph::setDescription('Шины автомобильные:  ' . $SEO . '');
		SEOMeta::setKeywords($SEO);
		////////////////////////////////
		

		return view('shop.special.tyres', compact('ResultArray', 'Numbers', 'total', 'perPage', 'bestsellers', 'featured', 'posts', 'newarrivals'));
    }

	//service functions
	function SpeedRating(Request $request)
	{
		$SpeedRating = [
			"L" => "L(120)","M"=>"M(130)","N"=>"N(140)","P"=>"P(150)","Q"=>"Q(160)",
			"R"=>"R(170)","S"=>"S(180)","T"=>"T(190)","U"=>"U(200)",
			"H"=>"H(210)","V"=>"V(240)","W"=>"W(270)","Y"=>"Y(300)","Z"=>"Z(>300)"];
		return $SpeedRating;
	}
	
	function TyreWidth(Request $request)
	{
		$TyreWidth = [
			"125"=>"125", "135"=>"135", "145"=>"145", "155"=>"155", "165"=>"165",
			"175"=>"175", "185"=>"185", "195"=>"195", "205"=>"205", "215"=>"215",
			"225"=>"225", "235"=>"235", "245"=>"245", "255"=>"255", "265"=>"265",
			"275"=>"275", "285"=>"285", "295"=>"295", "305"=>"305", "315"=>"315",
			"325"=>"325", "335"=>"335"];
		return $TyreWidth;
	}
	
	function TyreAspect(Request $request)
	{
		$TyreAspect = [
			"30"=>"30","35"=>"35","40"=>"40",
			"45"=>"45","50"=>"50","55"=>"55",
			"60"=>"60","65"=>"65","70"=>"70",
			"75"=>"75","80"=>"80","82"=>"82",
			"85"=>"85"];
		return $TyreAspect;
	}
	
	function CarType(Request $request)
	{
		$CarType = [
			"passenger" => "Passenger car",
			"suv" => "SUV",
			"lcv" => "Light truck",
			"moto" => "Moto",
			"racing"=>"Racing tires"];
		return $CarType;
	}
	
	function Season(Request $request)
	{
		$Season = ["all" => "All-season", "winter" => "Winter", "summer" => "Summer"];
		return $Season;
	}

	function RimSize(Request $request)
	{
		$RimSize = [
			"10"=>"10''","12"=>"12''","13"=>"13''",
			"14"=>"14''","15"=>"15''","16"=>"16''",
			"17"=>"17''","17.50"=>"17.5''","18"=>"18''",
			"19"=>"19''","20"=>"20''","21"=>"21''",
			"22"=>"22''","23"=>"23''","24"=>"24''",
			"26"=>"26''","28"=>"28''","30"=>"30''",
			"36"=>"36''","38"=>"38''"];
		return $RimSize;
	}
}
