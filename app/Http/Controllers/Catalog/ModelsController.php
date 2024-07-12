<?php

namespace App\Http\Controllers\Catalog;

use Illuminate\Support\Str;

use Illuminate\Http\Request;

use App\Models\ModelUrl;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FunctionsController as Functions;
use App\Http\Controllers\Tecdoc\NewTecdocController;
//////////seo
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
//////////seo

class ModelsController extends Controller
{
    static function GetModelsPage(Request $request)
	{

		$group = $request->group;
		$manufacturer = $request->manufacturer;
		$BrandArray = Functions::GetURLmanufacturer($request->manufacturer);
		
		$ResultArray["ubrand"] = $BrandArray["uname"];
		$ResultArray["brand"] = $BrandArray["name"];
		$ResultArray["models"] = [];
		$IDFilterArray = [];
		
		require_once "../app/Http/Controllers/Components/modelarray.php";//rename model transliterated
		
		if ($ResultArray["ubrand"])
		{
			$ManufacturerRequest = NewTecdocController::getManufacturerByCode($group, $ResultArray["ubrand"]);

			foreach ($ManufacturerRequest as $ManufacturerArray)
			{
				$ResultArray["matchcode"] = $ManufacturerArray["matchcode"];
				$ResultArray["models_count"] = 0;
				$ResultArray["manufacturer_id"] = $ManufacturerArray["manufacturer_id"];
				$ResultArray["manufacturer_name"] = $ManufacturerArray["manufacturer_name"];
				
				$ModelsRequest = NewTecdocController::getModels($group, $ResultArray["manufacturer_id"], $pattern = null);
				if (count($ModelsRequest) !==0 )
				{
					require "../app/Http/Controllers/Components/modelurl.php";
					$ResaveFURL = false;
					$b = Str::lower($ResultArray["ubrand"]);
					require "../app/Http/Controllers/Components/modelnames.php";
					require "../app/Http/Controllers/Components/cyrillic.php";
					$DuplicatedURLsArray = [];
					$count = 0;
					foreach ($ModelsRequest as $ModelArray)
					{

						$ModelArray["url_name"] = str_replace($arTrCyr, $arTrLat, $ModelArray["model_name"]);
						
                        $ModelArray["url_name"] = Functions::StringForURL($ModelArray["url_name"]);
                        foreach ($RenameArray as $from => $to)
						{
                            $ModelArray["url_name"] = str_replace($from, $to, $ModelArray["url_name"]);
                        }
                        $count = $count + 1;
						$DuplicatedURLsArray[$ModelArray["url_name"]] = $count;
                        $arModels2[$ModelArray["model_id"]][] = $ModelArray;
                    }
					foreach ($arModels2 as $ModID => $arMods2)
					{
                        $AddMod = $arMods2[0];
                        if (1 < count($arMods2) && isset($arModNames[$b][$ModID]))
						{
                            foreach ($arMods2 as $arMod)
							{
                                if ($arModNames[$b][$ModID] == $arMod["model_name"])
								{
                                    $AddMod = $arMod;
                                    break;
                                }
                            }
                        }
                        $ModelsArray[] = $AddMod;
                    }
					require_once "../app/Http/Controllers/Components/model_groups.php";
					$arTMods = [];
                    $arTitlMods = [];
                    $TCom = "";
                    $TitleModels = "";
                    foreach ($ModelsArray as $ModelArray)
					{
						$ModelArray = ModelsController::MakeModelItem($ModelArray);
						$ModelArray["grouped"] = "N";
						if (array_key_exists($ResultArray["ubrand"], $arHardGroups))
						{
							foreach ($arHardGroups[$ResultArray["ubrand"]] as $GrMod)
							{
								if (strstr($ModelArray["model_name"], $GrMod))
								{
									$ModelArray["grouped"] = "Y";
									if (!in_array($GrMod, $arTMods))
									{
										$arTMods[] = $GrMod;
									}
									$CurModel = strtoupper($GrMod);
								}
							}
						}
						if ($ModelArray["grouped"]!= "Y")
						{
							$arMd = explode(" ", $ModelArray["model_name"]);
							$UMd = strtoupper($arMd[0]);
							$CurModel = $UMd;
						}
						if (isset($arRenamesRegroup[$ResultArray["ubrand"]][$CurModel]))
						{
							$CurModel = $arRenamesRegroup[$ResultArray["ubrand"]][$CurModel];
						}
						if (!in_array($CurModel, $arTitlMods))
						{
							$arTitlMods[] = $CurModel;
						}						
						$PicModelName = str_replace(" ", "_", $CurModel);
						$PicModelName = str_replace("/", "_", $PicModelName);
						$ClrMod = str_replace("ë", "e", $ResultArray["brand"]);
						$ClrMod = str_replace("Ë", "e", $ClrMod);
						$ClrMod = str_replace(" ", "_", $ClrMod);
						$ClrMod = str_replace("'", "", $ClrMod);
						$ModelPicSrc = "/images/models/" . $ClrMod . "/" . $PicModelName . ".jpg";
						if (file_exists($_SERVER["DOCUMENT_ROOT"] . $ModelPicSrc))
						{
							$ResultArray["model_picture"][$CurModel] = $ModelPicSrc;
						}
						else
						{
							$ResultArray["model_picture"][$CurModel] = "/images/models/default.jpg";
                        }
                        if (isset($ModelFormatedURLArray[$b]) && in_array($ModelArray["model_id"], $ModelFormatedURLArray[$b]))
						{
                            $URLN = array_search($ModelArray["model_id"], $ModelFormatedURLArray[$b]);
                        }
						else
						{

                            $URLN = $ModelArray["url_name"];
                            if (1 < $DuplicatedURLsArray[$URLN])
							{
                                $S = $ModelArray["date_from"];
                                if ($ModelArray["date_to"] == !null)
								{
                                    $E = $ModelArray["date_to"];
                                }
								else
								{
                                    $E = "XXXX";
                                }
                                $URLN = $URLN . "-" . $S . "~" . $E;
                            }
							if (!isset($ModelFormatedURLArray[$b]) || !array_key_exists($URLN, $ModelFormatedURLArray[$b]))
							{
                                $ModelFormatedURLArray[$b][$URLN] = $ModelArray["model_id"];
                                $ResaveFURL = true;
                            }
							else
							{
                                if ($ModelFormatedURLArray[$b][$URLN] != $ModelArray["model_id"])
								{
                                    $URLN = $URLN . "-m" . $ModelArray["model_id"];
                                    if (!isset($URLN) || $ModelFormatedURLArray[$b][$URLN]!= $ModelArray["model_id"])
									{
                                        $ModelFormatedURLArray[$b][$URLN] = $ModelArray["model_id"];
                                        $ResaveFURL = true;
                                    }
                                }
                            }
                        }
						$ModelArray["model_filtered_url"] = $URLN;

                        $ModelArray["model_url"] = Functions::GenerateURL(["group"=>$group, "brand" => $BrandArray["code"], "model_name" => $ModelArray["url_name"], "model_filtered_url" => $URLN, "model_id" => $ModelArray["model_id"]]);
                        if ((string) intval($CurModel) == $CurModel && 0 < !strpos($CurModel, " "))
						{
                            $CurModel = $CurModel . " ";
                        }
                        $ResultArray["models"][$CurModel][] = $ModelArray;
                    }
					if ($ResaveFURL)
					{
						foreach ($ModelFormatedURLArray as $b => $arFurls)
						{
							$arFResave[] = array("A", $b, $arFurls, array(1, 1, 1, 0));
						}
					}
					$ResultArray["models_count"] = count($ResultArray["models"]);
					$BrandLogoSrc = "/images/brands/" . $request->manufacturer . ".png";
					if (file_exists($_SERVER["DOCUMENT_ROOT"] . $BrandLogoSrc))
					{
						$ResultArray["brand_logo_src"] = $BrandLogoSrc;
					}
					else
					{
						$ResultArray["brand_logo_src"] = "/images/brands/" . $ResultArray["matchcode"] . ".png";
					}
					foreach ($arTitlMods as $TMod)
					{
						$TitleModels .= $TCom . $TMod;
						$TCom = ", ";
					}
					$Sorts = [];
					foreach ($ResultArray["models"] as $GrName => $arMod)
					{
						$Sorts[] = $GrName;
					}
					array_multisort($Sorts, SORT_ASC, SORT_STRING, $ResultArray["models"]);
				}
			}
			
			return view("inventory.admin_catalog.models", compact("ResultArray"));
		}
		else
		{
			return view("inventory.errors.noparts");
		}
	}

