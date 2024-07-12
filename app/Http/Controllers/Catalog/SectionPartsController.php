<?php

namespace App\Http\Controllers\Catalog;

use App\Models\ModelUrl;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Tecdoc\NewTecdocController;
use App\Http\Controllers\Shop\ShopController;
use App\Http\Controllers\Shop\BlogController;
use App\Http\Controllers\FunctionsController as Functions;

use Illuminate\Pagination\LengthAwarePaginator;

//////////seo
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
//////////seo

class SectionPartsController extends Controller
{
	static function GetSectionParts(Request $request)
	{
		$group = $request->group;
		$manufacturer = $request->manufacturer;
		$model = $request->model;
		
		$url_modification = $request->modification;
		$url_temp = explode ( "-" , $url_modification);
		$modification_id = intval($url_temp["0"]);

		$BrandArray = Functions::GetURLmanufacturer($request->manufacturer);
		
		$ResultArray = [
			"art_logos" => [],
			"parts" => [],
			"prices" => [],
			"all_brands" => [],
			"ubrand" => $BrandArray["uname"],
			"brand" => $BrandArray["name"],
			"properties_name" => [],
			"ab_min_price" => [],
			"filtrable" => true,
			"ab_min_price_f" => [],
			"randomproducts" => ShopController::RandomProductsWidget()];
			
		$model_url = Functions::StringForURL($request->model);
		$section_name = $request->section;
		$section_id = $request->section;
		$sub_section_name = $request->subsection;
		$sub_section_id = $request->subsection;
		// dd($sub_section_name);


        $ManufacturerRequest = NewTecdocController::getManufacturerByCode($group,$ResultArray["ubrand"]);
		foreach ($ManufacturerRequest as $ManufacturerArray)
		{
			$ResultArray["manufacturer_name"] = $ManufacturerArray["manufacturer_name"];
			$model_id = ModelUrl::where('url_name','=', $model)->first()->model_id;
			
			if (0 < $model_id)
			{
				$ModelRequest = NewTecdocController::getModelById($group, $model_id);
                foreach ($ModelRequest as $TemporaryModel)
				{
					$TemporaryModelsArray[] = $TemporaryModel;
				}
				$MNCn = 0;
                foreach ($TemporaryModelsArray as $item)
				{
                    $ModelArray = $item;
                    $MNCn ++;
                    if (isset($arModNames[$BrandArray["name"]]) && isset($arModNames[$BrandArray["name"]][$model_id]) && $arModNames[$BrandArray["name"]][$model_id] == $item["MOD_CDS_TEXT"])
					{
                        break;
                    }
                }
                if (0 < $ModelArray["model_id"])
				{
					$ResultArray["model_id"] = $ModelArray["model_id"];
					$ResultArray["constructioninterval"] = $ModelArray["constructioninterval"];
					$ResultArray["model"] = $ModelArray["name"];

					$ModificationRequest = NewTecdocController::getModificationById($group, $modification_id);
					foreach ($ModificationRequest as $ModificationArray)
					{
                        $ResultArray["modification_id"] = $ModificationArray["modification_id"];
						$Section = NewTecdocController::getSectionName($group, $section_id, $ModificationArray['modification_id']);
                        if (0 < $section_id)
						{
							$subsectionsArray = NewTecdocController::getSectionName($group, $sub_section_id, $ModificationArray['modification_id']);

                            if (0 < $sub_section_id)
							{
                                $ResultArray["subsection_name"] = $Section["description"];
                                $BrandLogoSrc = "/images/brands/" . $ResultArray["brand"] . ".png";
                                if (file_exists($_SERVER["DOCUMENT_ROOT"] . $BrandLogoSrc))
								{
                                    $ResultArray["BRAND_logo_src"] = $BrandLogoSrc;
                                }
								else
								{
                                    $ResultArray["BRAND_logo_src"] = "/images/brands/" . $ResultArray["MFA_MFC_CODE"] . ".png";
                                }

                                $partsNoPArray = [];
                                $arPARTS = [];
								$arNoSecOrig = [];

                                $rsArts = NewTecdocController::GetSectionParts($group, $modification_id, $sub_section_id);
								// dd(compact('rsArts'));
                                $arOrig_AIDs = [];
                                $arPAIDs_noP = [];
                                
								foreach ($rsArts as $ArtsArray)
								{
									$PBKEY = Functions::SingleKey($ArtsArray["brand"], true);
									$PAKEY = Functions::SingleKey($ArtsArray["article"]);
									$partsNoPArray[$PBKEY . $PAKEY] = [
											"pkey" => $PBKEY . $PAKEY,
											"bkey" => $PBKEY,
											"akey" => $PAKEY,
											// "aid" => $ArtsArray["aid"],
											"article" => $ArtsArray["article"],
											"brand" => $ArtsArray["brand"],
											"kind" => "",
											"product_name" => $ArtsArray["product_name"],
											"name" => $ArtsArray["product_name"],
											"img_src" => "/images/logomedia/" . $PBKEY . ".webp",
											"prices_count" => "",
											"properties_count" => "",
											"properties" => [],
											"superseded" => "",
											"img_zoom" => "",
											"img_from" => "",
											"img_count" => "",
											"logo_src" => "",
											"detail_url" => "",
											"uaid" => "",
											"searched" => false];
									if (!in_array($ArtsArray["aid"], $arPAIDs_noP))
									{
										$arPAIDs_noP[] = $ArtsArray["aid"];
									}
								}
								
								///////////////////////////////////<LISTPARTS>///////////////////////////////////
								require_once 'ListpartsController.php';
								///////////////////////////////////<LISTPARTS>///////////////////////////////////

							}
						}
					}
				}
				
				$ResultArray["randomproducts"] = ShopController::RandomProductsWidget();
				$posts = BlogController::ShowPostsCarousel();
				
				////////////////////////////////
				// $total = count($partsNoPArray);
				$total = count($ResultArray["PARTS"]);
				$perPage = 15;
				$page = $request->page??1;
				$offSet = ($page * $perPage) - $perPage;
				$itemsForCurrentPage = array_slice($ResultArray["PARTS"], $offSet, $perPage, true);
				$Numbers = new LengthAwarePaginator($itemsForCurrentPage, $total, $perPage, $page,['path'  => $request->url(),'query' => $request->query(),]);
				////////////////////////////////
				if ($request->ajax())
				{
					$content = View::make('catalog.filteredblock', compact('ResultArray','Numbers', 'total', 'perPage'))->render();
					return response($content);
				};
				////////////////////////////////
				$SEO = "";
				foreach ($Numbers as $PartArray)
				{
					$SEO .= implode([$PartArray["brand"] . " " . $PartArray["article"] . ", "]);
				}
				SEOMeta::setTitle('' . $ResultArray["subsection_name"] . ' для ' . $ResultArray["ubrand"] . ' ' . $ResultArray["model"] . '');
				SEOMeta::setDescription('' . $ResultArray["subsection_name"] . ' для ' . $ResultArray["ubrand"] . ' ' . $ResultArray["model"] . '');
				OpenGraph::setTitle('' . $ResultArray["subsection_name"] . ' для ' . $ResultArray["ubrand"] . ' ' . $ResultArray["model"] . '');
				OpenGraph::setDescription('' . $ResultArray["subsection_name"] . ' для ' . $ResultArray["ubrand"] . ' ' . $ResultArray["model"] . '');
				SEOMeta::setKeywords($SEO);
				////////////////////////////////
				if (0 < $total)
				{
					return view('catalog.sectionparts', compact('ResultArray','Numbers', 'total', 'perPage','posts'));
				}
				else
				{
					//noparts page
					$SPicSrc = "/images/sections/600/" . $section_id . ".png";
					if (file_exists($_SERVER["DOCUMENT_ROOT"] . $SPicSrc))
					{
						$ResultArray["RSECTION_PICTURE"] = $SPicSrc;
					}
					else
					{
						$ResultArray["RSECTION_PICTURE"] = "/images/sections/600/default.png";
					}
					//noparts page
					////////////sections of maintenance
					// $Node = 100019;
					// $SectionsArray = ProductCategory::all()->where('pid','=', $Node)->toArray();
					// $CurUPath = Functions::GenerateURL(["brand" => $arBrnd["code"], "MOD_FURL" => $MODURL, "modification_id" => $ModificationArray["modification_id"],
					// 		"ENGINE" => $ModificationArray["ENG_CODE"], "TYPE_NAME" => $ModificationArray["TYP_CDS_TEXT"]]);
					// $ResultArray["CNT"] = 0;
					// foreach ($SectionsArray as $arSec)
					// {
					// 	$ResultArray["CNT"] ++;
					// 	$SID = $arSec["id"];
					// 	$arSec["URL"] = $CurUPath . "service-parts/" . $arSec["uri"];
					// 	$arSec["TITLE"] = "Section id: " . $SID . " " . $arSec["name"];
					// 	$SPicSrc = "/images/sections/200/" . $SID . ".png";
					// 	if (file_exists($_SERVER["DOCUMENT_ROOT"] . $SPicSrc))
					// 	{
					// 		$arSec["PICTURE"] = $SPicSrc;
					// 	}
					// 	else
					// 	{
					// 		$arSec["PICTURE"] = "/images/sections/200/default.png";
					// 	}
					// 		$ResultArray["SECTIONS"][] = $arSec;
					// }
					////////////sections of maintenance
					dd(compact('ResultArray','posts'));
					return view('shop.errors.nosectionparts', compact('ResultArray','posts'));
				}
			}
			else
			{
				return view('shop.errors.nosectionparts', compact('ResultArray','posts'));
			}
		}
	}
}