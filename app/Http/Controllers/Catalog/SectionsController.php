<?php

namespace App\Http\Controllers\Catalog;

use Illuminate\Support\Str;

use App\Models\ModelUrl;

use App\Models\Catalog\CatalogPassangerCarTree;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FunctionsController as Functions;
use App\Http\Controllers\Tecdoc\NewTecdocController;
use App\Http\Controllers\Shop\ShopController;
use App\Http\Controllers\Shop\BlogController;
//////////seo
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
//////////seo

class SectionsController extends Controller
{
    public function GetSectionstree(Request $request)
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
		$ResultArray["sections"] = [];
		$root_id = 0;//root directory
		
		if ($ResultArray["ubrand"] && (0<$modification_id))
		{
			$ManufacturerRequest = NewTecdocController::getManufacturerByCode($group,$ResultArray["ubrand"]);
			foreach ($ManufacturerRequest as $ManufacturerArray)
			{
				$ResultArray["manufacturer_name"] = $ManufacturerArray["manufacturer_name"];
				$model_id = ModelUrl::where('url_name','=', $model)->first()->model_id;
				if (0 < $model_id)
				{
					$ModelRequest = NewTecdocController::getModelById($group, $model_id);
					foreach ($ModelRequest as $arModel2)
					{
						$arMods2[] = $arModel2;
					}
					
					$MNCn = 0;
					foreach ($arMods2 as $arMod2)
					{
						$ModelArray = $arMod2;
						$MNCn = $MNCn + 1;
						if (isset($arModNames[$BrandArray["name"]]) && isset($arModNames[$BrandArray["name"]][$model_id]) && $arModNames[$BrandArray["name"]][$model_id] == $arMod2["MOD_CDS_TEXT"]) 
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
						foreach($ModificationRequest as $ModificationArray)
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
							
							$ResultArray['url'] = Functions::GenerateURL(['group' => $group, 'brand' => $BrandArray['code'], 'model_name' => $model, 'modification_id' => $mod_id, 'engine' => $enginecode, 'modification_name' => $modification_name]);
							$BrandLogoSrc = "/images/brands/" . $ResultArray["brand"] . ".png";
							
							if (file_exists($_SERVER["DOCUMENT_ROOT"] . $BrandLogoSrc))
							{
								$ResultArray["brand_logo_src"] = $BrandLogoSrc;
							}
							else
							{
								$ResultArray["brand_logo_src"] = "/images/brands/" . $ResultArray["brand"] . ".png";
							}
							//car logo
							$pos = strpos($model," ");
							$modIco = substr($model,0,$pos);
							$CarLogoSrc = "/images/models/" . $ResultArray["brand"] . "/" . $modIco . ".jpg";
							if (file_exists($_SERVER["DOCUMENT_ROOT"] . $CarLogoSrc))
							{
								$ResultArray["car_logo_src"] = $CarLogoSrc;
							}
							else
							{
								$ResultArray["car_logo_src"] = "/images/brands/" . $ResultArray["ubrand"] . ".png";
							}
							
							$ResultArray["title"] = '' . $ResultArray["ubrand"] . ' ' . $ResultArray["model"] .  ' ' . $ResultArray["capacity"] . '';
							//jstree
							$treejs = '';
							$current_uri = url()->full();
							$this->getTreeJS($root_id, $treejs, $group, $modification_id, $current_uri);
							$treeJS = $treejs;
							//jstree

							$posts = BlogController::ShowPostsCarousel();
							////////////////////////////////
							$SEO = 'Разделы запчастей для ' . $ResultArray["ubrand"] . ' ' . $ResultArray["model"] .  ' ' . $ResultArray["capacity"] . '';
							foreach ($ResultArray["sections"] as $SEOSection)
							{
								$SEO .= implode([$SEOSection["name"] . ", "]);
							}
							SEOMeta::setTitle('Разделы запчастей для ' . $ResultArray["ubrand"] . ' ' . $ResultArray["model"] .  ' ' . $ResultArray["capacity"] . ' ' . $ResultArray["fueltype"] . ' ' . $ResultArray["constructioninterval"]. '');
							SEOMeta::setDescription('Разделы запчастей для ' . $ResultArray["ubrand"] . ' ' . $ResultArray["model"] .  ' ' . $ResultArray["capacity"] . ' ' . $ResultArray["fueltype"] . ' ' . $ResultArray["constructioninterval"]. '');
							OpenGraph::setTitle('Разделы запчастей для ' . $ResultArray["ubrand"] . ' ' . $ResultArray["model"] .  ' ' . $ResultArray["capacity"] . ' ' . $ResultArray["fueltype"] . ' ' . $ResultArray["constructioninterval"]. '');
							OpenGraph::setDescription('Разделы запчастей для ' . $ResultArray["ubrand"] . ' ' . $ResultArray["model"] .  ' ' . $ResultArray["capacity"] . ' ' . $ResultArray["fueltype"] . ' ' . $ResultArray["constructioninterval"]. '');
							SEOMeta::setKeywords($SEO);
							////////////////////////////////
							
							return view('shop.catalog.sections', compact('ResultArray','posts', 'treeJS'));
						}
					}
				}
			}
		}
	}

	private function getTreeJS($root_id, &$treejs, $group, $modification_id, $uri)
    {
        $groups = CatalogPassangerCarTree::select('id', 'description as text', 'parentid')->where('passangercarid','=', (int)$modification_id)->where('parentid', '=', (int)$root_id)->get();
        $treejs .= '[';
        foreach($groups as $group)
        {
			$group->href = $uri . '/' . Str::slug($group->text) . '-' . $group->id;
            $treejs .= '{';
				$treejs .= '"dbid":"' . $group->id . '", ';
                $treejs .= '"text": "' . $group->text . '", ';
                $treejs .= '"href": "' . $group->href . '", ';
                $treejs .= '"children" : ';
                
            $treejs .= $this->getTreeJS($group->id, $treejs, $group, $modification_id, $uri);
            
        
            $treejs .= '}, ';
        }
        $treejs .= ']';
    }
}
