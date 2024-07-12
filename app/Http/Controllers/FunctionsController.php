<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use Illuminate\Support\Str;

use Illuminate\Http\Request;

use App\Models\Shop\SectionSeo;

use App\Models\Brand\BrandRename;

class FunctionsController extends Controller
{
	static function SingleKey($value, $Renames = false)
	{
		$value = Str::upper(trim($value));
		$value = str_replace("Ї", "I", $value);
		$value = str_replace("Ë", "E", $value);
		$value = str_replace("Ö", "O", $value);
		$value = str_replace("Ò", "O", $value);
		$value = str_replace("Ä", "A", $value);
		$value = str_replace("Ã", "A", $value);
		$value = str_replace("Ü", "U", $value);
		$value = str_replace("O'", "O", $value);
		$value = str_replace("№", "", $value);
		$value = preg_replace("/[^A-ZА-ЯІЇЄҐ0-9a-zа-яіїєґ]/u", "", $value);
		
		if ($Renames = true)
		{
			$value_to_rename = BrandRename::where('rename_from_bkey','=',$value)->first();
			if($value_to_rename)
			{
				$value = $value_to_rename->rename_to_bkey;

			}
		}
		return trim($value);
	}

	public static function priceRounding($price, $rate = 5)
	{
		if($rate)
		{
			$roundingRate = $rate;
		}
		else
		{
			$roundingRate = 5;

			if($price > 100)
			{
				$roundingRate = 5;
			}
			if($price > 1000)
			{
				$roundingRate = 50;
			}
			if($price > 10000)
			{
				$roundingRate = 100;
			}
			if($price > 20000)
			{
				$roundingRate = 500;
			}
			if($price > 50000)
			{
				$roundingRate = 1000;
			}
		}
		$roundedPrice = ceil($price);
		$price = ceil($roundedPrice / $roundingRate) * $roundingRate;
		return $price;
	}

	static function GenerateTimestamp($timeStamp = 0)
	{
		if ($timeStamp == 0)
		{
			$timeStamp = time();
		}
		$timeStamp = mktime(0, 0, 0, date("n", $timeStamp), date("j", $timeStamp), date("Y", $timeStamp));
		return $timeStamp;
	}
	
	static function SetPriceDate()
	{
		$date = Carbon::today();	
		return $date;
	}
	
	//очистка названия запчасти от служебных символов
	//устранияет ошибку при декодировании json данных для корзины
	static function ClearName($value)
	{
		$value = (string)$value;
		$value = str_replace("\\", "", $value);
		$value = str_replace("/", "", $value);
		$value = str_replace("_", "", $value);
		$value = str_replace("+", "", $value);
		$value = str_replace("!", "", $value);
		$value = str_replace("\"", "", $value);
		$value = str_replace("'", "", $value);
		return $value;
	}
	
