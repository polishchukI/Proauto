<?php

namespace App\Http\Controllers\Catalog;

use DB;

use Illuminate\Http\Request;

use Illuminate\Support\Str;

use App\Models\Brand\Brand;//system brands table

use App\Models\Product\ProductCross;
use App\Models\Product\ProductRating;

use App\Models\Inventory\Provider;
use App\Models\Inventory\ProviderPrice;
use App\Http\Controllers\WSController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Tecdoc\NewTecdocController;
use App\Http\Controllers\FunctionsController as Functions;

//////////seo
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
//////////seo

class ProductController extends Controller
{
	static public function GetProductPage(Request $request)
	{
		mb_internal_encoding("UTF-8");
        $brand				= $request->brand;
		$number				= $request->number;

		$akey = Functions::SingleKey($number);
		$bkey = Functions::SingleKey($brand,true);
		$pkey = Functions::SingleKey($brand,true) . Functions::SingleKey($number);

		$MainPartArray = [
			"article" => Str::upper($number),
			"akey" => $akey,
			"brand" => Str::upper($brand),
			"bkey" => $bkey,
			"pkey" => $pkey,
			"brand_description" => "",
			"name" => "",
			"prices_count" => 0,
			"images" => [],
			"properties" => [],
			"flag_media" => '/images/flags/worldwide.png',
			"rating" => 0,
			"tags" => [],
			"rating_left" => 0,
			"reviewscount" => 0,
			"reviews" => []];
        
		$brandByName = NewTecdocController::getBrandByCode($request['brand']);
		// dd($brandByName);
		if(array_key_exists('id', $brandByName))
		{
			$brand_id			= $brandByName['id'];
			$part_type			= $brandByName['part_type'];
			$CatalogPartInfo	= NewTecdocController::getPartData($part_type, $brand_id, $number);
		}

		$MainPartArray["kind"] = $part_type ?? "";

		if (isset($CatalogPartInfo["aid"]))
		{
			$MainPartArray["aid"]			= $CatalogPartInfo["aid"];
			$MainPartArray["td_name"]		= $CatalogPartInfo["td_name"];
			// $MainPartArray["name"]			= $CatalogPartInfo["td_name"];
			$MainPartArray["kind"]			= $CatalogPartInfo["kind"];
			$MainPartArray["pkey"]			= $MainPartArray["bkey"] . $MainPartArray["akey"];
		}
		
		/////////////////////////WS
		$WSWS = Provider::where('cache','=', "1")->where('hasprice','=', "Webservice")->where('active','=', "1")->get();
		if ($WSWS)
		{
			$WSWS = $WSWS->toArray();

			$SearchedArray = [
					"searched"				=> true,
					"pkey"					=> $MainPartArray["pkey"],
					"bkey"					=> $MainPartArray["bkey"],
					"akey"					=> $MainPartArray["akey"],
					"article"				=> $MainPartArray["article"],
					"brand"					=> $MainPartArray["brand"],
					"td_name"				=> "",
					"name"					=> "",
					"img_src"				=> "/images/no_image.webp"];
			
			$arWsSparts[$MainPartArray["pkey"]] = $SearchedArray;
			
			try
			{
				$WS = new WSController();
				$WS->SearchPrices($arWsSparts, [], ["cache_mode" => true, "links_take" => "OFF", "pkey" => $MainPartArray["pkey"], "srch" => "Y", "sid"=>""]);
			}
			catch(\Exception $e)
			{
				$WS = [];
			}
		}
		
		//Images
		$partimage = '/images/artmedia/' . $MainPartArray["bkey"] . '/' . $MainPartArray["akey"] . '.jpg';
		if (file_exists($_SERVER["DOCUMENT_ROOT"] . $partimage))
		{
			$MainPartArray["images"][] = $partimage;
		}
		$logo_image = '/images/logomedia/' . $MainPartArray["bkey"] . '.webp';
		if (file_exists($_SERVER["DOCUMENT_ROOT"] . $logo_image))
		{
			$MainPartArray["images"][] = $logo_image;
		}
		
		if(count($MainPartArray["images"]) == 0) 
		{
			$MainPartArray["images"][] = "/images/no_image.webp";
		}
		// dd($MainPartArray["images"]);

		$BrandDescription = [];
		$query = Brand::where('bkey','=', $bkey)->first();
		if($query)
		{
			$BrandDescription = $query->toArray();
		}

		$MainPartArray["brand_description"] = isset($BrandDescription["brand_text"]) ? $BrandDescription["brand_text"] : "null";
		
		if(isset($MainPartArray["pkey"]))
		{
			$MainPartPricesArray = ProviderPrice::where("pkey", $MainPartArray["pkey"])->get()->toArray();
			foreach($MainPartPricesArray as $PriceArray)
			{
				// dd(compact('PriceArray'));
				$PrPKey = $PriceArray["pkey"];
				$PriceArray = Functions::FormatPrice($PriceArray);
				$MainPartArray["prices"][] = $PriceArray;
				$MainPartArray["prices_count"] ++;
				$MainPartArray["name"] = isset($PriceArray["provider_product_name"]) ? $PriceArray["provider_product_name"] : "";
			}
		}
		
		//Logo media folder
		$LogoMedia = "/images/logomedia/" . $MainPartArray["bkey"] . ".webp";
		if(file_exists($_SERVER["DOCUMENT_ROOT"] . $LogoMedia))
		{
			$MainPartArray["logo_src"] = $LogoMedia;
		}
		else
		{
			$MainPartArray["logo_src"] = $LogoMedia;
		}

		$MainPartArray["country"] = isset($BrandDescription["country"]) ? $BrandDescription["country"] : "Worldwide";

		$MainPartArray["iso"] = isset($BrandDescription["iso"]) ? $BrandDescription["iso"] : "WV";
		
		if(array_key_exists("iso", $BrandDescription) && $BrandDescription["iso"]!="")
		{
			$MainPartArray["flag_media"] = '/images/flags/' . $BrandDescription["iso"] . '.png';
		}

		$MainPartArray["search_url"] = Functions::GetSearchURL($MainPartArray["brand"], $MainPartArray["akey"]);

		if(array_key_exists('kind',$MainPartArray))
		{
			if($MainPartArray["kind"] == 1)
			{
				$CountryInfo = NewTecdocController::GetCOUID($MainPartArray["brand"]);
			}
			elseif($MainPartArray["kind"] == 3)
			{
				$CountryInfo = Functions::GetBrandDescription($MainPartArray["brand"]);
			}
			// if($MainPartArray["aid"]>0)
			// {
			// 	if($MainPartArray["kind"] == 3)
			// 	{
			// 		$arTYPE = ["1","2","4"];
			// 	}
			// 	else
			// 	{
			// 		$arTYPE = ["3","4"];
			// 	}
				
			// 	$analogs = NewTecdocController::LookupProductAnalog($MainPartArray["aid"],$arTYPE);
			// 	foreach ($analogs as $item)
			// 	{
			// 		$MainPartArray["analogs"][] = [
			// 				"search_url"		=> Functions::GetSearchURL($item["brand"], Functions::SingleKey($item["article"])),
			// 				"type"				=> $item["type"],
			// 				"article"			=> $item["article"],
			// 				"brand"				=> $item["brand"]];
			// 	}
			// }

		}
		
		$pkey_uid_array			= ProductCross::where('pkey','=',$MainPartArray['pkey'])->get();

		if (!is_null($pkey_uid_array))
		{
			foreach($pkey_uid_array as $item)
			{
				$uid					= $item->uid;
				$crossesArray			= ProductCross::where('uid','=',$uid)->get();
				foreach($crossesArray as $resultItem)
				{
					$MainPartArray["analogs"][$resultItem["pkey"]] = [
										"pkey"			=> $resultItem["pkey"],
										"bkey"			=> $resultItem["bkey"],
										"brand"			=> $resultItem["brand"],
										"akey"			=> $resultItem["akey"],
										"article"		=> $resultItem["article"],
										"link_side"		=> $resultItem["side"],
										"code"			=> $resultItem["code"],
										// "name"			=> $resultItem["name"] ?? ""
									];
				}
				
			}
			
		}
			
		if(array_key_exists('aid',$MainPartArray))
		{
			if($MainPartArray["aid"]>0)
			{
				$Properties = NewTecdocController::GetProperties($MainPartArray["aid"]);
				foreach ($Properties as $Prop)
				{
					$MainPartArray["properties"][] = ["name"=>$Prop["name"],"value"=>$Prop["value"]];
				}
			}
			if($MainPartArray["aid"]>0)
			{
				$TagsIDs = NewTecdocController::GetTags($MainPartArray["aid"]);
				foreach ($TagsIDs as $TagsID)
				{
					$TagsTexts = NewTecdocController::GetTextByID($TagsID["LGS_STR_ID"]);
					foreach ($TagsTexts as $Tag)
					{
						$MainPartArray["tags"][] = ["text"=>$Tag["text"]];
					}
				}
			}
			if($MainPartArray["aid"]>0)
			{
				$ApplicabilityBrandsArray = NewTecdocController::GetAppBrands($MainPartArray["aid"]);
				foreach ($ApplicabilityBrandsArray as $AppBrand)
				{
					$MainPartArray["APPLICABILITY_BRAND"][] = ["MFA_BRAND"=>$AppBrand["MFA_BRAND"],"MFA_MFC_CODE"=>$AppBrand["MFA_MFC_CODE"]];
				}
			}
		
			if(array_key_exists('APPLICABILITY_BRAND',$MainPartArray))
			{
				foreach ($MainPartArray["APPLICABILITY_BRAND"] as $code)
				{
					$Applicability = NewTecdocController::GetApplicability($MainPartArray["aid"],$code["MFA_MFC_CODE"]);
					foreach ($Applicability as $App)
					{
						$MODURL = Functions::GetURLNameByModID($App["MFA_BRAND"], $App["MOD_ID"]);
						$URL = Functions::GenerateURL(["brand" => $App["MFA_BRAND"], "MOD_FURL" => $MODURL, "TYP_ID" => $App["TYP_ID"], "ENGINE" => $App["ENG_CODE"], "TYPE_NAME" => $App["TYP_CDS_TEXT"]]);
						$START = Functions::DateFormat($App["TYP_PCON_START"], 'to', 'year');
						$END = Functions::DateFormat($App["TYP_PCON_END"], 'to', 'year');
						$START = substr($START, 2, 2);
						if (0 < intval($END))
						{
							$END = substr($END, 2, 2);
						}
						else
						{
							$END = ' - ';
						}
						$MainPartArray["APPLICABILITY"][$code["MFA_BRAND"]][] = ["TYP_ID"=>$App["TYP_ID"],"MOD_ID"=>$App["MOD_ID"],"MFA_BRAND"=>$App["MFA_BRAND"],
											"MOD_CDS_TEXT"=>$App["MOD_CDS_TEXT"],"TYP_CDS_TEXT"=>$App["TYP_CDS_TEXT"],"START"=>$START,
											"END"=>$END,"TYP_CCM"=>$App["TYP_CCM"],"TYP_KW_FROM"=>$App["TYP_KW_FROM"],
											"TYP_HP_FROM"=>$App["TYP_HP_FROM"],"TYP_CYLINDERS"=>$App["TYP_CYLINDERS"],"ENG_CODE"=>$App["ENG_CODE"],
											"TYP_FUEL_DES_TEXT"=>$App["TYP_FUEL_DES_TEXT"],"TYP_BODY_DES_TEXT"=>$App["TYP_BODY_DES_TEXT"],
											"URL"=>$URL];
					}
				}
			}
		}

		if(empty($MainPartArray["name"]))
		{
			$MainPartArray["name"] = "Запчасть - " . $MainPartArray["brand"] . " - " . $MainPartArray["article"];
		}
		
		//star rating
		$rate = ProductRating::where('pkey',$MainPartArray["pkey"])->avg('rating');
		$MainPartArray["rating"]			= $rate ? $rate : intval(0);
		$MainPartArray["rating_left"]		= $rate ? (5 - $rate) : intval(5);
		$MainPartArray["reviewscount"]		= $rate ? (ProductRating::where('pkey',$MainPartArray["pkey"])->count('client_id')) : intval(0);

		$reviews_sql = ProductRating::where('pkey',$MainPartArray["pkey"])
				->select('product_ratings.client_id',
						'product_ratings.rating as rating',
						DB::raw('(5 - product_ratings.rating) as rating_left'),
						'product_ratings.review as review',
						'product_ratings.created_at as date','clients.firstname as firstname','clients.lastname as lastname','clients.avatar as avatar')
				->leftjoin('clients', 'clients.id', '=', 'product_ratings.client_id')->get();
		if($reviews_sql)
		{
			$MainPartArray["reviews"] = $reviews_sql->toArray();
		}
		
		$SEO = $MainPartArray["name"] . " - " . $MainPartArray["brand"] . " - " . $MainPartArray["article"];
		SEOMeta::setTitle('Страница товара ' . $SEO .'');
		SEOMeta::setDescription('Страница товара ' . $SEO .'');
		OpenGraph::setTitle('Страница товара ' . $SEO .'');
		OpenGraph::setDescription('Страница товара ' . $SEO .'');
		SEOMeta::setKeywords($SEO);
		
		return view('shop.catalog.product', compact('MainPartArray'));
	}
	
	static public function rateproduct(Request $request)
	{
		request()->validate([
				'pkey'			=> 'required',
				'review-stars'	=> 'required',
				]);		
		$rate					= new ProductRating;
		$min_price				= ProviderPrice::where('pkey','=', $request["pkey"])->orderBy('price', 'asc')->first();
		$rate->pkey				= $request["pkey"];
		$rate->article			= $request["article"];
		$rate->akey				= $request["akey"];
		$rate->brand			= $request["brand"];
		$rate->bkey				= $request["bkey"];
		$rate->name				= $request["name"];
		$rate->currency			= $min_price->currency ?? "RUB";
		$rate->price			= $min_price->price ?? 0;
		$rate->review			= $request["review-text"];
        $rate->rating			= $request["review-stars"];
        $rate->client_id		= (int)$request->user('clients')->id;
        $rate->email			= $request->user('clients')->email;
		$rate->save();

		return redirect()->back();
	}
}