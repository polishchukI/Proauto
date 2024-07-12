<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;

use Illuminate\Support\Str;

use App\Models\Product\ProductCross;

use App\Models\Inventory\Provider;
use App\Models\Inventory\ProviderPrice;

use App\Models\Webservice\ProviderWebserviceTime;
use App\Models\Webservice\ProviderWebserviceCounter;

use App\Http\Controllers\FunctionsController as Functions;

class WSController extends Controller
{
	static public $OnlinePricesArray = [];

    public $NewCrossesArray = [];
	
    static public function SearchPrices($WSpartsArray = [], $PagedCArray = [], $ParamsArray)
	{
		\Debugbar::disable();

		define('day_stamp', Carbon::now()->timestamp);
		
		$SummaryCount = 0;
        foreach ($WSpartsArray as $pkey => $CPartArray)
		{
			$SummaryCount ++;
			$SummaryArray[$pkey] = [
				"bkey" => $CPartArray["bkey"],
				"akey" => $CPartArray["akey"],
				"brand" => $CPartArray["brand"],
				"article" => $CPartArray["article"]];
			if(array_key_exists('searched',$CPartArray))
			{
				if($CPartArray["searched"] == true)
				{
					$searched = $CPartArray["searched"];
				}
			}
        }
		$PagedArray = [];
		foreach ($PagedCArray as $pkey => $CPartArray)
		{
            $PagedArray[$pkey] = [
				"bkey" => $CPartArray["bkey"],
				"akey" => $CPartArray["akey"],
				"brand" => $CPartArray["brand"],
				"article" => $CPartArray["article"]];
            if ($CPartArray["searched"] == true)
			{
				$searched = $CPartArray["searched"];
			}
        }
		$cache_mode = ($ParamsArray["cache_mode"] == true) ? 1 : 0;
		
		$Update = "N";
		$resDB = Provider::where('cache','=', $cache_mode)->where('hasprice','=', "Webservice")->where('active','=', "1")->get();
		if ($resDB)
		{
			$resDB = $resDB->toArray();
			
            if(isset($SummaryArray))
			{
				$SummaryCount = count($SummaryArray);
			}

            if(isset($PagedArray))
			{
				$PagedCount = count($PagedArray);
				$WSPartsArray = $PagedArray;////error $WSPartsArray - is empty
			}
			
            $Time = time();
            foreach ($resDB as $WSSettingsArray)
			{
                if(isset($searched))
				{
					$WSSettingsArray["have_searched"] = $searched;
				}
                $WSCounterRequest = ProviderWebserviceCounter::where('wsid','=', $WSSettingsArray["id"])->where('time_stamp','=', day_stamp)->get()->toArray();
                $WSCounterArray = [];
				if ($WSCounterRequest)
				{
					foreach($WSCounterRequest as $WSCounterArray)
					{
						if (0 < $WSSettingsArray["daily_limit"] && $WSSettingsArray["daily_limit"] <= $WSCounterArray["counter"])
						{
							continue;
						}
					}
				}
				else
				{
                    ProviderWebserviceCounter::updateOrCreate(['wsid' => $WSSettingsArray["id"], 'time_stamp' => day_stamp]);
                }
				$WSSettingsArray["links_take"] = ($ParamsArray["links_take"] == "OFF") ? 0 : 1;
				
				/////////////////////////
                if ($ParamsArray["cache_mode"] && $WSSettingsArray["cache"] == 1)
				{					
					$WSPartsArray = $SummaryArray;
					if ($ParamsArray["pkey"] != "")
					{
						$RequestWSTime = ProviderWebserviceTime::where('wsid','=', $WSSettingsArray["id"])->where('pkey','=', $ParamsArray["pkey"])->get();
					}
					else
					{
						$RequestWSTime = ProviderWebserviceTime::where('wsid','=', $WSSettingsArray["id"])->where('sid','=', $ParamsArray["sid"])->get();
					}
					$rsWST = [];
					foreach($RequestWSTime as $arSQL)
					{
						$rsWST[] = ["time" => $arSQL->time];
					}
					///////////////////////
					$WSCounterArray["cache_counter"] = 0;
					foreach ($rsWST as $arWST)
					{
						$RFTime = $WSSettingsArray["refresh_time"] * 3600;
						if ($Time < $arWST["time"] + $RFTime)
						{
							if(isset($WSPartsArray))//test error WSPartsArray not......
							{
								$WSCounterArray["cache_counter"] = $WSCounterArray["cache_counter"] + count($WSPartsArray);
								$Update = "Y";
							}
							// unset($WSPartsArray);
						}
					}
				}				
				$WSPartsCount = count($WSPartsArray);
				
				if (isset($WSPartsArray) && 0 < $WSPartsCount)
				{	
                    if ($ParamsArray["cache_mode"] && $WSSettingsArray["cache"] == 1 && $WSSettingsArray["query_limit"] < $SummaryCount)
					{
						$WSCounterArray["sockets_counter"] = 0;
				
                        if (extension_loaded("sockets"))
						{
							$WSCounterArray["sockets_counter"] = $WSCounterArray["sockets_counter"] + $WSPartsCount;
							$Update = "Y";
                        }
                    }
					else
					{
                        WSController::WSQuery($WSSettingsArray, $WSPartsArray, $ParamsArray);
                        $Update = "Y";
                    }
                }
			
                if ($Update == "Y")
				{
					if (isset($WSCounterArray["counter"]))
					{
						$WSCounterArray["counter"] = $WSPartsCount + $WSCounterArray["counter"];
						if ($ParamsArray["sid"] != "")
						{
							$WSCounterArray["section_counter"] = $WSCounterArray["section_counter"] + $WSPartsCount;
						}
						else
						{
							if (isset($ParamsArray["srch"]) && $ParamsArray["srch"] == "Y")
							{
								$WSCounterArray["search_counter"] = $WSCounterArray["search_counter"] + $WSPartsCount;
							}
							else
							{
								if ($ParamsArray["pkey"] != "")
								{
									$WSCounterArray["analog_counter"] = $WSCounterArray["analog_counter"] + $WSPartsCount;
								}
							}
						}
						$arFields = ["counter" => intval($WSCounterArray["counter"]), "section_counter" => intval($WSCounterArray["section_counter"]), "search_counter" => intval($WSCounterArray["search_counter"]), "analog_counter" => intval($WSCounterArray["analog_counter"]), "sockets_counter" => intval($WSCounterArray["sockets_counter"]), "cache_counter" => intval($WSCounterArray["cache_counter"])];
						ProviderWebserviceCounter::where(['wsid' => $WSSettingsArray["id"], 'time_stamp' => day_stamp])->update($arFields);
					}
					else
					{
						$WSCounterArray["counter"] = intval(0);
					}
                }
            }
        }
    }