	static function FormatPrice($PriceArray)
	{
		//system_currency///////////////////////////////
		$currency_config = currency()->config();
		$system_currency = $currency_config['default'];
		$system_currency_find = currency()->find($system_currency);
		$system_currency_rate = $system_currency_find->exchange_rate;
		//system_currency///////////////////////////////
		
		//user_currency///////////////////////////////
		$user_currency = currency()->getUserCurrency();
		$user_currency_find = currency()->find($user_currency);
		$user_currency_rate = $user_currency_find->exchange_rate;
		//user_currency///////////////////////////////
		
		//price_currency///////////////////////////////		
		$price_currency_find = currency()->find($PriceArray["currency"]);
		$price_currency_rate = $price_currency_find->exchange_rate;
		//price_currency///////////////////////////////
		
		if (0 < $PriceArray["price"])
		{
			if ($PriceArray["currency"] == "")
			{
				$PriceArray["currency"] = $system_currency;
			}
			if ($PriceArray["currency"] != $user_currency)
			{
				if (0 < $system_currency_rate && 0 < $price_currency_rate)
				{
					$PriceArray["price_converted"] = currency($PriceArray["price"], $PriceArray["currency"], $user_currency, false);
					$PriceArray["currency_converted"] = $user_currency;
				}
				else
				{
					$PriceArray["price_converted"] = $PriceArray["price"];
					$PriceArray["currency_converted"] = $PriceArray["currency"];
				}
			}
			else
			{
				$PriceArray["price_converted"] = $PriceArray["price"];
				$PriceArray["currency_converted"] = $PriceArray["currency"];
			}
			//customer logged in
			//Если пользователь зашел в систему
			//получаем данные по скидке
			/////////////////////////(1-%/100)
			$client_product_discount = session()->get('client_product_discount');
				
			$PriceArray["discount"] = $PrDisc = intval($client_product_discount) ?? intval(0);
			
			if ($PriceArray["discount"] < 0)
			{
				$PriceArray["discount"] = abs($PriceArray["discount"]);
			}
			$PriceArray["discount_price"] = $PriceArray["price_converted"];
			$PriceArray["price_converted"] = $PriceArray["price_converted"] * (1 - $PrDisc/100);
			$PriceArray["discount_price"] = round($PriceArray["discount_price"] - $PriceArray["price_converted"], 2);
			
			$PriceArray["price_formated"] = number_format($PriceArray["price_converted"], 2, ",", " ");
			$PriceArray["price_formated"] = str_replace(",00", "", $PriceArray["price_formated"]);
			
			$PriceArray["provider_product_name"] = FunctionsController::ClearName($PriceArray["provider_product_name"]);
			$PriceArray["options"] = FunctionsController::FormatOptions($PriceArray["options"]);
			$PriceArray["available_num"] = intval($PriceArray["available"]);
			
			if (strpos($PriceArray["options"]["available_template"], "#") !== false)
			{
				$PriceArray["available"] = str_replace("#", $PriceArray["available"], $PriceArray["options"]["available_template"]);
			}
			else
			{
				if ($PriceArray["options"]["available_template"] != "" && $PriceArray["available"] == 0)
				{
					$PriceArray["available"] = $PriceArray["options"]["available_template"];
				}
			}
			
			if (strpos($PriceArray["options"]["day_template"], "#") !== false)
			{
				$PriceArray->day = str_replace("#", $PriceArray["day"], $PriceArray["options"]["day_template"]);
			}
			else
			{
				if ($PriceArray["options"]["day_template"] != "" && $PriceArray["day"] == 0)
				{
					$PriceArray["day"] = $PriceArray["options"]["day_template"];
				}
			}
		}
		if (!is_array($PriceArray["options"]))
		{
			$PriceArray["options"] = FunctionsController::GetPriceOptions(";;;;;;;;;;;;;;;;;;;;;;;;;;;");
		}
		
		if (!isset($PriceArray["options"]["view_intab"]))
		{
			$PriceArray["options"]["view_intab"] = "";
		}
		return $PriceArray;
	}
		
	static function OptionsImplode($arOps, $PriceArray = [])
	{
		//набор
		if(isset($arOps["set"]))
		{
			$set = intval($arOps["set"]);
		}
		else
		{
			$set = intval(0);
		}
		//вес
		if(isset($arOps["weight"]))
		{
			$weight = intval($arOps["weight"]);
		}
		else
		{
			$weight = intval(0);
		}
		//использовалось(б/у)
		if(isset($arOps["used"]))
		{
			$used = intval($arOps["used"]);
		}
		else
		{
			$used = intval(0);
		}
		//восстановленный
		if(isset($arOps["restored"]))
		{
			$restored = intval($arOps["restored"]);
		}
		else
		{
			$restored = intval(0);
		}
		//поврежденный
		if(isset($arOps["damaged"]))
		{
			$damaged = intval($arOps["damaged"]);
		}
		else
		{
			$damaged = intval(0);
		}
		//возврату не подлежит
		if(isset($arOps["noreturn"]))
		{
			$noreturn = intval($arOps["noreturn"]);
		}
		else
		{
			$noreturn = intval(0);
		}
		//реплика
		if(isset($arOps["copy"]))
		{
			$copy = intval($arOps["copy"]);
		}
		else
		{
			$copy = intval(0);
		}
		//распродажа
		if(isset($arOps["hot"]))
		{
			$hot = intval($arOps["hot"]);
		}
		else
		{
			$hot = intval(0);
		}
		//срок поставки
		if(isset($arOps["day"]))
		{
			$OptionDay = FunctionsController::OptionNumbers($PriceArray["day"]);
		}
		else
		{
			$OptionDay = intval(0);
		}
		//наличие
		if(isset($arOps["available"]))
		{
			$OptionAvail = FunctionsController::OptionNumbers($PriceArray["available"]);
		}
		else
		{
			$OptionAvail = intval(0);
		}
		if(isset($arOps["price_id"]))
		{
			$price_id = intval($arOps["price_id"]);
		}
		else
		{
			$price_id = intval(0);
		}
		//вероятность поставки в процентах
		if(isset($arOps["percentgive"]))
		{
			$percentgive = intval($arOps["percentgive"]);
		}
		else
		{
			$percentgive = intval(0);
		}
		//минимальное количество к заказу
		if(isset($arOps["minimum"]))
		{
			$minimum = intval($arOps["minimum"]);
		}
		else
		{
			$minimum = intval(0);
		}
		//объем
		if(isset($arOps["liters"]))
		{
			$liters = floatval(str_replace(",", ".", $arOps["liters"]));
		}
		else
		{
			$liters = intval(0);
		}
		//адрес изображения - если отдает сервер поставщика
		if(isset($arOps["img_src"]))
		{
			$img_src = trim($arOps["img_src"]);
		}
		else
		{
			$img_src = "";
		}
		
		$Res = $set . ";" . $weight . ";" . $used . ";" . $restored . ";" . $damaged . ";" . $noreturn . ";" . $copy . ";" . $hot . ";" . $OptionDay . ";" . $OptionAvail . ";" . $price_id . ";" . $percentgive . ";" . $minimum . ";" . $liters . ";" . $img_src;
		return $Res;
	}
	
