<?if(!defined("TDM_PROLOG_INCLUDED") || TDM_PROLOG_INCLUDED!==true)die();
/* DEMO 
В массиве $arWsParts передаются артикулы и их бренды для запроса у вебсервиса.
В массиве $arWS передаются данные настроек вебсервиса в админ части модуля
Раскомментируйте нижние строки print_r() что бы увидеть что содержат эти массивы на любой СТРАНИЦЕ со СПИСКОМ ЗАПЧАСТЕЙ модуля - видно будет только админу модуля:
*/
//if(TDM_ISADMIN){ echo '<pre>'; print_r($arWsParts); echo '</pre>'; die(); }
//if(TDM_ISADMIN){ echo '<pre>'; print_r($arWS); echo '</pre>'; die(); }

//Check web-service protocol supporting (SOAP/XML/HTTP...):
if(extension_loaded('soap')){
	//Supplier web-service API sample method:
	//$SClient = new SoapClient("http://provider.site/soap.wsdl", array('encoding'=>'utf8'));
	
	//Для каждой запчасти данной страницы сделать запрос в вебсервис поставщика (некоторые API вебсервисов так же поддерживают приём данных массивом, все запчасти и их бренды за один запрос, что очень экономит трафик и время)
	foreach($arWsParts as $PartArray){
		//Можем посмотреть для какой запчасти идёт запрос
		//echo '<pre>'; print_r($PartArray); echo '</pre>';
		
		/* //Get prices from web-service sample:
		try{
			$arCRes = $SClient->GetPrice($PartArray['article'], $PartArray['brand'], $arWS['login'], $arWS['password'], $arWS['currency']); //Number, Brand, Login, Pass, currency
		}catch(Exception $e){
			$ERROR = $e->getMessage();
		}
		*/
		//echo '<pre>'; print_r($arCRes); echo '</pre>'; //debug result
		
		//Если вебсервис ответил на запрос по артикулу+бренд и вернул цены и наличие то:
		if(isset($arCRes) AND is_array($arCRes) AND $arCRes['Error']==''){
			//Для каждой записи цены сделать:
			foreach($arCRes as $arRes){
				//Подготовить массив новой цены
				$PriceArray = TDMPriceArray($PartArray); 
				//Add webservice data:
				$PriceArray["article"] = $arRes['Number'];
				$PriceArray["provider_product_name"] = $arRes['Name'];
				$PriceArray["brand"] = $arRes['Brand'];
				$PriceArray["price"] = floatval($arRes['price']);
				$PriceArray["currency"] = $arRes['currency'];
				$PriceArray["day"] = $arRes['DeliveryTime'];
				$PriceArray["available"] = $arRes['Quantity'];
				if($PriceArray["available"]==0){$PriceArray["available"]='9+';}
				$PriceArray["stock"] = $arRes['SupplierCode'];
				//price options $PriceArray["options"], if supported by the provider webservice
				$arOps = Array();
				if($arRes['weight']>0){$arOps['weight']=($arRes['weight']*1000);} //Gr.
				if($arRes['DamagedFlag']=='Y'){$arOps['damaged']=1;}
				if($arRes['UsedFlag']=='Y'){$arOps['used']=1;}
				if($arRes['RestoredFlag']=='Y'){$arOps['restored']=1;}
				$PriceArray["options"] = TDMOptionsImplode($arOps,$PriceArray);
				//Add new record to the final result array $ProviderPricesArray:
				$ProviderPricesArray[] = $PriceArray; //Главное закполнить этот массив $ProviderPricesArray которы далее будет использовать модуль после завершения выполнения данного скрипта
			}
		}else{
			if($arCRes['Error']!=''){
				$ERROR = $arCRes['Error'];
			}
		}
	}
}else{$ERROR = 'Warning! PHP extension SOAP is not loaded';}
?>