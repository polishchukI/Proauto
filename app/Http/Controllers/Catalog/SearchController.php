<?php

namespace App\Http\Controllers\Catalog;

use Illuminate\Support\Str;

use Illuminate\Http\Request;

use App\Models\Blog\Post;

use App\Models\Inventory\Provider;
use App\Models\Inventory\ProviderPrice;

use App\Models\Product\ProductCross;
use App\Models\Product\Productrating;

use App\Http\Controllers\Controller;
use App\Http\Controllers\WSController;
use App\Http\Controllers\Shop\BlogController;
use App\Http\Controllers\Shop\ShopController;

use Illuminate\Pagination\LengthAwarePaginator;

use App\Http\Controllers\FunctionsController as Functions;
use App\Http\Controllers\Tecdoc\NewTecdocController;

//////////seo
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
//////////seo

class SearchController extends Controller
{
	static function SearchNumber(Request $request)
	{
		$number = Str::upper($request->number);
		$SEARCH = Functions::SingleKey($number);

		$ResultArray = [
					"number" => Str::upper($request->number),
					"sortBy" => $request->sortBy ?? "brand",
					"art_logos" => [],
					"parts" => [],
					"prices" => [],
					"all_brands" => [],
					"properties_name" => [],
					"ab_min_price" => [],
					"filtrable" => true,
					"latestpost" => Post::orderBy('created_at','desc')->first()->toArray(),
					"ab_min_price_f" => [],
					"randomproducts" => ShopController::RandomProductsWidget()];

		$arTImgs							= [];
		$arLogoPAIDs						= [];
		$arPAIDs_noP						= [];	
		$arPImgAvail						= [];
		$MinDaysArray						= [];
		$partsNoPArray						= [];
		$MinPricesArray						= [];
		$arNmC								= [];
		$MaxAvailableArray					= [];

		if (strlen($SEARCH) < 3)
		{
			$ResultArray["filtrable"]	= false;
			$posts 						= BlogController::ShowPostsCarousel();
			SEOMeta::setTitle('Каталог запчастей - поиск по номеру ' . $SEARCH . '');
			SEOMeta::setDescription('Каталог запчастей - поиск по номеру ' . $SEARCH . '');
			OpenGraph::setTitle('Каталог запчастей - поиск по номеру ' . $SEARCH . '');
			OpenGraph::setDescription('Каталог запчастей - поиск по номеру ' . $SEARCH . '');

			return view('shop.errors.noparts', compact('ResultArray','posts'));
		}

		
		$ArticlesRequest = NewTecdocController::SearchNumber($SEARCH);
		
		foreach ($ArticlesRequest as $ArticlesArray)
		{
			// dd(compact('ArticlesArray','ArticlesRequest'));
			$bkey = Functions::SingleKey($ArticlesArray["brand"], true);
			$akey = Functions::SingleKey($ArticlesArray["article"]);
			$partsNoPArray[$bkey . $akey] = [
					"pkey" => $bkey . $akey,
					"bkey" => $bkey,
					"akey" => $akey,
					"aid" => $ArticlesArray["aid"] ?? "",
					"kind" => $ArticlesArray["kind"] ?? "",
					"article" => $ArticlesArray["article"],
					"brand" => $ArticlesArray["brand"],
					"td_name" => $ArticlesArray["name"],
					"name" => $ArticlesArray["name"],
					"img_src" => "/images/logomedia/" . $bkey . ".webp",
					"prices_count" => 0,
					"properties_count" => 0,
					"properties" => [],
					"superseded" => "",
					"img_zoom" => "",
					"img_from" => "",
					"img_count" => "",
					"logo_src" => "",
					"uaid" => ""];
			// $arPAIDs_noP[] = $ArticlesArray["aid"];
		}

		// dd(compact('partsNoPArray','ArticlesRequest'));
		
		/////////////////////////WS
		$WSWS = Provider::where('cache','=', "1")->where('hasprice','=', "Webservice")->where('active','=', "1")->get();
		if ($WSWS)
		{
			$WSWS = $WSWS->toArray();

			$SearchedArray = [
					"searched" => true,
					"pkey" => $SEARCH,
					"bkey" => "",
					"akey" => $SEARCH,
					"article" => $SEARCH,
					"brand" => "",
					"td_name" => "",
					"name" => "Запчасть",
					"img_src" => "/images/no_image.webp"];
			if (config('tecdoc_config.request_ws_only_searched') == 1)
			{
				$arWsSparts[$SEARCH] = $SearchedArray;
			}
			else
			{
				$arWsSparts = $partsNoPArray;
				if (count($arWsSparts) <= 0)
				{
					$arWsSparts[$SEARCH] = $SearchedArray;
				}
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

		/////////////////////////
		$ProvidersPrices = ProviderPrice::where('akey','=', $SEARCH)->select('bkey', 'akey', 'article', 'brand', 'provider_product_name')->get();
		if($ProvidersPrices)
		{
			$ProvidersPrices = $ProvidersPrices->toArray();

			foreach ($ProvidersPrices as $arSArts)
			{
				$arSArts["pkey"] = $arSArts["bkey"] . $arSArts["akey"];
				// if (!is_array($partsNoPArray[$arSArts["pkey"]]))//original
				if (isset($partsNoPArray[$arSArts["pkey"]]))
				{
					continue;
				}
				$partsNoPArray[$arSArts["pkey"]] = [
						"pkey" => $arSArts["pkey"],
						"bkey" => $arSArts["bkey"],
						"akey" => $arSArts["akey"],
						"article" => $arSArts["article"],
						"brand" => $arSArts["brand"],
						"td_name" => $arSArts["provider_product_name"],
						"name" => $arSArts["provider_product_name"],
						"img_src" => "/images/logomedia/" . $arSArts["bkey"] . ".webp"];
				continue;
			}
		}
		
		unset($partsNoPArray[$SEARCH]);
		/////////////////////////////////
		$LinksCnt = 0;
		// if (config('tecdoc_config.search_in_crosses') == 1)
		// {
			// dd(compact('SEARCH'));
			$pkey_uid_array			= ProductCross::where('akey','=',$SEARCH)->get();
		
			if (!is_null($pkey_uid_array))
			{
				foreach($pkey_uid_array as $item)
				{
					$uid					= $item->uid;
					$crossesArray			= ProductCross::where('uid','=',$uid)->get();
					foreach($crossesArray as $resultItem)
					{
						$LinksCnt = $LinksCnt + 1;
						$partsNoPArray[$resultItem["pkey"]] = [
											"pkey"				=> $resultItem["pkey"],
											"bkey"				=> $resultItem["bkey"],
											"brand"				=> $resultItem["brand"],
											"akey"				=> $resultItem["akey"],
											"article"			=> $resultItem["article"],
											"link_side"			=> $resultItem["side"],
											"img_src"			=> "/images/logomedia/" . $resultItem["bkey"] . ".webp",
											"link_code"			=> $resultItem["code"],
											"name"				=> $resultItem["name"] ?? "Запчасть",
											"prices_count"		=> 0,
											"properties_count"	=> 0,
											"properties"		=> [],
											"superseded"		=> "",
											"img_zoom"			=> "",
											"img_from"			=> "",
											"img_count"			=> "",
											"logo_src"			=> "",
											"uaid"				=> ""];
					}
				}
			}
		// }
		
		
		
		/* ФИЛЬТР : БРЕНД вывод массива брендов для фильтра и счетчик запчастей с таким брендом */
		foreach($partsNoPArray as $pkey=>$TPartArray)
		{
			$ResultArray["all_brands"][$TPartArray["bkey"]] = $TPartArray["brand"];
			if (isset($ResultArray["brands_parts_count"][$TPartArray["brand"]]))
			{
				$ResultArray["brands_parts_count"][$TPartArray["brand"]]++;
			}
			else
			{
				$ResultArray["brands_parts_count"][$TPartArray["brand"]] = 1;
			}
		}		
		$ResultArray["all_brands_count"] = count($ResultArray["all_brands"]);
		/* ФИЛЬТР : БРЕНД */

		if (0 < count($partsNoPArray))
		{
			$arPAIDs_noP_cnt = count($arPAIDs_noP);

			
			
			if (0 < count($partsNoPArray))
			{
				$i = 0;
				foreach ($partsNoPArray as $TPartArray)
				{
					$q = ProviderPrice::where('pkey', $TPartArray["pkey"]);

					if($i < 1)
					{
						$PricesSQL = $q;
					}
					else
					{
						$PricesSQL->union($q);
					}
					$i = $i + 1;
				}				
				if($PricesSQL)
				{
					$ProvidersPrices = $PricesSQL->get()->toArray();
				}

				foreach ($ProvidersPrices as $PriceArray)
				{
					if (config('tecdoc_config.hide_prices_noavail') == 1 && $PriceArray["available"] < 1)
					{
						continue;
					}
					$PrPKey = $PriceArray["pkey"];
					if (trim($PriceArray["provider_product_name"]) != "")
					{
						if (!(in_array($PrPKey, $arNmC)))
						{
							$partsNoPArray[$PrPKey]["name"] = "Запчасть";
							$arNmC[] = $PrPKey;
						}
						if (strlen($partsNoPArray[$PrPKey]["name"]) < strlen($PriceArray["provider_product_name"]))
						{
							$partsNoPArray[$PrPKey]["name"] = $PriceArray["provider_product_name"];
						}
					}
					$PriceArray = Functions::FormatPrice($PriceArray);
					
					$ResultArray["prices"][$PrPKey][] = $PriceArray;
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
					//здесь не все поля заполняются - почему - ненашел
					//изза этого не работает сортировка которые выше
					// if($MaxAvailableArray[$PrPKey]==0 OR $PriceArray['available']>$MaxAvailableArray[$PrPKey]){$MaxAvailableArray[$PrPKey]=$PriceArray['available'];}//initial
					if(!isset($MaxAvailableArray[$PrPKey]) OR $PriceArray['available'] > $MaxAvailableArray[$PrPKey])
					{
						$MaxAvailableArray[$PrPKey] = $PriceArray['available'];
					}

					// if($MinPricesArray[$PrPKey]==0 OR $PriceArray['price_converted']<$MinPricesArray[$PrPKey]){$MinPricesArray[$PrPKey]=$PriceArray['price_converted'];}//initial
					if(!isset($MinPricesArray[$PrPKey]) OR $PriceArray['price_converted'] < $MinPricesArray[$PrPKey])
					{
						$MinPricesArray[$PrPKey] = $PriceArray['price_converted'];
					}
					
					//Minimal day for sorting
					$ItemDAY = intval($PriceArray['day']) + 1; //Что бы товары без цен были всёравно в конце даже если дней доставки =0
					if(!isset($MinDaysArray[$PrPKey]) OR $ItemDAY<$MinDaysArray[$PrPKey])
					{
						$MinDaysArray[$PrPKey] = $ItemDAY;
					}
					//Brands min price
					if(!isset($ResultArray['ab_min_price'][$PriceArray['bkey']]) OR $ResultArray['ab_min_price'][$PriceArray['bkey']]>$PriceArray['price_converted'])
					{
						$ResultArray['ab_min_price'][$PriceArray['bkey']] = $PriceArray['price_converted'];
						$ResultArray['ab_min_price_f'][$PriceArray['bkey']] = $PriceArray['price_converted'];
					}
				}
				unset($arNmC);
			}
			
			if (0 < $arPAIDs_noP_cnt)
			{
				$arPImgAvail = NewTecdocController::ImagesAvialable($arPAIDs_noP);
			}
			if (0 < $LinksCnt)
			{
				$SetCrNum = 0;
				foreach ($partsNoPArray as $pkey => $TPartArray)
				{
					if (isset($TPartArray["link_code"]) && !isset($TPartArray["aid"]))
					{
						$arGPart = NewTecdocController::getPartByPKEY($TPartArray["bkey"], $TPartArray["akey"]);
						if (isset($arGPart["aid"]))
						{
							$SetCrNum = $SetCrNum + 1;
							$partsNoPArray[$pkey]["aid"] = $arGPart["aid"];
							$partsNoPArray[$pkey]["article"] = $arGPart["article"];
							$partsNoPArray[$pkey]["brand"] = $arGPart["brand"];
							$partsNoPArray[$pkey]["td_name"] = $arGPart["td_name"];
							$partsNoPArray[$pkey]["bkey"] = Functions::SingleKey($arGPart["brand"],true);
							$partsNoPArray[$pkey]["akey"] = Functions::SingleKey($arGPart["article"]);
							$partsNoPArray[$pkey]["kind"] = $arGPart["kind"];
							if (!isset($partsNoPArray[$pkey]["name"]))
							{
								$partsNoPArray[$pkey]["name"] = $arGPart["td_name"];
							}
							$arPAIDs_noP[] = $arGPart["aid"];
							$ResultArray["all_brands"][$TPartArray["bkey"]] = $arGPart["brand"];
						}
					}
				}
				$arPAIDs_noP_cnt = count($arPAIDs_noP);
			}
			if (0 < $arPAIDs_noP_cnt && config('tecdoc_config.show_item_props') == 1)
			{
				$rsProps = NewTecdocController::GetPropertiesUnion($arPAIDs_noP);
				foreach ($partsNoPArray as $pkey => $TPartArray)
				{
					// if (array_key_exists("aid", $TPartArray))/XZ
					if (isset($TPartArray["aid"]))//XZ2
					{
						$ar_AID[$pkey] = $TPartArray["aid"];
						$ar_PKEY[$TPartArray["aid"]] = $pkey;
					}
				}
				$arHiddenProps = array(1073);
				$Props_cnt = 0;
				if(isset($rsProps))
				{
					foreach ($rsProps as $arProp)
					{
						if (!($arProp["VALUE"] != ""))
						{
							continue;
						}
						if ($arProp["CRID"] == 836 || $arProp["CRID"] == 596)
						{
							$arProp["name"] = $arProp["VALUE"];
							$arProp["VALUE"] = "";
						}
						if (!(in_array($arProp["aid"], $ar_AID) && !(isset($partsNoPArray[$ar_PKEY[$arProp["aid"]]]["properties"][$arProp["name"]]))))
						{
							continue;
						}
						$Props_cnt = $Props_cnt + 1;
						$partsNoPArray[$ar_PKEY[$arProp["aid"]]]["properties_count"] = $Props_cnt;
						$partsNoPArray[$ar_PKEY[$arProp["aid"]]]["properties"][$arProp["name"]] = $arProp["VALUE"];
					}
				}
			}
			
			$PartsArray = $partsNoPArray;
			$arPAIDs = $arPAIDs_noP;
			$arPAIDs_cnt = count($arPAIDs);
			
			if (config('tecdoc_config.show_item_props') == 1)
			{
				foreach ($PartsArray as $pkey => $TPartArray)
				{
					if (array_key_exists("properties", $TPartArray))
					{
						$arCProps = $TPartArray["properties"];
						$PartsArray[$pkey]["properties"] = [];
						foreach ($arCProps as $PName => $PValue)
						{
							$PName = str_replace("/\xd0\xbc\xd0\xbc?", "/\xd0\xbc\xd0\xbc\xc2\xb2", $PName);
							$PName = str_replace("? ", "\xc3\x98 ", $PName);
							if (0 < strpos($PName, "["))
							{
								$Dim = substr($PName, strpos($PName, "["));
								$PName = str_replace(" " . $Dim, "", $PName);
								$Dim = str_replace("[", "", $Dim);
								$Dim = str_replace("]", "", $Dim);
								$PValue = $PValue . " " . $Dim;
							}
							$PartsArray[$pkey]["properties"][Functions::UWord($PName)] = $PValue;
						}
					}
				}
			}
			if (0 < $arPAIDs_cnt)
			{
				$rsSArts = NewTecdocController::Getsuperseded($arPAIDs);
				if (isset($rsSArts))
				{
					foreach ($rsSArts as $arSArt)
					{
						$arSArts[$arSArt["aid"]] = $arSArt["NEW_ARTICLE"];
					}
					if (isset($arSArts))
					{
						foreach ($PartsArray as $pkey => $TPartArray)
						{
							if (isset($TPartArray["aid"]))
							{
								if (array_key_exists($TPartArray["aid"], $arSArts))
								{
									$PartsArray[$pkey]["superseded"] = $arSArts[$TPartArray["aid"]];
								}
							}
						}
					}
				}
			}
			
			if (0 < $arPAIDs_cnt)
			{
				$rsImages = NewTecdocController::GetImagesUnion($arPAIDs);

				foreach ($rsImages as $arImage)
				{
					$arTImgs[$arImage["aid"]][] = $arImage;
				}
				$img_count = 0;
				foreach ($PartsArray as $pkey => $TPartArray)
				{
					if (array_key_exists("aid", $TPartArray))
					{
						$arTImgs[$TPartArray["aid"]]["path"] = "";
						if (array_key_exists($TPartArray["aid"], $arTImgs) && !strpos($arTImgs[$TPartArray["aid"]]["path"], "0/0.jpg") && $TPartArray["kind"] != 3)
						{
							if (array_key_exists("img_zoom", $PartsArray[$pkey]))
							{
								if ($PartsArray[$pkey]["img_zoom"] == "" && $TPartArray["kind"] != 3)
								{
									if (array_key_exists("0", $arTImgs[$TPartArray["aid"]]) )
									{
										$PartsArray[$pkey]["img_src"] = $arTImgs[$TPartArray["aid"]]["0"]["path"];
										////////////////////////////////////////////////////////////////IMG_RESAVE++
										// if (array_key_exists("0", $arTImgs[$TPartArray["aid"]]) && config('tecdoc_config.IMG_RESAVE') == 1)
										// {
											// $Res = $arTImgs[$TPartArray["aid"]]["0"]["path"];
											// $ArtMedia = "";
											// if(preg_match("/http/",$Res))
											// {
												// $ch = curl_init($Res);
												// curl_setopt($ch, CURLOPT_HEADER, 0);
												// curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
												// curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
												// $ImRes = curl_exec($ch);
												// if ($ImRes)
												// {
													// $ArtDir = $_SERVER["DOCUMENT_ROOT"] . "/images/artmedia/" . $TPartArray["bkey"] . "/";
													// if (!file_exists($ArtDir) && !mkdir($ArtDir, 511, true))
													// {
														// return $ArtMedia;
													// }
													// $ArtMedia = $_SERVER["DOCUMENT_ROOT"] . "/images/artmedia/" . $TPartArray["bkey"] . "/" . $TPartArray["akey"] . ".jpg";
													// file_put_contents($ArtMedia, $ImRes);
												// }
											// }
										// }
										////////////////////////////////////////////////////////////////IMG_RESAVE--											
									}
								}
								$img_count = $img_count + 1;
								$PartsArray[$pkey]["img_count"] = $img_count;
							}
						}
					}
					$ArtMedia = "/images/artmedia/" . $TPartArray["bkey"] . "/" . $TPartArray["akey"] . ".jpg";
					$Artpath = $_SERVER["DOCUMENT_ROOT"] . $ArtMedia;
					if (file_exists($Artpath))
					{
						if(array_key_exists("img_zoom", $PartsArray[$pkey]))
						{
							$PartsArray[$pkey]["img_additional"][] = $PartsArray[$pkey]["img_src"];
						}
						$PartsArray[$pkey]["img_src"] = $ArtMedia;
						$PartsArray[$pkey]["img_zoom"] = "Y";
						$PartsArray[$pkey]["img_from"] = "Local";
					}
					$BrandLogopath = "/images/brands/" . $TPartArray["brand"] . ".png";
					if (array_key_exists('kind',$TPartArray))
					{
						if ($TPartArray["kind"] == 3 && file_exists($_SERVER["DOCUMENT_ROOT"] . $BrandLogopath))
						{
							$PartsArray[$pkey]["logo_src"] = $BrandLogopath;
						}
					}
					$LogoMediaJPG = "/images/logomedia/" . $TPartArray["bkey"] . ".webp";
					$LogoMediaPNG = "/images/logomedia/" . $TPartArray["bkey"] . ".png";
					$TPartArray["local_logo"] = true;//my
					if (file_exists($_SERVER["DOCUMENT_ROOT"] . $LogoMediaPNG))
					{
						$PartsArray[$pkey]["logo_src"] = $LogoMediaPNG;
						$TPartArray["local_logo"] = true;
					}
					else
					{
						if (file_exists($_SERVER["DOCUMENT_ROOT"] . $LogoMediaJPG))
						{
							$PartsArray[$pkey]["logo_src"] = $LogoMediaJPG;
							$TPartArray["local_logo"] = true;
						}
					}
					if (array_key_exists('kind',$TPartArray))
					{
						if (!$TPartArray["local_logo"] && ($TPartArray["kind"] == 0 || $TPartArray["kind"] == 1 || $TPartArray["kind"] == 3))
						{
							$arLogoPAIDs[] = $TPartArray["aid"];
						}
					}
				}
				if (0 < count($arLogoPAIDs))
				{
					$rsBLogos = NewTecdocController::GetArtsLogoUnion($arLogoPAIDs);
					$CntArtsLogos = 0;
					$CntALogAdded = 0;
					foreach ($rsBLogos as $arBLogos)
					{
						$CntArtsLogos = $CntArtsLogos + 1;
						if (array_key_exists('aid',$arBLogos))
						{
							if (!isset($ResultArray["art_logos"][$arBLogos["aid"]]) || $ResultArray["art_logos"][$arBLogos["aid"]] == "")
							{
								$ResultArray["art_logos"][$arBLogos["aid"]] = $arBLogos["path"];
								$CntALogAdded = $CntALogAdded + 1;
							}
						}
					}
				}
				foreach ($PartsArray as $pkey => $TPartArray)
				{
					if (array_key_exists('aid',$TPartArray))
					{
						$PartsArray[$pkey]["logo_src"] = "";
						if (isset($ResultArray["art_logos"][$TPartArray["aid"]]) && $PartsArray[$pkey]["logo_src"] == "")
						{
							$PartsArray[$pkey]["logo_src"] = $ResultArray["art_logos"][$TPartArray["aid"]];
						}
					}
				}
			}
			foreach ($PartsArray as $pkey => $TPartArray)
			{
				$PartsArray[$pkey]["search_url"] = Functions::GetSearchURL($TPartArray["brand"], $TPartArray["akey"]);
				if(empty($TPartArray["name"]))
				{
					$PartsArray[$pkey]["name"] = "Запчасть - " . $TPartArray["brand"] . " - " . $TPartArray["article"];
				}
				//star rating
				$rate = Productrating::where('pkey',$TPartArray["bkey"] . $TPartArray["akey"])->avg('rating');
				$PartsArray[$pkey]["rating"]					= $rate ? $rate : intval(0);
				$PartsArray[$pkey]["rating_left"]				= $rate ? (5 - $rate) : intval(5);
				$PartsArray[$pkey]["reviewscount"]				= $rate ? (ProductRating::where('pkey',$TPartArray["bkey"] . $TPartArray["akey"])->count('client_id')) : intval(0);
			}
			foreach ($PartsArray as $NumKey => $PartArray)
			{
				$ResultArray["parts"][$PartArray["bkey"] . $PartArray["akey"]] = $PartArray;
			}
		}

		$total = count($ResultArray["parts"]);
		if($total>0)
		{
			//items per page
			$perPage = 15;
			$page = $request->page??1;
			$offSet = ($page * $perPage) - $perPage;  
			$itemsForCurrentPage = array_slice($ResultArray["parts"], $offSet, $perPage, true); 
			$Numbers = new LengthAwarePaginator($itemsForCurrentPage, $total, $perPage, $page,['path'  => $request->url(),'query' => $request->query(),]);
			unset($ResultArray["parts"]);
			
			$SEO = "";
			foreach ($PartsArray as $PartArray)
			{
				$SEO .= implode([$PartArray["brand"] . " " . $PartArray["article"] . ", "]);
			}
			SEOMeta::setTitle('Каталог запчастей - поиск по номеру ' . $SEARCH . '');
			SEOMeta::setDescription('Каталог запчастей - поиск по номеру ' . $SEARCH . '');
			OpenGraph::setTitle('Каталог запчастей - поиск по номеру ' . $SEARCH . '');
			OpenGraph::setDescription('Каталог запчастей - поиск по номеру ' . $SEARCH . '');
			SEOMeta::setKeywords($SEO);
			
			// dd(compact('Numbers'));
			return view('shop.catalog.search', compact('ResultArray', 'Numbers', 'total', 'perPage','page'));
		}
		else
		{
			$ResultArray["filtrable"]	= false;
			$posts 						= BlogController::ShowPostsCarousel();
			SEOMeta::setTitle('Каталог запчастей - поиск по номеру ' . $SEARCH . '');
			SEOMeta::setDescription('Каталог запчастей - поиск по номеру ' . $SEARCH . '');
			OpenGraph::setTitle('Каталог запчастей - поиск по номеру ' . $SEARCH . '');
			OpenGraph::setDescription('Каталог запчастей - поиск по номеру ' . $SEARCH . '');
			
			return view('shop.errors.noparts',compact('ResultArray','number','posts'));
		}

	}
	/////////////////////
	
	public function SearchNumberFilter(Request $request)
	{
		$alldata = $request->all();

		// dd(compact('alldata'));
		return redirect()->route('search.number',$catURL.$brandURL.$priceRangeURL.$showURL.$sortByURL);
	}

	static function SearchBrandNumber(Request $request)
	{
		mb_internal_encoding("UTF-8");
		$ResultArray = [
			"art_logos" => [],
			"parts" => [],
			"prices" => [],
			"all_brands" => [],
			"properties_name" => [],
			"ab_min_price" => [],
			"filtrable" => true,
			"ab_min_price_f" => [],
			"randomproducts" => ShopController::RandomProductsWidget()];

		//преобразовываю все в верхний регистр - система tecdoc -  ищет все так
		$brand = Str::upper($request->brand);
		$number = Str::upper($request->number);
		//приводим номер/бренд к виду для поиска
		$S_ARTICLE = Functions::SingleKey($number);
		if (strlen($S_ARTICLE) < 3)
		{
			return view('shop.errors.noparts');
		}
		$S_BRAND = Functions::BrandNameDecode($brand);
		if (strlen($S_BRAND) < 2)
		{
			return view('shop.errors.noparts');
		}
		$S_BRAND_KEY = Functions::SingleKey($S_BRAND, true);//XZ//приводим номер/бренд к виду для поиска - тест - не всегда отрабатывал поиск
		$partsNoPArray = [];
		$arPAIDs_noP = [];
		//добавляется к массиву данные номера который выбрали для поиска
		$FstPKEY = Functions::SingleKey($S_BRAND, true) . $S_ARTICLE;
		$partsNoPArray[$FstPKEY] = [
			"pkey" => $FstPKEY,//ключ bkey . akey
			"bkey" => Functions::SingleKey($S_BRAND, true),//преобразование бренда в ключ bkey
			"akey" => $S_ARTICLE,//преобразование номера по каталогу в ключ akey
			"article" => $S_ARTICLE,//артикул в поиске
			"brand" => $S_BRAND,//бренд в поиске
			"img_src" => "/images/logomedia/" . Functions::SingleKey($S_BRAND, true) . ".webp",//картинка
			"prices_count" => 0,//счетчик цен
			"properties_count" => 0,//счетчик свойств
			"properties" => [],//массив свойств
			"superseded" => "",//состояние поставок
			"img_zoom" => "",//старое изображение
			"img_from" => "",//источник изображения - локальный сервер/удаленка
			"img_count" => "",//счет изображений
			"logo_src" => "",//логотип
			"uaid" => ""];//перекодированный aid - будет ниже
			//эти поля везде одинаковые - это фактически структура всех поисковых запросов исходного модуля

		//Сам поиск по каталогу - отдает очень много и не очень правильно - из за самой структуры текдок
		//дальше это все в цикле перебирается и перезатирается
		//и остается отобранные номера - не совсем корректно, но всех устранивают
		$ArticlesRequest = NewTecdocController::SearchBrandNumber($S_BRAND, $S_ARTICLE);
		$arHiddenTradeNumbers = [];//в исходной версии модуля задумывалось как отбор ориг/неориг в фильтре
		$IsOrigAnalogs = false;//xz//настройка скрывания оригинальных аналогов
		foreach ($ArticlesRequest as $ArticlesArray)//перебор массива отданого от текдок
		{
			$bkey = Functions::SingleKey($ArticlesArray["brand"], true);
			$akey = Functions::SingleKey($ArticlesArray["article"]);
			$partsNoPArray[$bkey . $akey] = [
					"pkey" => $bkey . $akey,
					"bkey" => $bkey,
					"akey" => $akey,
					"kind" => $ArticlesArray["kind"],//добавляется для того чтоб не сыпались ошибки - в прайсе его нет - в текдок - есть
					"aid" => $ArticlesArray["aid"],
					"article" => $ArticlesArray["article"],
					"brand" => $ArticlesArray["brand"],
					"BRAND_CODE" => $ArticlesArray["BRAND_CODE"],//код бренда
					"td_name" => $ArticlesArray["td_name"],
					"name" => $ArticlesArray["td_name"],
					"uaid" => "",
					"img_src" => "/images/logomedia/" . $bkey . ".webp",
					"prices_count" => 0,
					"properties_count" => 0,
					"properties" => [],
					"superseded" => "",
					"img_zoom" => "",
					"img_from" => "",
					"img_count" => "",
					"logo_src" => ""];
			if (Functions::SingleKey($S_BRAND, true) == $bkey && $S_ARTICLE == $akey)
			{
				$partsNoPArray[$bkey . $akey]["searched"] = true;//массив найденых элементов для отдачи в вебсервис
				// $td_name = $ArticlesArray["td_name"];
				// if ($ArticlesArray["kind"] == 3)
				// {
					// $IsOrigAnalogs = true;
				// }
			}
			$arPAIDs_noP[] = $ArticlesArray["aid"];//уникальные ид номера из текдок
			//по ним отдается описание параметров запчастей
		}
		// if ($IsOrigAnalogs)
		// {
			// foreach ($partsNoPArray as $Key => $ArticlesArray)
			// {
				// if ($ArticlesArray["kind"] == 3 && $ArticlesArray["bkey"] != $S_BRAND_KEY)
				// {
					// unset($partsNoPArray[$Key]);
				// }
			// }
		// }
		
		//поиск ТОВАРА в прайсе загруженном в базу сайта 
		//с перебором для удаления повторов
		//тоже самое что и в поиске по текдок, но по базе прайсов
		$S_P_BRAND = Functions::SingleKey($S_BRAND, true);		
		$ProvidersPrices = ProviderPrice::where('akey', '=', $S_ARTICLE)->where('bkey', '=', $S_P_BRAND)->select('bkey', 'akey', 'article', 'brand', 'provider_product_name')->get()->toArray();
		foreach ($ProvidersPrices as $arSArts)
		{
			$arSArts["pkey"] = $arSArts["bkey"] . $arSArts["akey"];
			if (!is_array($partsNoPArray[$arSArts["pkey"]]))
			{
				$partsNoPArray[$arSArts["pkey"]] = [
						"pkey" => $arSArts["pkey"],
						"bkey" => $arSArts["bkey"],
						"akey" => $arSArts["akey"],
						"article" => $arSArts["article"],
						"brand" => $arSArts["brand"],
						"td_name" => $arSArts["provider_product_name"],
						"name" => $arSArts["provider_product_name"],
						"img_src" => "/images/logomedia/" . $arSArts["bkey"] . ".webp"];
			}
			if ($S_BRAND_KEY == $arSArts["bkey"] && $S_ARTICLE == $arSArts["akey"] && $arSArts["provider_product_name"] != "")
			{
				$provider_product_name = trim($arSArts["provider_product_name"]);
			}
		}

		$SrPKEY = Functions::SingleKey($S_BRAND, true) . $S_ARTICLE;
		$SrPKEYc = $SrPKEY;
		//настройка вывода только искомых номеров
		//чтоб не было кросс через кросс
		if (config('tecdoc_config.REQUEST_WS_ONLY_SEARCHED') == 1)
		{
			$arWSP[$S_BRAND . $S_ARTICLE] = [
					"pkey" => $S_BRAND . $S_ARTICLE,
					"bkey" => Functions::SingleKey($S_BRAND, true),
					"akey" => $S_ARTICLE,
					"article" => $request["number"],
					"brand" => $S_BRAND,
					"searched" => true];
		}
		
		///////////////////////////////////<LISTparts>///////////////////////////////////
		require_once 'ListpartsController.php';
		///////////////////////////////////<LISTparts>///////////////////////////////////
		
		$ResultArray["randomproducts"] = ShopController::RandomProductsWidget();
		
		////////////////////////////////
		$total = count($ResultArray["parts"]);
		if (0 < $total)
		{
			$perPage = 15;
			$page = $request->page??1;
			$offSet = ($page * $perPage) - $perPage;  
			$itemsForCurrentPage = array_slice($ResultArray["parts"], $offSet, $perPage, true); 
			$Numbers = new LengthAwarePaginator($itemsForCurrentPage, $total, $perPage, $page,['path'  => $request->url(),'query' => $request->query(),]);
			////////////////////////////////
			if ($request->ajax())
			{
				if(isset($arFirstProduct))
				{
					$content = View::make('catalog.filteredblock', compact('ResultArray','Numbers', 'total', 'perPage', 'arFirstProduct'))->render();
				}
				else
				{
					$content = View::make('catalog.filteredblock', compact('ResultArray','Numbers', 'total', 'perPage'))->render();
				}				
				return response($content);
			};
			////////////////////////////////
			$SEO = "";
			foreach ($PartsArray as $PartArray)
			{
				$SEO .= implode([$PartArray["brand"] . " " . $PartArray["article"] . ", "]);
			}
			
			SEOMeta::setTitle('Аналоги запчасти производителя:  ' . $S_BRAND . ' - ' . $S_ARTICLE . '');
			SEOMeta::setDescription('Аналоги запчасти производителя:  ' . $S_BRAND . ' - ' . $S_ARTICLE . '');
			OpenGraph::setTitle('Аналоги запчасти производителя:  ' . $S_BRAND . ' - ' . $S_ARTICLE . '');
			OpenGraph::setDescription('Аналоги запчасти производителя:  ' . $S_BRAND . ' - ' . $S_ARTICLE . '');
			SEOMeta::setKeywords($SEO);
			////////////////////////////////
			if(isset($arFirstProduct))
			{
				return view('shop.catalog.analogparts', compact('ResultArray','Numbers','total', 'perPage', 'arFirstProduct'));
			}
			else
			{
				return view('shop.catalog.analogparts', compact('ResultArray','Numbers','total', 'perPage'));
			}
			
		}
		else
		{
			return view('shop.errors.noparts');
		}
	}
}