	static function OnlyNumbers($value)
	{
		$value = preg_replace("/[^0-9]/", "", $value);
		return intval($value);
	}
	
	static function GetPriceOptions($options)
	{
		$OptionsArray = explode(";", $options);
		list($ResultArray["set"],
			$ResultArray["weight"],
			$ResultArray["used"],
			$ResultArray["restored"],
			$ResultArray["damaged"],
			$ResultArray["noreturn"],
			$ResultArray["copy"],
			$ResultArray["hot"],
			$ResultArray["day_template"],
			$ResultArray["available_template"],
			$ResultArray["price_id"],
			$ResultArray["percentgive"],
			$ResultArray["minimum"],
			$ResultArray["liters"],
			$ResultArray["img_src"]) = $OptionsArray;
		return $ResultArray;
	}
	
	static function FormatOptions($options)
	{
		$arOpts = FunctionsController::GetPriceOptions($options);
		return $arOpts;
	}
	
	static function GetURLBrandCode($Manufacturer)
	{
		return substr(trim($Manufacturer), 0, 32);
	}
	
	static function GetURLmanufacturer($Manufacturer)
	{
		$BrandsArray["tcode"] = FunctionsController::GetURLBrandCode($Manufacturer);
		if ($BrandsArray["tcode"] == "renault-trucks")
		{
			$BrandsArray["trucks"] = 2;
			$BrandsArray["code"] = "renault trucks";
		}
		else
		{
			if (0 < strpos($BrandsArray["tcode"], "trucks"))
			{
				$BrandsArray["code"] = str_replace("-trucks", "", $BrandsArray["tcode"]);
				$BrandsArray["trucks"] = 2;
			}
			else
			{
				$BrandsArray["code"] = $BrandsArray["tcode"];
				$BrandsArray["trucks"] = 1;
			}
		}
		$arDashed = array("rolls-royce", "mercedes-benz");
		if (!in_array($BrandsArray["code"], $arDashed))
		{
			$BrandsArray["name"] = str_replace("-", " ", $BrandsArray["code"]);
		}
		else
		{
			$BrandsArray["name"] = $BrandsArray["code"];
		}
		$BrandsArray["uname"] = Str::upper($BrandsArray["name"]);
		return $BrandsArray;
	}
	
