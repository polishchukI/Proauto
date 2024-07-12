<?php

namespace App\Http\Controllers\Special;

use View;

use App\Models\Blog\Post;
use App\Models\Supplier\SupplierPrice;
use App\Models\Webservice;
use App\Models\Special\Rim;
use App\Models\Product\ProductRating;

use App\Http\Controllers\Prices;
use App\Http\Controllers\Controller;
use App\Http\Controllers\WSController;
use App\Http\Controllers\Shop\ShopController;
use App\Http\Controllers\Shop\BlogController;
use App\Http\Controllers\FunctionsController as Functions;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

//////////seo
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
//////////seo

class RimsController extends Controller
{
	static function RimsFullList(Request $request)
	{
		$ResultArray = [
			"art_logos" => [],
			"parts" => [],
			"prices" => [],
			"all_brands" => [],
			"all_size" => [],
			"rim_hole_number" => [],
			"bolt_hole_circle" => [],
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

		$arPARTS = [];
		$arPAIDs_noP = [];
		$posts = BlogController::ShowPostsCarousel();
		$RimsArray = Rim::filter()->get();
		
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
						"name" => $RimItem["brand"] . ' - ' . $RimItem["article"] . ', ' . $RimItem["size"] . ' Inch, ' . $RimItem["material"] . ' size',
						//ALCAR 98mm, 4-Hole, 13Inch, steel wheel, Rim 
						"aid" => $RimItem["ean"],
						"prices_count" => "",
						"prices" => [],
						"properties_count" => "",
						"properties" =>
						[
							"width" => $RimItem["width"] . '" ',
							"size" => $RimItem["size"],
							"model" => $RimItem["model"],
						],
						"superseded" => "",
						"img_src" => "/images/rims/" . $RimItem["bkey"] .'/'. $RimItem["akey"] . ".jpg"];
						//filter props
						$ResultArray['all_size'][$RimItem["size"]] = $RimItem["size"];
						$ResultArray['all_width'][$RimItem["width"]] = $RimItem["width"];
						$ResultArray['rim_hole_number'][$RimItem["rim_hole_number"]] = $RimItem["rim_hole_number"];
						$ResultArray['bolt_hole_circle'][$RimItem["bolt_hole_circle"]] = $RimItem["bolt_hole_circle"];
			}
		}
		/////////////////////////////////
		if (empty($arPARTS))
		{
			return view('shop.errors.noparts', compact('ResultArray','Numbers', 'total', 'perPage', 'bestsellers', 'featured', 'posts', 'newarrivals'));
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
		

		$total = count($ResultArray["parts"]);
		//items per page
		$perPage = 15;
		$page = $request->page??1;
		$offSet = ($page * $perPage) - $perPage;  
		$itemsForCurrentPage = array_slice($ResultArray["parts"], $offSet, $perPage, true); 
		$Numbers = new LengthAwarePaginator($itemsForCurrentPage, $total, $perPage, $page, ['path' => $request->url(),'query' => $request->query(),]);
		
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

		// dd(compact('ResultArray','Numbers', 'total', 'perPage', 'bestsellers', 'featured', 'posts', 'newarrivals'));
		return view('shop.special.rims', compact('ResultArray','Numbers', 'total', 'perPage', 'bestsellers', 'featured', 'posts', 'newarrivals'));
	}
	/////////////////////
}
