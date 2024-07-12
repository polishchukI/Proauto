<?php

use App\Http\Controllers\FunctionsController as Functions;

function FindAddPics($bkey, $akey)
{
	$arMans = array("AUDI", "CHERY", "CHEVROLET", "BMW", "CITROEN", "FIAT", "FORD", "HONDA", "HYUNDAI", "KIA", "MAZDA", "MERCEDESBENZ", "MITSUBISHI", "NISSAN", "OPEL", "PEUGEOT", "RENAULT", "SEAT", "SKODA", "SUBARU", "SUZUKI", "TOYOTA", "VOLVO", "VW");
	$ArtMedia = "";
	if (in_array($bkey, $arMans))
	{
		$curl = curl_init("https://avto.pro/system/search/suggest-query/.aspx?query=" . $akey . "&seqId=0");
		curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POST, false);
		$headers = [];
		$headers[] = "X-Requested-With: XMLHttpRequest";
		$headers[] = "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:76.0) Gecko/20100101 Firefox/76.0";
		$headers[] = "Content-type: application/x-www-form-urlencoded";
		$headers[] = "Accept: */*";
		$headers[] = "Referer: https://avto.pro/";
		$headers[] = "Accept-Encoding: deflate, sdch, br";
		$headers[] = "Accept-Language: ru-RU,ru;q=0.8,en-US;q=0.6,en;q=0.4,uk;q=0.2";
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		$Res = curl_exec($curl);
		curl_close($curl);
		$arRes = json_decode($Res, true);
		if (is_array($arRes["Suggestions"]))
		{
			foreach ($arRes["Suggestions"] as $arSug)
			{
				if (isset($arSug["Uri"]) && $arSug["Uri"] != "")
				{
					list(, $rArticle, $rBrand, $rKey) = explode("-", $arSug["Uri"]);
					$rBKEY = Functions::SingleKey($rBrand, true);
					if ($rBKEY == "VAG" && in_array($bkey, array("VW", "AUDI", "SEAT")))
					{
						$rBKEY = $bkey;
					}
					if ($rBKEY == $bkey && $rKey != "")
					{
						$ADDRESS = "https://avto.pro" . $arSug["Uri"];
						$curl = curl_init($ADDRESS);
						curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
						curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
						curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
						curl_setopt($curl, CURLOPT_POST, false);
						$headers = [];
						$headers[] = "GET " . $arSug["Uri"] . " HTTP/1.1";
						$headers[] = "Host: avto.pro";
						$headers[] = "Connection: keep-alive";
						$headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8";
						$headers[] = "Accept-Encoding: deflate, sdch, br";
						$headers[] = "Accept-Language: ru-RU,ru;q=0.8,en-US;q=0.6,en;q=0.4,uk;q=0.2";
						$headers[] = "Content-Type: application/x-www-form-urlencoded; charset=UTF-8";
						$headers[] = "Origin: https://avto.pro";
						$headers[] = "Referer: " . $ADDRESS;
						$headers[] = "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:76.0) Gecko/20100101 Firefox/76.0";
						$headers[] = "Upgrade-Insecure-Requests: 1";
						curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
						$Res = curl_exec($curl);
						
						curl_close($curl);
						if ($Res != "" && 0 < strpos($Res, "js-code-picture"))
						{
							list($Res) = explode("js-code-picture", $Res);
							list(, $Res) = explode("data-href=\"", $Res);
							list($Res) = explode("\"", $Res);
						}
						
						$arExt = explode(".", $Res);
						$Ext = array_pop($arExt);
						if ($Ext == "jpeg")
						{
							$Ext = "jpg";
						}

						if (substr($Res, 0, 2) == "//" && $Ext != "")
						{
							$ch = curl_init();
							curl_setopt($ch, CURLOPT_URL, "http:" . $Res);
							curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
							$ImRes = curl_exec($ch);
							
							curl_close($ch);
							if ($ImRes)
							{
								$ArtDir = $_SERVER["DOCUMENT_ROOT"] . "/uploads/artmedia/" . $bkey . "/";
								if (!file_exists($ArtDir) && !mkdir($ArtDir, 511, true))
								{
									return $ArtMedia;
								}
								$ArtMedia = $_SERVER["DOCUMENT_ROOT"] . "/uploads/artmedia/" . $bkey . "/" . $akey . "." . $Ext;
                                file_put_contents($_SERVER["DOCUMENT_ROOT"] . $ArtMedia, $ImRes);
                            }
                        }
                        return $ArtMedia;
                    }
                }
            }
        }
    }
    return $ArtMedia;
}

?>