    public static function WSQuery($WSSettingsArray, $WSPartsArray, $ParamsArray)
	{						
		$ERROR				= "";
        $ProviderPricesArray		= [];
        $DARows				= 0;
        $AARows				= 0;
		$WSLinksTake		= ($WSSettingsArray["links_take"] == 1) ? "ON" : "OFF";
		$analitics_ip		= "localhost";
		$PriceTime			= Functions::SetPriceDate();
        $WSPath				= "../app/Http/Controllers/WS/" . $WSSettingsArray["script"] . ".php";

        if (file_exists($WSPath))
		{
			require_once $WSPath;
			// if ($ParamsArray["cache_mode"] && $WSSettingsArray["cache"] == 1 && ($ParamsArray["sid"] != "" || $ParamsArray["pkey"] != ""))
			// {
				// 	ProviderWebserviceTime::updateOrCreate(['sid' => $ParamsArray["sid"], 'wsid' => $WSSettingsArray["id"], 'pkey' => $ParamsArray["pkey"], 'time' => time()]);
			// }
			$IgnoredArticleMatch			= 0;
			$InvalidPrice					= 0;
			$MinAvailabilityCount			= 0;
			$MaxDaysCount					= 0;
			$NewCrossesCount				= 0;
			$DuplicateCrossesCount			= 0;
			
			if (0 < count($ProviderPricesArray))
			{
                $PricesArrayTemp				= $ProviderPricesArray;
                $ProviderPricesArray			= [];
				$IgnoredCrossArray				= [];
                $UniquePricesMD5Array			= [];
				$WPCnt							= 0;
				$Duplicated						= 0;
				
                foreach ($PricesArrayTemp as $PriceArray)
				{
					$WPCnt = $WPCnt + 1;					

					$PriceArray["pkey"]				= Functions::SingleKey($PriceArray["brand"], true) . Functions::SingleKey($PriceArray["article"]);
                    $PriceArray["brand"]			= Str::upper($PriceArray["brand"]);//uppercase for price
                    $PriceArray["bkey"]				= Functions::SingleKey($PriceArray["brand"], true);
					$PriceArray["article"]			= Str::upper($PriceArray["article"]);//uppercase for price
					$PriceArray["akey"]				= Functions::SingleKey($PriceArray["article"]);
					$PriceArray["day"]				= Functions::DayNumbers($PriceArray["day"]);
                    $PriceArray["available"]		= Functions::OnlyNumbers($PriceArray["available"]);
					
                    if ($PriceArray["link_to_bkey"] != "" && $PriceArray["link_to_akey"] == $PriceArray["akey"] && $PriceArray["link_to_bkey"] != $PriceArray["bkey"])
					{
                        $IgnoredArticleMatch = $IgnoredArticleMatch + 1;
                        continue;
                    }
					
                    if ($PriceArray["brand"] == "" || $PriceArray["article"] == "" || $PriceArray["link_to_akey"] == "")
					{
                        $InvalidPrice = $InvalidPrice + 1;
                        continue;
                    }
                    if (0 < $WSSettingsArray["min_availability"] && $PriceArray["available"] < $WSSettingsArray["min_availability"])
					{
                        $MinAvailabilityCount = $MinAvailabilityCount + 1;
                        continue;
                    }
                    if (0 < $WSSettingsArray["max_day"] && $WSSettingsArray["max_day"] < $PriceArray["day"])
					{
                        $MaxDaysCount = $MaxDaysCount + 1;
                        continue;
                    }
					
                    $provider_product_name_temp						= Functions::ClearName($PriceArray["provider_product_name"]);
                    $PriceArray["provider_product_name"]			= mb_strimwidth($provider_product_name_temp, 0, 100, "...");
                    $PriceArray["type"]								= $WSSettingsArray["price_type"];
                    $PriceArray["provider"]							= $WSSettingsArray["name"];
                    $PriceArray["provider_code"]					= $WSSettingsArray["provider_code"];
                    $PriceArray["date"]								= $PriceTime;
                    if ($WSSettingsArray["day_add"] != 0)
					{
						$PriceArray["day"]							= $PriceArray["day"] + $WSSettingsArray["day_add"];
					}
					
                    $PriceArray["src"] = $PriceArray["price"];
                    if ($WSSettingsArray["price_extra"] != 0)
					{
						$PriceArray["price"]					= (($WSSettingsArray["price_extra"] + 100) * $PriceArray["price"]) / 100;
						// $PriceArray["price"]					= ceil($PriceArray["price"]);
						// $PriceArray["price"]					= ceil($PriceArray["price"] / 50) * 50;
						$PriceArray["price"]					= Functions::priceRounding($PriceArray["price"]);
						
					}
					// dd(compact('PriceArray','price'));
                    if (0 < $WSSettingsArray["price_add"])
					{
						$PriceArray["price"]						= $PriceArray["price"] + $WSSettingsArray["price_add"];
					}
					// dd(compact('PriceArray'));/
                    $PartMD5 = md5($PriceArray["bkey"] . $PriceArray["akey"] . $PriceArray["price"] . $PriceArray["type"] . $PriceArray["currency"] . $PriceArray["day"] . $PriceArray["available"] . $PriceArray["provider"] . $PriceArray["stock"] . $PriceArray["options"]);
                    
					if (in_array($PartMD5, $UniquePricesMD5Array))
					{
						$Duplicated = $Duplicated + 1;
						continue;
					}
                    $UniquePricesMD5Array[] = $PartMD5;
                    unset($PriceArray["link_to_bkey"]);
                    unset($PriceArray["link_to_akey"]);
                    $ProviderPricesArray[] = $PriceArray;					
                }
				//

				if ($ParamsArray["cache_mode"] == true && $WSSettingsArray["cache"] == 1 && 0 < $WPCnt)
				{
					
					foreach ($WSPartsArray as $WSPartArray)
					{
                        $DRows = ProviderPrice::where(["bkey" => $WSPartArray["bkey"], "akey" => $WSPartArray["akey"], "provider_code" => $WSSettingsArray["provider_code"]])->delete();
                        $DARows = $DARows + $DRows;
                    }
					foreach ($ProviderPricesArray as $NewPriceArray)
					{
						// $NewPriceArray["uid"] = md5($NewPriceArray["bkey"] . $NewPriceArray["akey"] . $NewPriceArray["type"] . $NewPriceArray["day"] . $NewPriceArray["provider"] . $NewPriceArray["stock"]);//uid
						$NewPriceArray["uid"] = md5($NewPriceArray["bkey"] . $NewPriceArray["akey"] . $NewPriceArray["price"] . $NewPriceArray["type"] . $NewPriceArray["currency"] . $NewPriceArray["day"] . $NewPriceArray["available"] . $NewPriceArray["provider"] . $NewPriceArray["stock"] . $NewPriceArray["options"]);
						
						$priceCheck = ProviderPrice::where('uid', $NewPriceArray["uid"])->first();
						
						if($priceCheck)
						{
							ProviderPrice::where('uid', $NewPriceArray["uid"])->update($NewPriceArray);
						}
						else
						{
							ProviderPrice::insert($NewPriceArray);
						}
                        $AARows = $AARows + 1;
                    }
                }
				else
				{
					self::$OnlinePricesArray = array_merge(self::$OnlinePricesArray, $ProviderPricesArray);
                }

                $UniquePricesArray = [];
				$UPCntr = 0;
                foreach ($ProviderPricesArray as $arUPr)
				{
                    $Ukey = $arUPr["pkey"] . $arUPr["provider"] . $arUPr["stock"];
                    if (!in_array($Ukey, $UniquePricesArray))
					{
                        $UniquePricesArray[] = $Ukey;
                        $UPCntr = $UPCntr + 1;
                    }
                }
                if (0 < $UPCntr)
				{
					ProviderWebserviceCounter::where(['wsid' => $WSSettingsArray["id"], 'time_stamp' => day_stamp])->update(['available_counter' => $UPCntr]);
                }
            }
			
			// $deleted = 0;
			// foreach ($ProviderPricesArray as $MaxDaysItem)
			// {
			// 	$deleted = $deleted + 1;
			// 	$deleted_parts = ProviderPrice::where("pkey", '=', $MaxDaysItem["pkey"])->where("provider_code", '=', $MaxDaysItem["provider_code"])->where('date', '>', Carbon::now()->subDays(5))->get();
			// }
			// dd($deleted_parts);

            if ($ParamsArray["cache_mode"] && $WSSettingsArray["cache"] == 1)
			{
                if (0 < $MinAvailabilityCount)
				{
                    $MinAvaMes = "; Ignored with min. available (" . $WSSettingsArray["min_availability"] . ") - <b>" . $MinAvailabilityCount . "</b> ";
                }
                if (0 < $MaxDaysCount)
				{
                    $MaxDayMes = "; Ignored with max. delivery time (" . $WSSettingsArray["max_day"] . ") - <b>" . $MaxDaysCount . "</b> ";
                }
            }
        }
    }

