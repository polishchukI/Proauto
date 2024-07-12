<?php

namespace App\Http\Controllers\Special;

use Illuminate\Http\Request;

use App\Models\Special\Oil;
use App\Models\Special\Tyre;

use App\Models\Special\Tool;
use App\Models\Special\Battery;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Shop\ShopController;
use Illuminate\Pagination\LengthAwarePaginator;

//////////seo
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
//////////seo

class SpecialController extends Controller
{
    //** tyres **/
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
			"125.0"=>"125", "135.0"=>"135", "145.0"=>"145", "155.0"=>"155", "165.0"=>"165",
			"175.0"=>"175", "185.0"=>"185", "195.0"=>"195", "205.0"=>"205", "215.0"=>"215",
			"225.0"=>"225", "235.0"=>"235", "245.0"=>"245", "255.0"=>"255", "265.0"=>"265",
			"275.0"=>"275", "285.0"=>"285", "295.0"=>"295", "305.0"=>"305", "315.0"=>"315",
			"325.0"=>"325", "335.0"=>"335"];
		return $TyreWidth;
	}
	
	function TyreAspect(Request $request)
	{
		$TyreAspect = [
			"30.0"=>"30","35.0"=>"35","40.0"=>"40",
			"45.0"=>"45","50.0"=>"50","55.0"=>"55",
			"60.0"=>"60","65.0"=>"65","70.0"=>"70",
			"75.0"=>"75","80.0"=>"80","82.0"=>"82",
			"85.0"=>"85"];
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
			"10.00"=>"10''","12.00"=>"12''","13.00"=>"13''",
			"14.00"=>"14''","15.00"=>"15''","16.00"=>"16''",
			"17.00"=>"17''","17.50"=>"17.5''","18.00"=>"18''",
			"19.00"=>"19''","20.00"=>"20''","21.00"=>"21''",
			"22.00"=>"22''","23.00"=>"23''","24.00"=>"24''",
			"26.00"=>"26''","28.00"=>"28''","30.00"=>"30''",
			"36.00"=>"36''","38.00"=>"38''"];
		return $RimSize;
	}

	public function TyresFullList(Request $request)
    {
		$ResultArray["parts"] = [];
		$partsNoPArray = [];
		$TyresArray = Tyre::all();
		if ($request->brand)
		{
			$TyresArray = $TyresArray->whereIn('brand', $request->brand);
		}

		if($TyresArray)
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
							"width" => $TyresItem["width"],
							"height" => $TyresItem["height"],
							"type" => $TyresItem["type"] . $TyresItem["diameter"],
							"season" => $TyresItem["season"],
						],
						"superseded" => "",
						"img_src" => "/images/logomedia/" . $TyresItem["bkey"] . ".webp"];
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
		}
		$arPARTS = $partsNoPArray;
		///////////////
		foreach ($arPARTS as $pkey => $TPartArray)
		{
			$arPARTS[$pkey]["detail_url"] = Functions::GetProductURL($TPartArray["brand"], $TPartArray["akey"]);
			$arPARTS[$pkey]["search_url"] = Functions::GetSearchURL($TPartArray["brand"], $TPartArray["akey"]);
			//star rating
			$rate = ProductRating::where('pkey',$TPartArray["bkey"] . $TPartArray["akey"])->avg('rating');
			if($rate)
			{
				$arPARTS[$pkey]["rating"] = $rate;
				$arPARTS[$pkey]["rating_left"] = 5 - $rate;
				$arPARTS[$pkey]["reviewscount"] = ProductRating::where('pkey',$TPartArray["bkey"] . $TPartArray["akey"])->count('client_id');
			}
			else
			{
				$arPARTS[$pkey]["rating"] = intval(0);
				$arPARTS[$pkey]["rating_left"] = intval(5);
				$arPARTS[$pkey]["reviewscount"] = intval(0);
			}
		}
			
		// 
		foreach ($arPARTS as $NumKey => $PartArray)
		{
			//////if (array_key_exists('aid',$PartArray))
			if (isset($PartArray["aid"]))
			{
				if (0 < $PartArray["aid"])
				{
					$PartArray["uaid"] = $PartArray["ean"];
				}
			}
			$ResultArray["parts"][$PartArray["bkey"] . $PartArray["akey"]] = $PartArray;
		}
		
		$ResultArray["prices"] = [];
		if (0 < count($partsNoPArray))
		{
			$ViewSort = $ResultArray["sort"] = $request->get('ViewSort', 1);

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
				/////////////////////
				if($ViewSort == 1)
				{
					$PrcsSQL->orderBy('price');
				}
				elseif($ViewSort == 2)
				{
					$PrcsSQL->orderBy('price', 'DESC');//error modal prices popup
				}
				elseif($ViewSort == 3)
				{
					$PrcsSQL->orderBy('day');
				}
				elseif($ViewSort == 4)
				{
					$PrcsSQL->orderBy('price');
				}
				else
				{
					$PrcsSQL->orderBy('available');
				}
				/////////////////////
				$PricesArray = $PrcsSQL->get()->toArray();

				$arNmC = [];
				foreach ($PricesArray as $PriceItem)
				{
					if (config('tecdoc_config.hide_prices_noavail') == 1 && $PriceItem["available"] < 1)
					{
						continue;
					}
					$PrPKey = $PriceItem["bkey"] . $PriceItem["akey"];
					$PriceItem = Functions::FormatPrice($PriceItem);
					$ResultArray["prices"][$PrPKey][] = $PriceItem;
					
					//my counter undefied index error fix
					if(isset($partsNoPArray[$PrPKey]["prices_count"]))
					{
						$partsNoPArray[$PrPKey]["prices_count"]++;
					}
					else
					{
						$partsNoPArray[$PrPKey]["prices_count"] = 0;
					}
					//error fix end
					
					//Maximal avail for sorting
					if (isset($MaxAvailableArray[$PrPKey]) && ($MaxAvailableArray[$PrPKey]==0 OR $PriceItem["available"]>$MaxAvailableArray[$PrPKey]))
					{
						$MaxAvailableArray[$PrPKey] = $PriceItem["available"];
					}
					//Minimal prices for sorting
					if (isset($MinPricesArray[$PrPKey]) && ($MinPricesArray[$PrPKey]==0 OR $PriceItem["price_converted"] < $MinPricesArray[$PrPKey]))
					{
						$MinPricesArray[$PrPKey] = $PriceItem["price_converted"];
					}
					//Minimal day for sorting
					//Что бы товары без цен были всёравно в конце даже если дней доставки =0
					$ItemDAY = intval($PriceItem["day"]) + 1;
					if(!isset($MinDaysArray[$PrPKey]) OR $ItemDAY<$MinDaysArray[$PrPKey])
					{
						$MinDaysArray[$PrPKey] = $ItemDAY;
					}
				}
				unset($arNmC);
			}
		}
		$ResultArray["randomproducts"] = ShopController::RandomProductsWidget();
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
		
		return view('shop.specific.tyres', compact('ResultArray', 'Numbers', 'total', 'perPage', 'bestsellers', 'featured', 'posts', 'newarrivals'));
    }

        //** rims **/
        
	static function RimsFullList(Request $request)
	{
		$arPARTS = [];
		$arPAIDs_noP = [];
		$ResultArray["all_brands"] = [];
		$ResultArray["properties_name"] = [];
		$ResultArray["parts"] = [];
		$RimsArray = Rim::all();
		
		if ($request->FilterProp)
		{
			$RimsArray = $RimsArray->where('brand', $request->FilterValue);
		}
		$request->merge([ 'width' => $request->width ]);
		if ($request->width)
		{
			$RimsArray = $RimsArray->where('width', (int)$request->width);
		}

		if ($request->rim_size && $request->rim_size != 0)
		{
			$RimsArray = $RimsArray->where('rim_size', (int)$request->rim_size);
		}
		if ($request->bolt_hole_circle && $request->bolt_hole_circle != 0)
		{
			$RimsArray = $RimsArray->where('bolt_hole_circle', (int)$request->bolt_hole_circle);
		}
		if ($request->rim_hole_number && $request->rim_hole_number != 0)
		{
			$RimsArray = $RimsArray->where('rim_hole_number', (int)$request->rim_hole_number);
		}
		$ResultArray['rim_size'] = [];
		$ResultArray['width'] = [];
		$ResultArray['rim_hole_number'] = [];
		$ResultArray['bolt_hole_circle'] = [];
		//initial values
		$ResultArray['rim_size']['0'] = 'All values';
		$ResultArray['width']['0'] = 'All values';
		$ResultArray['rim_hole_number']['0'] = 'All values';
		$ResultArray['bolt_hole_circle']['0'] = 'All values';
		
		if($RimsArray)
		{
			$RimsArray = $RimsArray->toArray();
			foreach ($RimsArray as $RimItem)
			{
				$RimItem["pkey"] = $RimItem["bkey"] . $RimItem["akey"];
				$arPARTS[$RimItem["pkey"]] = [
						"pkey" => $RimItem["pkey"],
						"bkey" => $RimItem["bkey"],
						"akey" => $RimItem["akey"],
						"article" => $RimItem["article"],
						"brand" => $RimItem["brand"],
						"name" => $RimItem["brand"] . ' - ' . $RimItem["article"] . ', ' . $RimItem["rim_size"] . ' Inch, ' . $RimItem["material"] . ' rim',
						//ALCAR 98mm, 4-Hole, 13Inch, steel wheel, Rim 
						"aid" => $RimItem["ean"],
						"prices_count" => "",
						"prices" => [],
						"properties_count" => "",
						"properties" =>
						[
							"width" => $RimItem["width"] . '" ',
							"rim_size" => $RimItem["rim_size"],
							"model" => $RimItem["model"],
						],
						"superseded" => "",
						"img_src" => "/images/rims/" . $RimItem["bkey"] .'/'. $RimItem["akey"] . ".jpg"];
						//filter props
						$ResultArray['rim_size'][$RimItem["rim_size"]] = $RimItem["rim_size"];
						$ResultArray['width'][$RimItem["width"]] = $RimItem["width"];
						$ResultArray['rim_hole_number'][$RimItem["rim_hole_number"]] = $RimItem["rim_hole_number"];
						$ResultArray['bolt_hole_circle'][$RimItem["bolt_hole_circle"]] = $RimItem["bolt_hole_circle"];
			}
		}
		/////////////////////////////////
		if (empty($arPARTS))
		{
			return view('errors.noparts');
		}
		foreach($arPARTS as $pkey=>$TPartArray)
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
		}
		
		foreach ($arPARTS as $pkey => $TPartArray)
		{
			$arPARTS[$pkey]["detail_url"] = Functions::GetProductURL($TPartArray["brand"], $TPartArray["akey"]);
			$arPARTS[$pkey]["search_url"] = Functions::GetSearchURL($TPartArray["brand"], $TPartArray["akey"]);
			//star rating
			$rate = ProductRating::where('pkey',$TPartArray["bkey"] . $TPartArray["akey"])->avg('rating');
			if($rate)
			{
				$arPARTS[$pkey]["rating"] = $rate;
				$arPARTS[$pkey]["rating_left"] = 5 - $rate;
				$arPARTS[$pkey]["reviewscount"] = ProductRating::where('pkey',$TPartArray["bkey"] . $TPartArray["akey"])->count('client_id');
			}
			else
			{
				$arPARTS[$pkey]["rating"] = intval(0);
				$arPARTS[$pkey]["rating_left"] = intval(5);
				$arPARTS[$pkey]["reviewscount"] = intval(0);
			}
		}
		foreach ($arPARTS as $NumKey => $PartArray)
		{
			if (array_key_exists('aid',$PartArray))
			{
				if (0 < $PartArray["aid"])
				{
					$PartArray["uaid"] = Functions::SetUrID($PartArray["aid"]);
				}
			}
			$ResultArray["parts"][$PartArray["bkey"] . $PartArray["akey"]] = $PartArray;
		}
		/////////////////////////////////
		$ResultArray["randomproducts"] = ShopController::RandomProductsWidget();

		$total = count($ResultArray["parts"]);
		//items per page
		$perPage = 15;
		$page = $request->page??1;
		$offSet = ($page * $perPage) - $perPage;  
		$itemsForCurrentPage = array_slice($ResultArray["parts"], $offSet, $perPage, true); 
		$Numbers = new LengthAwarePaginator($itemsForCurrentPage, $total, $perPage, $page, ['path'  => $request->url(),'query' => $request->query(),]);
		////////////////////////////////
		if ($request->ajax())
		{
			$content = View::make('specific.rimblocks.filteredrimsblock', compact('ResultArray','Numbers', 'total', 'perPage', 'bestsellers', 'featured', 'posts', 'newarrivals'))->render();
			return response($content);
		};
		////////////////////////////////
		$SEO = "";
		foreach ($ResultArray["parts"] as $PartArray)
		{
			$SEO .= implode([$PartArray["brand"] . " " . $PartArray["article"] . ", "]);
		}
		
		SEOMeta::setTitle('Каталог автомобильных дисков');
		SEOMeta::setDescription('Автомобильные диски:  ' . $SEO . '');
		OpenGraph::setTitle('Каталог автомобильных дисков');
        OpenGraph::setDescription('Автомобильные диски:  ' . $SEO . '');
		SEOMeta::setKeywords($SEO);
		////////////////////////////////

		return view('shop.specific.rims', compact('ResultArray','Numbers', 'total', 'perPage', 'bestsellers', 'featured', 'posts', 'newarrivals'));
	}
	/////////////////////
}
