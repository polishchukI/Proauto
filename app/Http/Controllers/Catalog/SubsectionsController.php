<?php

namespace App\Http\Controllers\Catalog;

use DB;

use Illuminate\Http\Request;

use Illuminate\Support\Str;

use App\Models\ModelUrl;

use App\Http\Controllers\Shop\ShopController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Tecdoc\NewTecdocController;
use App\Http\Controllers\FunctionsController as Functions;

//////////seo
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
//////////seo

class SubsectionsController extends Controller
{
    static function GetSubsections(Request $request)
	{
		$group = $request->group;
		$manufacturer = $request->manufacturer;
		$model = $request->model;
		
		$url_modification = $request->modification;
		$url_temp = explode ( "-" , $url_modification);
		$modification_id = intval($url_temp["0"]);

		$BrandArray = Functions::GetURLmanufacturer($request->manufacturer);
		$ResultArray["ubrand"] = $BrandArray["uname"];
		$ResultArray["brand"] = $BrandArray["name"];		

		$model_url = Functions::StringForURL($request->model);
		$ResultArray["csec_link"] = url()->full();
		$ResultArray["sections"] = [];
		$ResultArray["sections_count"] = 0;
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
				if (isset($ModelArray["model_id"]))
				{
					$ResultArray["model_id"] = $ModelArray["model_id"];
					$ResultArray["constructioninterval"] = $ModelArray["constructioninterval"];
					$ResultArray["model"] = $ModelArray["name"];
					
					$ModificationRequest = NewTecdocController::getModificationById($group, $modification_id);
					foreach ($ModificationRequest as $ModificationArray)
					{
						$mod_id = $ModificationArray['modification_id'];
						$requestData[$ModificationArray['modification_id']] = [];
						$requestData[$ModificationArray['modification_id']]['modification_id'] = $mod_id;
						foreach($ModificationRequest as $ModificationArray)
						{
							if($ModificationArray['modification_id'] == $mod_id)
							{
								$ResultArray['id'] = $mod_id;
								$ResultArray[Str::lower($ModificationArray['attributetype'])] = $ModificationArray['displayvalue'];
								if($ModificationArray['attributetype'] == 'Capacity')
								{
									$modification_name = Functions::StringForURL($ModificationArray['displayvalue']);
									$ResultArray['modification_name'] = $modification_name;
								}
								if($ModificationArray['attributetype'] == 'EngineCode')
								{
									$enginecode = Functions::StringForURL($ModificationArray['displayvalue']);
								}
								if($ModificationArray['attributetype'] == 'Capacity')
								{
									$ResultArray['modification_name'] = Functions::StringForURL($ModificationArray['displayvalue']);
								}
							}
						}
						// $ResultArray['url'] = Functions::GenerateURL(['group' => $group, 'brand' => $BrandArray['code'], 'model_name' => $model, 'modification_id' => $mod_id, 'engine' => $enginecode, 'modification_name' => $modification_name]);

						$BrandLogoSrc = "/images/brands/" . $ResultArray["manufacturer_name"] . ".png";
						
                        if (file_exists($request->server('DOCUMENT_ROOT') . $BrandLogoSrc))
						{
                            $ResultArray["brand_logo_src"] = $BrandLogoSrc;
                        }
						else
						{
                            $ResultArray["brand_logo_src"] = "/images/brands/" . $ResultArray["manufacturer_name"] . ".png";
                        }
						$section_id = $request->section;
						$sectionSeo = Functions::GetSectionDescription($section_id);
						$Section = NewTecdocController::getSectionName($group, $section_id,$ModificationArray['modification_id']);
						$ResultArray["section_name"] = $Section["description"];
						foreach ($sectionSeo as $item)
						{
							$ResultArray["seo"] = 1;
							if(isset($item["sec_seo"]))
							{
								$ResultArray["section_seo"] = $item["sec_seo"];
							}
							if(isset($item["sec_seo_header"]))
							{
								$ResultArray["sec_seo_header"] = $item["sec_seo_header"];
							}
							if(isset($item["sec_seo_header"]))
							{
								$ResultArray["sec_seo_causes_failure"] = $item["sec_seo_causes_failure"];
							}
							if(isset($item["sec_seo_failures"]))
							{
								$ResultArray["sec_seo_failures"] = $item["sec_seo_failures"];
							}
							if(isset($item["seo_service_life"]))
							{
								$ResultArray["seo_service_life"] = $item["seo_service_life"];
							}
							if(isset($item["sec_seo_types"]))
							{
								$ResultArray["sec_seo_types"] = $item["sec_seo_types"];
							}
							if(isset($item["sec_seo_replacement"]))
							{
								$ResultArray["sec_seo_replacement"] = $item["sec_seo_replacement"];
							}
							if(isset($item["sec_seo_buy"]))
							{
								$ResultArray["sec_seo_buy"] = $item["sec_seo_buy"];
							}
						}
						//+++
						$ResultArray['root_section_link'] = Functions::GenerateURL(['group' => $group, 'brand' => $BrandArray['code'], 'model_name' => $model, 'modification_id' => $mod_id, 'engine' => $enginecode, 'modification_name' => $modification_name]);
						$ResultArray["current_section_link"] = $ResultArray["root_section_link"] . $request['section'] . "/";
                        $SPicSrc = "/images/sections/600/" . $section_id . ".png";
                        if (file_exists($request->server('DOCUMENT_ROOT') . $SPicSrc))
						{
                            $ResultArray["rsection_picture"] = $SPicSrc;
                        }
						else
						{
                            $ResultArray["rsection_picture"] = "/images/sections/600/default.png";
                        }
						$ResultArray["filter_by_modification"] = $modification_id;
                        $arSUB_SIDS = [];
					}
					
					$Level2SectionsArray = NewTecdocController::getSections($group, $modification_id, $section_id);
					$ResultArray["sections_count"] += count($Level2SectionsArray);
					foreach($Level2SectionsArray as $Level2Section)
					{
						// dd($ResultArray["sections_count"]);
						$Level2Section["uri"] = $Level2Section["node_id"] ."-". $Level2Section["description"]; 
						$ResultArray["sections"][] = $Level2Section;
						$Level3SectionsArray = NewTecdocController::getSections($group, $modification_id, $Level2Section["node_id"]);
						$ResultArray["sections_count"] += count($Level3SectionsArray);
						foreach($Level3SectionsArray as $Level3Section)
						{
							
								$Level3Section["uri"] = $Level3Section["node_id"] ."-". $Level3Section["description"]; 
								$ResultArray["sections"][] = $Level3Section;
								$Level4SectionsArray = NewTecdocController::getSections($group, $modification_id, $Level3Section["node_id"]);
								foreach($Level4SectionsArray as $Level4Section)
								{
									$ResultArray["sections_count"] += count($Level4SectionsArray);
									if($Level4Section['parentid'] == $Level3Section["node_id"])
									{
										$ResultArray["sections_count"]++;
										$Level4Section["uri"] = $Level4Section["node_id"] ."-". $Level4Section["description"]; 
										$ResultArray["sections"][] = $Level4Section;
									}
								}
						}
					}
				}
			}
		}
		$ResultArray["randomproducts"] = ShopController::RandomProductsWidget();
		////////////////////////////////
		$seo = 'Подразделы запчастей для ' . $ResultArray["ubrand"] . ' ' . $ResultArray["model"] .  ' ' . $ResultArray["modification_name"] . ' ' . $ResultArray["constructioninterval"]. '';
		foreach ($ResultArray["sections"] as $SEOSection)
		{
			$seo .= implode([$SEOSection["description"] . ", "]);
		}
		SEOMeta::setTitle($seo);
		SEOMeta::setDescription($seo);
		OpenGraph::setTitle($seo);
		OpenGraph::setDescription($seo);
		SEOMeta::setKeywords($seo);
		// dd(compact('ResultArray'));
		return view('shop.catalog.subsections', compact('ResultArray'));
	}
}
