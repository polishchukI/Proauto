<?if(!defined("TDM_PROLOG_INCLUDED") || TDM_PROLOG_INCLUDED!==true)die();
/* DEMO 
� ������� $arWsParts ���������� �������� � �� ������ ��� ������� � ����������.
� ������� $arWS ���������� ������ �������� ���������� � ����� ����� ������
���������������� ������ ������ print_r() ��� �� ������� ��� �������� ��� ������� �� ����� �������� �� ������� ��������� ������ - ����� ����� ������ ������ ������:
*/
//if(TDM_ISADMIN){ echo '<pre>'; print_r($arWsParts); echo '</pre>'; die(); }
//if(TDM_ISADMIN){ echo '<pre>'; print_r($arWS); echo '</pre>'; die(); }

//Check web-service protocol supporting (SOAP/XML/HTTP...):
if(extension_loaded('soap')){
	//Supplier web-service API sample method:
	//$SClient = new SoapClient("http://provider.site/soap.wsdl", array('encoding'=>'utf8'));
	
	//��� ������ �������� ������ �������� ������� ������ � ��������� ���������� (��������� API ����������� ��� �� ������������ ���� ������ ��������, ��� �������� � �� ������ �� ���� ������, ��� ����� �������� ������ � �����)
	foreach($arWsParts as $PartArray){
		//����� ���������� ��� ����� �������� ��� ������
		//echo '<pre>'; print_r($PartArray); echo '</pre>';
		
		/* //Get prices from web-service sample:
		try{
			$arCRes = $SClient->GetPrice($PartArray['article'], $PartArray['brand'], $arWS['login'], $arWS['password'], $arWS['currency']); //Number, Brand, Login, Pass, currency
		}catch(Exception $e){
			$ERROR = $e->getMessage();
		}
		*/
		//echo '<pre>'; print_r($arCRes); echo '</pre>'; //debug result
		
		//���� ��������� ������� �� ������ �� ��������+����� � ������ ���� � ������� ��:
		if(isset($arCRes) AND is_array($arCRes) AND $arCRes['Error']==''){
			//��� ������ ������ ���� �������:
			foreach($arCRes as $arRes){
				//����������� ������ ����� ����
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
				$ProviderPricesArray[] = $PriceArray; //������� ���������� ���� ������ $ProviderPricesArray ������ ����� ����� ������������ ������ ����� ���������� ���������� ������� �������
			}
		}else{
			if($arCRes['Error']!=''){
				$ERROR = $arCRes['Error'];
			}
		}
	}
}else{$ERROR = 'Warning! PHP extension SOAP is not loaded';}
?>