    static function GetShopModels(Request $request)
	{

		$group = $request->group;
		$manufacturer = $request->manufacturer;
		$BrandArray = Functions::GetURLmanufacturer($request->manufacturer);
		
		$ResultArray["ubrand"] = $BrandArray["uname"];
		$ResultArray["brand"] = $BrandArray["name"];
		$ResultArray["models"] = [];
		$IDFilterArray = [];
		
		require_once "../app/Http/Controllers/Components/modelarray.php";
		
		if ($ResultArray["ubrand"])
		{
			$ManufacturerRequest = NewTecdocController::getManufacturerByCode($group, $ResultArray["ubrand"]);

			foreach ($ManufacturerRequest as $ManufacturerArray)
			{
				$ResultArray["matchcode"] = $ManufacturerArray["matchcode"];
				$ResultArray["models_count"] = 0;
				$ResultArray["manufacturer_id"] = $ManufacturerArray["manufacturer_id"];
				$ResultArray["manufacturer_name"] = $ManufacturerArray["manufacturer_name"];
				
				$ModelsRequest = NewTecdocController::getModels($group, $ResultArray["manufacturer_id"], $pattern = null);

				if (count($ModelsRequest) !==0 )
				{
					$b = Str::lower($ResultArray["ubrand"]);
					require "../app/Http/Controllers/Components/modelnames.php";
					require "../app/Http/Controllers/Components/cyrillic.php";
					$DuplicatedURLsArray = [];
					$count = 0;
					foreach ($ModelsRequest as $ModelArray)
					{
						$ModelArray["url_name"] = str_replace($arTrCyr, $arTrLat, $ModelArray["model_name"]);

                        $ModelArray["url_name"] = Functions::StringForURL($ModelArray["url_name"]);
						
					
                        foreach ($RenameArray as $from => $to)
						{
                            $ModelArray["url_name"] = str_replace($from, $to, $ModelArray["url_name"]);
                        }
						//models slug table
						$model_table = ModelUrl::updateOrCreate(["model_id" => $ModelArray["model_id"], "manufacturer_id"=>$ManufacturerArray["manufacturer_id"], "url_name" => $ModelArray["url_name"]]);
						
                        $count = $count + 1;
						$DuplicatedURLsArray[$ModelArray["url_name"]] = $count;
                        $arModels2[$ModelArray["model_id"]][] = $ModelArray;
                    }
					foreach ($arModels2 as $ModID => $arMods2)
					{
                        $AddMod = $arMods2[0];
                        if (1 < count($arMods2) && isset($arModNames[$b][$ModID]))
						{
                            foreach ($arMods2 as $arMod)
							{
                                if ($arModNames[$b][$ModID] == $arMod["model_name"])
								{
                                    $AddMod = $arMod;
                                    break;
                                }
                            }
                        }
                        $ModelsArray[] = $AddMod;
                    }
					require_once "../app/Http/Controllers/Components/model_groups.php";
					$arTMods = [];
                    $arTitlMods = [];
                    $TCom = "";
                    $TitleModels = "";
                    foreach ($ModelsArray as $ModelArray)
					{
						$ModelArray = ModelsController::MakeModelItem($ModelArray);
						$ModelArray["grouped"] = "N";
						if (array_key_exists($ResultArray["ubrand"], $arHardGroups))
						{
							foreach ($arHardGroups[$ResultArray["ubrand"]] as $GrMod)
							{
								if (strstr($ModelArray["model_name"], $GrMod))
								{
									$ModelArray["grouped"] = "Y";
									if (!in_array($GrMod, $arTMods))
									{
										$arTMods[] = $GrMod;
									}
									$CurModel = strtoupper($GrMod);
								}
							}
						}
						if ($ModelArray["grouped"]!= "Y")
						{
							$arMd = explode(" ", $ModelArray["model_name"]);
							$UMd = strtoupper($arMd[0]);
							$CurModel = $UMd;
						}
						if (isset($arRenamesRegroup[$ResultArray["ubrand"]][$CurModel]))
						{
							$CurModel = $arRenamesRegroup[$ResultArray["ubrand"]][$CurModel];
						}
						if (!in_array($CurModel, $arTitlMods))
						{
							$arTitlMods[] = $CurModel;
						}						
						$PicModelName = str_replace(" ", "_", $CurModel);
						$PicModelName = str_replace("/", "_", $PicModelName);
						$ClrMod = str_replace("ë", "e", $ResultArray["brand"]);
						$ClrMod = str_replace("Ë", "e", $ClrMod);
						$ClrMod = str_replace(" ", "_", $ClrMod);
						$ClrMod = str_replace("'", "", $ClrMod);
						$ModelPicSrc = "/images/models/" . $ClrMod . "/" . $PicModelName . ".jpg";
						if (file_exists($_SERVER["DOCUMENT_ROOT"] . $ModelPicSrc))
						{
							$ResultArray["model_picture"][$CurModel] = $ModelPicSrc;
						}
						else
						{
							$ResultArray["model_picture"][$CurModel] = "/images/models/default.jpg";
                        }
                        if (isset($ModelFormatedURLArray[$b]) && in_array($ModelArray["model_id"], $ModelFormatedURLArray[$b]))
						{
                            $URLN = array_search($ModelArray["model_id"], $ModelFormatedURLArray[$b]);
                        }
						else
						{

                            $URLN = $ModelArray["url_name"];
                            if (1 < $DuplicatedURLsArray[$URLN])
							{
                                $S = $ModelArray["date_from"];
                                if ($ModelArray["date_to"] == !null)
								{
                                    $E = $ModelArray["date_to"];
                                }
								else
								{
                                    $E = "XXXX";
                                }
                                $URLN = $URLN . "-" . $S . "~" . $E;
                            }
							if (!isset($ModelFormatedURLArray[$b]) || !array_key_exists($URLN, $ModelFormatedURLArray[$b]))
							{
                                $ModelFormatedURLArray[$b][$URLN] = $ModelArray["model_id"];
                                $ResaveFURL = true;
                            }
							else
							{
                                if ($ModelFormatedURLArray[$b][$URLN] != $ModelArray["model_id"])
								{
                                    $URLN = $URLN . "-m" . $ModelArray["model_id"];
                                    if (!isset($URLN) || $ModelFormatedURLArray[$b][$URLN]!= $ModelArray["model_id"])
									{
                                        $ModelFormatedURLArray[$b][$URLN] = $ModelArray["model_id"];
                                        $ResaveFURL = true;
                                    }
                                }
                            }
                        }
						$ModelArray["model_filtered_url"] = $URLN;

                        $ModelArray["model_url"] = Functions::GenerateURL(["group"=>$group, "brand" => $BrandArray["code"], "model_name" => $ModelArray["url_name"], "model_filtered_url" => $URLN, "model_id" => $ModelArray["model_id"]]);
						// dd(compact("ModelArray"));
                        if ((string) intval($CurModel) == $CurModel && 0 < !strpos($CurModel, " "))
						{
                            $CurModel = $CurModel . " ";
                        }
                        $ResultArray["models"][$CurModel][] = $ModelArray;
                    }
					if ($ResaveFURL)
					{
						foreach ($ModelFormatedURLArray as $b => $arFurls)
						{
							$arFResave[] = array("A", $b, $arFurls, array(1, 1, 1, 0));
						}
					}
					$ResultArray["models_count"] = count($ResultArray["models"]);
					$BrandLogoSrc = "/images/brands/" . $request->manufacturer . ".png";
					if (file_exists($_SERVER["DOCUMENT_ROOT"] . $BrandLogoSrc))
					{
						$ResultArray["brand_logo_src"] = $BrandLogoSrc;
					}
					else
					{
						$ResultArray["brand_logo_src"] = "/images/brands/" . $ResultArray["matchcode"] . ".png";
					}
					foreach ($arTitlMods as $TMod)
					{
						$TitleModels .= $TCom . $TMod;
						$TCom = ", ";
					}
					$Sorts = [];
					foreach ($ResultArray["models"] as $GrName => $arMod)
					{
						$Sorts[] = $GrName;
					}
					array_multisort($Sorts, SORT_ASC, SORT_STRING, $ResultArray["models"]);
				}
			}
			// dd(compact("ResultArray"));
			return view("shop.catalog.models", compact("ResultArray"));
		}
		else
		{
			return view("shop.errors.noparts");
		}
	}


	static function MakeModelItem($ModelArray)
	{
		$constructioninterval = $ModelArray["constructioninterval"];
		$uri_date = explode (" - " , $constructioninterval);

		$ModelArray["date_from"] = $uri_date["0"];
		$ModelArray["date_to"] = $uri_date["1"];
		return $ModelArray;
	}
}
