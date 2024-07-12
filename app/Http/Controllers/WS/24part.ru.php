<?php
/*
Documentation:
http://docs.abcp.ru/wiki/API:Docs 

Result array sample: 
Array
(
    [0] => stdClass Object
        (
            [distributorId] => 307154
            [grp] => 
            [code] => 
            [nonliquid] => 
            [brand] => Febi
            [number] => 02374
            [numberFix] => 02374
            [description] => Антифриз желтый-зелёный G11 1,5л FEBI концентрат упак12шт.
            [availability] => 50
            [packing] => 1
            [deliveryPeriod] => 24
            [deliveryPeriodMax] => 
            [distributorCode] => 
            [providerCode] => 29835
            [providerColor] => E0FDFF
            [providerDescription] => 
            [itemKey] => qvajQs2Z/tP+TKYf6hA4lOVSwWrEIBD9lTDnJGg0u6nHQlv21EOvhWCiWwZsIkYLS+m/N2og6f5CL8+ZN2+cccZvWIK1BrXrx1lpEFMwpgSll9Gh9ThPIOA9EE5JRKYi8ibZXbJ5QrIz7Fyk45SwTTjsaTzZ7KHK2ntRSw91NmnxQmlBy01VPD89XnIJmVAfMo5FD71u/ZHMpGTOEnXdA0zSLM4Pa2pYB7FYh6O+xDE07anudu7A2BhPzmq/Br87b9LoTHRd3dISglXS697jZ7qAUF5RUjW8oEQwLvgZ/ky/V/oqg/H/ewvyS6KRAxr0NxAtKQFVr3DxDofgZweCkTNteQljcE5P4613ccq4roXek3Ncx8p+OJu/+88vEL/dtQ==
            [price] => 288.51
            [weight] => 1.780
            [volume] => 
            [groupId] => 0
            [deliveryProbability] => 0
            [lastUpdateTime] => 2014-10-24 10:34:47
            [additionalPrice] => 0
            [noreturn] => 0
            [isSetInOnlineWh] => 1
            [isSetInNonOnlineWh] => 
            [fromPublicApi] => 1
        )

Result Error sample:
stdClass Object
(
    [errorCode] => 102
    [errorMessage] => Неправильное имя или пароль!
)
*/

//echo '<pre>'; print_r($arWsParts); echo '</pre>'; 
//echo '<pre>'; print_r($arWS); echo '</pre>';

$useOnlineStocks=1;  //Флаг "использовать online-склады". Может принимать значения 0 или 1 (не использовать и использовать соответственно; по умолчанию - 0). Если выключено, то в выдачу не будут попадать детали с online-складов, что позволит увеличить скорость ответа.

$password = md5($arWS['password']);
foreach($arWsParts as $PartArray){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,"http://24part.ru.public.api.abcp.ru/search/articles/?userlogin=".$arWS['login']."&userpsw=".$password."&number=".urlencode($PartArray['article'])."&brand=".urlencode($PartArray['brand'])."&useOnlineStocks=".$useOnlineStocks);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$json = curl_exec($ch);
	curl_close($ch);
	$jsonRes = json_decode($json);
	//echo '<br><pre>'; print_r($json); echo '</pre><br><br>';
	if(is_array($jsonRes)){
		foreach($jsonRes as $obRes){
			//Make valid price array
			$PriceArray = TDMPriceArray($PartArray); 
			//Webservice data
			$PriceArray["article"] = (string)$obRes->number;
			$PriceArray["provider_product_name"] = (string)$obRes->description;
			$PriceArray["brand"] = (string)$obRes->brand;
			$PriceArray["price"] = (string)$obRes->price;
			$PriceArray["currency"] = $arWS['currency'];
			$PriceArray["day"] = (string)$obRes->deliveryPeriod; //Срок поставки (в часах).
			$PriceArray["day"] = intval($PriceArray["day"]/24);
			$PriceArray["available"] = (string)$obRes->availability;
			if($PriceArray["available"]=='-1'){$PriceArray["available"]='1+';}
			if($PriceArray["available"]=='-2'){$PriceArray["available"]='10+';}
			if($PriceArray["available"]=='-3'){$PriceArray["available"]='99+';}
			if($PriceArray["available"]=='-10'){$PriceArray["available"]=0;} //"под заказ"
			$PriceArray["stock"] = (string)$obRes->supplierCode;
			$PriceArray["options"] = '';
			//price options
			$arOps = Array();
			$minimum = (string)$obRes->packing;
			if($minimum>1){$arOps['minimum']=$minimum;}
			$weight = (string)$obRes->weight; //Вес одной единицы товара в килограммах
			if($weight>0){$arOps['weight']=$weight;}
			$liters = (string)$obRes->volume; //Объем одной единицы товара
			if($liters>0){$arOps['liters']=$liters;}
			$percentgive = (string)$obRes->deliveryProbability; //Вероятность поставки товара поставщика
			if($percentgive>0){$arOps['percentgive']=$percentgive;}
			$noreturn = (string)$obRes->noreturn; //Флаг "Без возврата"
			if($noreturn>0){$arOps['noreturn']=$noreturn;}
			$PriceArray["options"] = TDMOptionsImplode($arOps,$PriceArray);
			//Add new record
			$ProviderPricesArray[] = $PriceArray;
		}
	}elseif(is_object($jsonRes)){
		if($jsonRes->errorCode>0){
			if($jsonRes->errorCode==301){continue;} //No results
			$ERROR = $jsonRes->errorMessage.' ['.$jsonRes->errorCode.']';
			break;
		}
	}
	
}

?>
