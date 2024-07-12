<?php
/*
Documentation:
http://service.autopiter.ru/price.asmx?op=GetPriceId


Result array sample: 
Array
(
    [0] => stdClass Object
        (
            [Express] => 							//Доставка товара завтра (! Есть определённые условия доставки - заказ до определённого времени. В зависимости от постащика разное время.)
            [RealTimeInProc] => 28					//Выдано поставщиком, %
            [id] => 12047590						//id каталога
            [IdDetail] => 417927271					//id детали (требуется: для корзины, при заказе, при уточнении цены на данную позицию)
            [IsSale] => 							//Товар с дефектом
            [IsStore] => 							//Товар на нашем складе
            [Number] => 22300-P2Y-005				//Полный номер детали
            [ShotNumber] => 22300p2y005				//Сокращенный номер детали
            [NameRus] => Корзина сцепления			//Рус. наименование
            [NameEng] => HONDA CIVIC V (...			//Анг. наименование
			[MinNumberOfSales] => 1					//Минимальное кол-во(может быть 0 или null, тогда мин. кол-во 1)
            [NumberOfAvailable] => 4				//Доступное кол-во (если 0 или null - есть в наличии, кол-во неизвестно)
            [NumberOfDaysSupply] => 4				//Дней доставки
            [DeliveryDate] => 2014-09-30T00:00:00	//Дата доставки детали до города клиента(см. на портале)
            [NameOfCatalog] => Honda				//Название каталога
            [CitySupply] => Москва        			//Город поставщика                                                                                      
            [SalePrice] => 4656.57					//Цена продажи с учетом доставки до города клиента и вашего коэффициента наценки (см. на портале)
            [CountrySupply] => Russia         		//Страна поставщика                                                                                     
            [NumberChange] => 22300P02010			//Номер замены (если не пустой, то заказ по данной позиции не возможен, необходимо получить прайс-лист по NumberChange)
			[IsDimension] => 						//По крупногабаритным деталям этого каталога будет отказ
            [TypeRefusal] => 4						//Тип возврата (Значения 3 и 4 - возврат невозможен, иначе возврат возможен)
            [SearchNum] => 							//Оригинальный номер или нет
            [RowPrice] => 3
            [RowDay] => 1
            [weight] => 
            [PriceReturnOf] => 
            [PurchasePrice] => 
            [IDLogCenter] => 
            [MultPrice] => 
        )

    [1] => stdClass Object
        ( ...
		
		
*/

//echo '<pre>'; print_r($arWsParts); echo '</pre>';
//echo '<pre>'; print_r($arWS); echo '</pre>';

if(extension_loaded('soap')){
	if($arWS['currency']!='EUR' AND $arWS['currency']!='USD'){$arWS['currency']='РУБ';} //("РУБ", "EUR","USD") only
	$client = NULL; 
	global $ERROR;
	function APConnect($arWS){
		global $client; global $ERROR;
		$client = new SoapClient('http://service.autopiter.ru/price.asmx?WSDL',array('soap_version'=>SOAP_1_2,'encoding'=>'UTF-8')); 
		$rsIsAuth = $client->IsAuthorization(); 
		if(!$rsIsAuth->IsAuthorizationResult){
			$rsAuth = $client->Authorization(array('UserID'=>$arWS['login'],'Password' =>$arWS['password'],'Save'=>true));
			if(!$rsAuth->AuthorizationResult){$ERROR = 'Error. "AuthorizationResult" fail for user id <b>'.$arWS['login'].'</b>';}
		}
	} 
	function APgetPriceByNum ($PartArray,$arWS){
		global $client; 
		//echo '$catalogObj = $client->FindCatalog(array("ShortNumberDetail"=>"'.$PartArray['article'].'","Name"=>"'.$PartArray['brand'].'")); <br>';  
		$catalogObj = $client->FindCatalog(array('ShortNumberDetail'=>$PartArray['article'],'Name'=>$PartArray['brand']));
		if (!$catalogObj->FindCatalogResult) {return false;} 
		$ItemCat = $catalogObj->FindCatalogResult->SearchedTheCatalog; 
		//echo '<pre>'; print_r($ItemCat); echo '</pre>';
		if(is_array($ItemCat)){
			foreach($ItemCat as $obCatItem){
				if(TDMSingleKey($obCatItem->Name,true)==$PartArray['bkey']){$CatID = $obCatItem->id; $CatName = TDMSingleKey($obCatItem->Name,true);} //Only searched brand
			}
		}else{
			$CatName = TDMSingleKey($ItemCat->Name,true);
			if($CatName==$PartArray['bkey']){$CatID = $ItemCat->id;}
		}
		if($CatID>0){
			try {$details = $client->GetPriceId(array ('id'=>$CatID,'IdArticleDetail'=>-1,'FormatCurrency'=>$arWS['currency'],'SearchCross'=>$arWS['links_take']));}catch(Exception $e){echo 'exception'; var_dump($e); return false;}
			if(!$details->GetPriceIdResult) {return false;}
			return $details->GetPriceIdResult->BasePriceForClient; 
		}else{return false;}
	}
	APConnect($arWS);
	if($ERROR==''){
		foreach($arWsParts as $PartArray){
			$arRes = APgetPriceByNum($PartArray,$arWS);
			//echo '<pre>'; print_r($arRes); echo '</pre>'; 
			if(is_array($arRes) AND count($arRes)>0){
				foreach($arRes as $obRes){
					//Make valid price array
					$PriceArray = TDMPriceArray(); 
					$PriceArray["link_to_bkey"] = $PartArray['bkey'];		//If links (cross) number returned
					$PriceArray["link_to_akey"] = $PartArray['akey'];		//If links (cross) number returned
					//Webservice data
					$PriceArray["article"] = (string)$obRes->Number;
					$PriceArray["provider_product_name"] =  trim((string)$obRes->NameRus);
					$PriceArray["brand"] = (string)$obRes->NameOfCatalog;
					$PriceArray["price"] = floatval($obRes->SalePrice);
					$PriceArray["currency"] = $arWS['currency'];
					if($PriceArray['currency']=='РУБ'){$PriceArray['currency']='RUB';} //only ISO currency in module
					$PriceArray["day"] = (string)$obRes->NumberOfDaysSupply;
					$PriceArray["available"] = (string)$obRes->NumberOfAvailable;
					if($PriceArray["available"]==0 OR $PriceArray["available"]==null){$PriceArray["available"]='1+';}
					$PriceArray["stock"] = trim((string)$obRes->CitySupply);
					//price options
					$arOps = Array();
					
					if(intval($obRes->TypeRefusal)==3 OR intval($obRes->TypeRefusal)==4){$arOps['noreturn']=1;}
					if((string)$obRes->IsSale!=''){$arOps['damaged']=1;}
					if(floatval($obRes->weight)>0){$arOps['weight']=floatval($obRes->weight);}
					if(intval($obRes->RealTimeInProc)>0){$arOps['PERCENT_GIVE']=intval($obRes->RealTimeInProc);}
					if(intval($obRes->IdDetail)>0){$arOps['PRICE_ID']=intval($obRes->IdDetail);}
					if(intval($obRes->MinNumberOfSales)>1){$arOps['minimum']=intval($obRes->MinNumberOfSales);}
					$PriceArray["options"] = TDMOptionsImplode($arOps,$PriceArray);
					//Add new record
					$ProviderPricesArray[] = $PriceArray;
				}
			}
		}
	}
	//die();
}
?>
