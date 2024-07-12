<?php
//echo '<pre>'; print_r($WSPartsArray); echo '</pre>'; 
//echo '<pre>'; print_r($WSSettingsArray); echo '</pre>';
// dd($WSPartsArray);
// dd($WSSettingsArray);
use App\Http\Controllers\FunctionsController as Functions;

$CurStmp = time();

foreach($WSPartsArray as $PartArray)
{
	if($PartArray['brand']=='')
	{
		continue;
	}
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,'http://ws.armtek.ru/api/ws_search/search?format=json');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POST, true);

	$search_cross = ($WSSettingsArray['links_take']==1) ? 'on' : 'off';

    curl_setopt($ch, CURLOPT_POSTFIELDS, "VKORG=4130&QUERY_TYPE=".$links_take."&KUNNR_RG=".$WSSettingsArray['client_id']."&PIN=".$PartArray['article']);
	//echo "VKORG=4000&QUERY_TYPE=".$links_take."&KUNNR_RG=".$WSSettingsArray['client_id']."&PIN=".$PartArray['article'].'<br>';
	curl_setopt($ch, CURLOPT_USERPWD, $WSSettingsArray['login'].':'.$WSSettingsArray['password'] );
	$json = curl_exec($ch);
	curl_close($ch);
	$arWRes = json_decode($json,true);
	//echo '<br><pre>'; print_r($arWRes); echo '</pre><br><br>'; //die();
	
	if(is_array($arWRes) AND isset($arWRes['RESP']))
	{
		// if($arWRes['RESP']['ERROR']!='')
		if(array_key_exists('ERROR', $arWRes['RESP']))
		{
			$ERROR = $arWRes['RESP']['ERROR'].' - '.$arWRes['MESSAGES'][0]['TEXT'];
		}
		else
		{
			foreach($arWRes['RESP'] as $arRes)
			{
				$arRes['price']=floatval($arRes['price']);
				if($arRes['price']>0)
				{
					//Make valid price array
					$PriceArray = Functions::PriceArray($PartArray); 
					//Webservice data
					$PriceArray["article"] = $arRes['PIN'];
					$PriceArray["provider_product_name"] = $arRes['name'];
					$PriceArray["brand"] = $arRes['brand'];
					$PriceArray["price"] = $arRes['price'];
					$PriceArray["currency"] = $arRes['WAERS'];
					if($arRes['DLVDT']!='')
					{
						$Y=substr($arRes['DLVDT'],0,4);
						$M=substr($arRes['DLVDT'],4,2);
						$D=substr($arRes['DLVDT'],6,2);
						$Stmp = strtotime($D.'-'.$M.'-'.$Y);
						$PriceArray["day"] = round(($Stmp-$CurStmp)/86400);
					}
					//$PriceArray["day"] = 1;
					$PriceArray["available"] = intval($arRes['RVALUE']);
					$PriceArray["stock"] = intval($arRes['PARNR']).'/'.intval($arRes['KEYZAK']);
					$PriceArray["options"] = '';
					//price options
					$arOps = Array();
					if($arRes['VENSL']>0){$arOps['percentgive']=intval($arRes['VENSL']);}
					if($arRes['MINBM']>1){$arOps['minimum']=intval($arRes['MINBM']);}
					$PriceArray["options"] = Functions::OptionsImplode($arOps,$PriceArray);
					//Add new record
					//echo '<pre>'; print_r($arRes); echo '</pre>';//die();
					//echo '<pre>'; print_r($PriceArray); echo '</pre>';//die();
					$ProviderPricesArray[] = $PriceArray;
				}
			}
		}
	}
	else
	{
		$ERROR = 'Wrong response format!';
	}
}
/*
Documentation:
http://ws.armtek.ru/?page=service&alias=search#methsearch_post

Array(
    [STATUS] => 200
    [MESSAGES] => Array()
    [RESP] => Array(
		[0] => Array (
			[PIN] => C8301
			[brand] => LYNXAUTO
			[name] => ����������� �������� / ����. ������ / �����. ����. HONDA Civic 1.4-1.6 95-01 / C
			[ARTID] => 9241141
			[PARNR] => 115840
			[KEYZAK] => 0000008403
			[RVALUE] => 5
			[RDPRF] => 1
			[MINBM] => 1
			[VENSL] => 95.00
			[price] => 270.50
			[WAERS] => RUB
			[DLVDT] => 20161011140000
			[ANALOG] => 
		)
		[1] => Array
*/
?>