	///////////////////////////////////////////////////////
	static function WSRunScript($ScriptQuery, $Values)
	{
		$URL = TDM_HTTPS . "://" . $_SERVER["SERVER_NAME"] . "/" . TDM_ROOT_DIR . "/tdmcore/" . $ScriptQuery;
		$parts = parse_url($URL);
		if (!defined("FSOCK_PORT"))
		{
			define("FSOCK_PORT", 80);
		}
		if (!($fp = fsockopen($parts["host"], isset($parts["port"]) ? $parts["port"] : FSOCK_PORT)))
		{
			return false;
		}
		fwrite($fp, "POST " . (!empty($parts["path"]) ? $parts["path"] : "/") . "?" . $parts["query"] . " HTTP/1.1\r\n");
		fwrite($fp, "Host: " . $parts["host"] . "\r\n");
		fwrite($fp, "Content-Type: application/x-www-form-urlencoded\r\n");
		fwrite($fp, "Content-Length: " . strlen($Values) . "\r\n");
		fwrite($fp, "Connection: Close\r\n\r\n");
		fwrite($fp, $Values);
		fclose($fp);
		return true;
	}
}

//crosses get to base
// if ($WSSettingsArray["links_take"] == 1)
// {
//     if ($PriceArray["link_to_bkey"] != "" && $PriceArray["link_to_akey"] != "" && $PriceArray["bkey"] != "" && $PriceArray["akey"] != "")
// 	{
//         $CrossBKEY				= Functions::SingleKey($PriceArray["link_to_bkey"], true);
//         $CrossAKEY				= Functions::SingleKey($PriceArray["link_to_akey"]);
// 		if ($CrossBKEY . $CrossAKEY != $PriceArray["bkey"] . $PriceArray["akey"])
// 		{
//             if (!array_key_exists($PriceArray["bkey"] . $PriceArray["akey"], $WSPartsArray))
// 			{
// 				ProductCross::updateOrInsert(['pkey1' => $CrossBKEY . $CrossAKEY, 'pkey2' => $PriceArray["bkey"] . $PriceArray["akey"]],
// 						['bkey1' => $CrossBKEY,'akey1' => $CrossAKEY,
// 						'bkey2' => $PriceArray["bkey"],'akey2' => $PriceArray["akey"],
// 						'side' => intval($WSSettingsArray["links_side"]), 'code' => $WSSettingsArray["provider_code"]]);
//                 $NewCrossesCount = $NewCrossesCount + 1;
//                 if ($WSSettingsArray["links_side"] == 1)
// 				{
//                     $SLable = "&#8594;";
//                 }
// 				else
// 				{
//                     if ($WSSettingsArray["links_side"] == 2)
// 					{
//                         $SLable = "&#8592;";
//                     }
// 					else
// 					{
//                         $SLable = "&#8596;";
//                     }
//                 }
//                 $NewCrossesArray[$PriceArray["bkey"] . $PriceArray["akey"]] = [
// 						"pkey" => $PriceArray["bkey"] . $PriceArray["akey"],
// 						"bkey" => $PriceArray["bkey"],
// 						"akey" => $PriceArray["akey"],
// 						"brand" => $PriceArray["brand"],
// 						"article" => $PriceArray["article"],
// 						"link_side" => $WSSettingsArray["links_side"],
// 						"link_code" => $WSSettingsArray["provider_code"],
// 						"link_info" => "<b>" . $PriceArray["bkey"] . "</b> " . $PriceArray["akey"] . " " . $SLable . " <b>" . $CrossBKEY . "</b> " . $CrossAKEY,
// 						"img_src" => "/media/images/no_image.webp"];
// 			}
//         }
// 		else
// 		{
//             $DuplicateCrossesCount = $DuplicateCrossesCount + 1;
//         }
//     }
// 	else
// 	{
// 		$CountIgnoredCross = 0;
//         if ($PriceArray["link_to_bkey"] != "")
// 		{
//             continue;
//         }
//     }
// }
// else
// {						
//     if ($WSSettingsArray["get_direct_art_search"] != 0 && ($PriceArray["link_to_akey"] != $PriceArray["akey"] || $PriceArray["link_to_bkey"] != $PriceArray["bkey"]) && $PriceArray["link_to_bkey"] != "")
// 	{
//         continue;
//     }
// }