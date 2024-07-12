<?php
/*
Documentation:
http://wsdoc.emex.ru/

Result array sample: 
Array(
    [0] => stdClass Object(
        [GroupId] => -885
        [PriceGroup] => ReplacementNonOriginal
        [MakeLogo] => TE
        [MakeName] => TRW
        [DetailNum] => GDB976
        [DetailNameRus] => Комплект тормозных колодок, дисковый тормоз
        [PriceLogo] => MSNS
        [DestinationLogo] => AFL
        [PriceCountry] => Москва
        [LotQuantity] => 1
        [Quantity] => 1
        [DDPercent] => 96.0
        [ADDays] => 2
        [DeliverTimeGuaranteed] => 5
        [ResultPrice] => 1657.9500
    )
	...
*/
 
//echo '<pre>'; print_r($arWsParts); echo '</pre>';
//echo '<pre>'; print_r($arWS); echo '</pre>';

if(extension_loaded('soap')){
	$arARTs=Array();
	$SClient = new SoapClient("http://ws.emex.ru/EmExService.asmx?WSDL",array("trace"=>1,"exception" => 0)); 
	foreach($arWsParts as $PartArray){
		if(!in_array($PartArray['article'],$arARTs)){
			try{
				$arWSParams = array(
					'login' => $arWS['login'],
					'password' => $arWS['password'],
					'detailNum' => $PartArray['article'],
					'substLevel' => 'All', 						//фильтр по заменам: OriginalOnly - без замен и аналогов; All - с заменами и аналогами
					'substFilter' => 'FilterOriginalAndAnalogs', 					//фильтр по типу деталей: None - не фильтровать; FilterOriginalAndReplacements - только искомый номер, новый номер и замены искомого номера; FilterOriginalAndAnalogs - только искомый номер и аналоги.
					'deliveryRegionType' => 'PRI'				//тип доставки (по умолчанию надо указывать PRI)
				);
				$rsCRes = $SClient->FindDetailAdv3($arWSParams);
			}catch(Exception $e){
				$ERROR = $e->getMessage(); break;
			}
			$arCRes = $rsCRes->FindDetailAdv3Result->Details->SoapDetailItem;
		}else{$arCRes=$arCacheData[$PartArray['article']];}
		//echo '<pre>'; print_r($arCRes); echo '</pre>';
		if(is_array($arCRes) AND count($arCRes)>0){
			if(!in_array($PartArray['article'],$arARTs)){
				$arARTs[]=$PartArray['article'];
				$arCacheData[$PartArray['article']]=$arCRes;
			}
			foreach($arCRes as $obRes){
				$brand = (string)$obRes->MakeName;
				$brand = TDMSingleKey($brand,true);
					$PriceArray = TDMPriceArray($PartArray); 
					//Webservice data
					$PriceArray["article"] = (string)$obRes->DetailNum;
					$PriceArray["provider_product_name"] = (string)$obRes->DetailNameRus;
					$PriceArray["brand"] = $brand;
					$PriceArray["price"] = (string)$obRes->ResultPrice;
					$PriceArray["price"] = round($PriceArray["price"],2);
					$PriceArray["currency"] = $arWS['currency'];
					$PriceArray["available"] = (string)$obRes->Quantity; 
					$PriceArray["stock"] = (string)$obRes->PriceCountry.' / '.(string)$obRes->PriceLogo.'';
					$PriceArray["day"] = (string)$obRes->ADDays;
					//price options 
					$arOps = Array();
					$minimum = (string)$obRes->LotQuantity;
					if($minimum>1){$arOps['minimum']=$minimum;}
					$percentgive = (string)$obRes->DDPercent;
					if($percentgive>0){$arOps['percentgive']=$percentgive;}
					$PriceArray["options"] = TDMOptionsImplode($arOps,$PriceArray);
					$ProviderPricesArray[] = $PriceArray;
				//}
			}
		}
	}
}else{$ERROR = 'Warning! PHP extension SOAP is not loaded';}
?>