		//форматирование строки uri
	static function StringForURL($String, $UEncode = true)
	{
		if (trim($String) == "")
		{
			return false;
		}
		$arDr = [" / ", "/ - ", "/- ", "/ ", "-/", " /-", "/ -", "/-", "-/ ", " / -", "/- ", "/", "--", "_ , ", "_ ,", "_ ", " , ", ", ", " - ", "-&-", " "];
		foreach ($arDr as $Dm)
		{
			$String = str_replace($Dm, "-", $String);
		}
		$String = str_replace("`", "", $String);
		$String = str_replace("´", "", $String);
		$String = str_replace("  ", " ", $String);
		$String = str_replace("__", "-", $String);
		$String = str_replace("_,", "-", $String);
		$String = str_replace(",", "", $String);
		$String = str_replace(", ", "-", $String);
		$String = str_replace("-_)", "", $String);
		$String = str_replace("_)", "", $String);
		$String = str_replace("-)", "", $String);
		$String = str_replace("(", "", $String);
		$String = str_replace(")", "", $String);
		$String = str_replace("ë", "e", $String);
		$String = str_replace("é", "e", $String);
		$String = str_replace("É", "E", $String);
		$String = str_replace("'", "", $String);
		$String = str_replace("-_-", "-", $String);
		$String = str_replace("_-", "-", $String);
		$String = str_replace("-_", "-", $String);
		$String = Str::lower($String);
		$String = str_replace("iii", "III", $String);
		$String = str_replace("-ii", "-II", $String);
		$String = str_replace("-i-", "-I-", $String);
		$String = str_replace("-iv-", "-IV-", $String);
		$String = str_replace("-v-", "-V-", $String);
		$String = str_replace("-vi-", "-VI-", $String);
		$String = str_replace("-vii-", "-VII-", $String);
		$String = str_replace("-viii-", "-VIII-", $String);
		$String = str_replace("_", "", $String);
		return $String;
	}
	/*генерация адреса в пошаговом поиске запчасти по модели
	"group" => "passenger"
	"brand" => "hyundai"
	"model_name" => "accent-I-x-3"
	"model_filtered_url" => "accent-I-x-3"
	"model_id" => 1294
	"URL" => "/catalog/passenger/hyundai/accent-I-x-3/" */
	static function GenerateURL($ParametersArray)
	{
		$URL = "/catalog/";
		$arLast = [];
		if (array_key_exists("group",$ParametersArray))
		{
			$URL .= Str::lower($ParametersArray["group"]) . "/";
		}
		if (array_key_exists("brand",$ParametersArray))
		{
			$URL .= Str::lower($ParametersArray["brand"]) . "/";
		}
		if (array_key_exists("model_name",$ParametersArray))
		{
			$URL .= FunctionsController::StringForURL($ParametersArray["model_name"]) . "/";
		}
		if (isset($ParametersArray["modification_id"]))
		{
			$URL .= FunctionsController::StringForURL($ParametersArray["modification_id"]);
			if (array_key_exists("modification_name",$ParametersArray))
			{
				$arType = explode(" ", $ParametersArray["modification_name"]);
				$Type = $arType[0];
				$Type = FunctionsController::Transliteration($Type);
			}
			else
			{
				$Type = $ParametersArray["engine"];
			}
			$URL .= "-" . $ParametersArray["engine"] . "/";
		}
		if (isset($ParametersArray["sec_code"]) && $ParametersArray["sec_code"] != "")
		{
			$URL .= $ParametersArray["sec_code"] . "/";
		}
		
		return $URL;
	}
	
	static function PriceArray($PartArray = [])
	{
		$array = [
				"bkey" => "",
				"akey" => "",
				"article" => "",
				"provider_product_name" => "",
				"brand" => "",
				"price" => 0,
				"type" => 1,
				"currency" => "",
				"day" => "",
				"available" => "",
				"provider" => "",
				"stock" => "",
				"options" => "",
				"provider_code" => "",
				"date" => Carbon::today()
				];
		if (isset($PartArray["WS_BRAND"]) && $PartArray["WS_BRAND"] != "")
		{
			$array["link_to_bkey"] = FunctionsController::SingleKey($PartArray["WS_BRAND"], true);
		}
		if (isset($PartArray["WS_ARTICLE"]) && $PartArray["WS_ARTICLE"] != "")
		{
			$array["link_to_akey"] = FunctionsController::SingleKey($PartArray["WS_ARTICLE"]);
		}
		if (isset($PartArray["bkey"]) && $PartArray["bkey"] != "")
		{
			$array["link_to_bkey"] = FunctionsController::SingleKey($PartArray["bkey"], true);
		}
		if (isset($PartArray["akey"]) && $PartArray["akey"] != "")
		{
			$array["link_to_akey"] = FunctionsController::SingleKey($PartArray["akey"]);
		}
		return $array;
	}

	static function DayNumbers($value)
	{
		$value = (string)$value;
		if (0 < strpos($value, "-"))
		{
			$value = substr($value, 0, strpos($value, "-"));
		}
		$value = preg_replace("/[^0-9]/", "", $value);
		return intval($value);
	}
	
	static function GetProductURL($brand = "", $article = "")
	{
		$ProductURL = "/catalog/product";
		if ($brand != "" && $article != "")
		{
			$brand = FunctionsController::BrandNameEncode($brand);
			$article = FunctionsController::BrandNameEncode($article);
			$LINK = str_replace("article", $article, "/brand/article");
			$LINK = str_replace("brand", $brand, $LINK);
			$LINK = Str::lower($LINK);
			$ProductURL .= $LINK;
		}
		return $ProductURL;
	}
	
	static function GetSearchURL($brand = "", $article = "")
	{
		$ProductURL = "/catalog/search";
		if ($brand != "" && $article != "")
		{
			$brand = FunctionsController::BrandNameEncode($brand);
			$article = FunctionsController::BrandNameEncode($article);
			$LINK = str_replace("article", $article, "/brand/article");
			$LINK = str_replace("brand", $brand, $LINK);
			$LINK = Str::lower($LINK);
			$ProductURL .= $LINK;
		}
		return $ProductURL;
	}
	
	static function BrandNameEncode($Bname)
	{
		$Bname = str_replace("-", "_", $Bname);
		// $Bname = str_replace("-", "--", $Bname);
		$Bname = str_replace("'", "-a-", $Bname);
		$Bname = str_replace(" & ", "-and-", $Bname);
		$Bname = str_replace("&", "and", $Bname);
		$Bname = str_replace(" + ", "-cplus-", $Bname);
		$Bname = str_replace("+", "-plus-", $Bname);
		$Bname = str_replace(" ", "-", $Bname);
		$Bname = str_replace("/", "-or-", $Bname);
		if ($Bname == "MERCEDESBENZ")
		{
			$Bname = "MERCEDES-BENZ";
		}
		if ($Bname == "MERCEDES_BENZ")
		{
			$Bname = "MERCEDES-BENZ";
		}
		return $Bname;
	}
	
	static function Transliteration($s)
	{
		$s = preg_replace("/\\s+/", " ", $s);
		$s = str_replace(["\n", "\r"], " ", $s);
		$s = trim($s);
		$s = function_exists("mb_strtolower") ? mb_strtolower($s) : strtolower($s);
		return strtr($s, ["а" => "a", "б" => "b", "в" => "v", "г" => "g", "д" => "d", "е" => "e", "ё" => "e", "ж" => "j", "з" => "z", "и" => "i", "й" => "y", "к" => "k", "л" => "l", "м" => "m", "н" => "n", "о" => "o", "п" => "p", "р" => "r", "с" => "s", "т" => "t", "у" => "u", "ф" => "f", "х" => "h", "ц" => "c", "ч" => "ch", "ш" => "sh", "щ" => "shch", "ы" => "y", "э" => "e", "ю" => "yu", "я" => "ya", "ъ" => "", "ь" => ""]);
	}
	
	//получить ИД модели из предопределенного списка по производителю/модели
	static function GetModelIDByURLName($brand, $model_id)
	{
		if ($brand == "" || $model_id == "")
		{
			return false;
		}
        require "../app/Http/Controllers/Components/modelurl.php";

        if (!isset($ModelFormatedURLArray[$brand][$model_id]))
		{
            return false;
        }
        return $ModelFormatedURLArray[$brand][$model_id];
	}
	
	//получить название модели в URI из ИД
	static function GetURLNameByModelID($brand, $model_id)
	{
		if ($brand == "" || $model_id <= 0)
		{
			return false;
		}
		require "../app/Http/Controllers/Components/modelurl.php";
		$brand = Str::lower($brand);
		if (!isset($ModelFormatedURLArray[$brand]))
		{
			return false;
		}
		$FURL = array_search($model_id, $ModelFormatedURLArray[$brand]);
		return $FURL;
	}
	//product - battery section start
	static function BatteryParamsImplode($ParamsArray)
	{
		// "voltage" => "6V"
		$voltage = intval($ParamsArray["voltage"]) ?? intval(0);
		// "capacity" => "56"
		$capacity = intval($ParamsArray["capacity"]) ?? intval(0);
		// "starting_current" => "480"
		$starting_current = intval($ParamsArray["starting_current"]) ?? intval(0);
		// "polarity" => "0"
		$polarity = intval($ParamsArray["polarity"]) ?? intval(0);
		// "type" => "0 - acid"
		$type = intval($ParamsArray["type"]) ?? intval(0);
		// "width" => "242"
		$width = intval($ParamsArray["width"]) ?? intval(0);
		// "height" => "190"
		$height = intval($ParamsArray["height"]) ?? intval(0);
		// "length" => "175"
		$length = intval($ParamsArray["length"]) ?? intval(0);
		$Result = $voltage . ";" . $capacity . ";" . $starting_current . ";" . $polarity . ";" . $type . ";" . $width . ";" . $height . ";" . $length;
		return $Result;
	}
	
	static function GetBatteryParams($params)
	{
		$ParamsArray = explode(";", $params);
		list($ResultArray["voltage"],
			$ResultArray["capacity"],
			$ResultArray["starting_current"],
			$ResultArray["polarity"],
			$ResultArray["type"],
			$ResultArray["width"],
			$ResultArray["height"],
			$ResultArray["length"]) = $ParamsArray;
		return $ResultArray;
	}
	//product - battery section finish
	static function GetSectionDescription($id)
	{
		if ($id != "")
		{
			$SectionSeo = SectionSeo::where('sec_id', $id)->get();
			if($SectionSeo)
			{
				$SectionSeo = $SectionSeo->toArray();
			}
		}
		else
		{
			$SectionSeo = null;
		}
		return $SectionSeo;
	}
}
