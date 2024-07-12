<?php
// dd($WSPartsArray,$WSSettingsArray);
use App\Http\Controllers\FunctionsController as Functions;

if(extension_loaded('soap'))
{
	$SClient = new SoapClient("http://turbo-cars.net/ws1/service.asmx?WSDL");
	$FromStockOnly = "FromStockOnly";
	$PartsCount = 0;
	$ResultCount = 0;
	$PriceCount = 0;

	foreach($WSPartsArray as $PartArray)
	{
		$PartsCount = $PartsCount + 1;
		$obCRes = $SClient->Code_Search(["Search_Code"=>$PartArray["article"], "ClientID"=>$WSSettingsArray["client_login"], "Password"=>$WSSettingsArray['client_password'],"FromStockOnly"=>$FromStockOnly]);

		if($obCRes->Code_SearchResult->Code_Search != "")
		{
			$ResultCount = $ResultCount + 1;
		}
		
		try
		{
			if(0 < count($obCRes->Code_SearchResult->List->Code_List_Row))
			{
				
				foreach($obCRes->Code_SearchResult->List->Code_List_Row as $SearchResult)
				{
					$PriceCount								= $PriceCount + 1;
					$MikadoBrand							= (string)$SearchResult->ProducerBrand;
					//Only searched brand
					if(Functions::SingleKey($MikadoBrand, true) == $PartArray['bkey'])
					{
						$PriceArray							= Functions::PriceArray($PartArray);
						$PriceArray["link_to_bkey"]			= $PartArray["bkey"];//If links (cross) number returned
						$PriceArray["link_to_akey"]			= $PartArray["akey"];//If links (cross) number returned
						
						if($SearchResult->CodeType == "OEM" && $SearchResult->PrefixLength == 0)
						{
							$ArtTMP						= (string)$SearchResult->ProducerCode;
						}
						else
						{
							$ArtTMP						= (string)substr($SearchResult->ZakazCode, $SearchResult->PrefixLength);
						}
						
						$PriceArray["article"]						= mb_strtoupper($ArtTMP, 'UTF-8');
						$PriceArray["provider_product_name"]		= (string)$SearchResult->Name;
						$PriceArray["brand"]						= $MikadoBrand;
						$PriceArray["price"]						= (string)$SearchResult->PriceRUR;
						$PriceArray["currency"]						= $WSSettingsArray["currency"];
						foreach($SearchResult->OnStocks as $obPRes)
						{
							$PriceArray["day"] = (string)$obPRes->Srock ?? 0;
							$PriceArray["available"] = (string)$obPRes->StockQTY ?? 0;
							if($PriceArray["available"]<1)
							{
								continue;
							}
							if(!isset($obPRes->StokID) && !isset($obPRes->StokName))
							{
								$PriceArray["stock"] = $WSSettingsArray["price_code"];
							}
							else
							{
								$PriceArray["stock"] = $WSSettingsArray["price_code"]. "::" .(string)$obPRes->StokID;
							}
							// $arOps = [];
							$PriceArray["options"] = Functions::OptionsImplode($arOps,$PriceArray);
							// $PriceArray["options"] = "0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;";
							$ProviderPricesArray[] = $PriceArray;
							
						}
					}
				}
			}				
		}
		catch (Exception $e)
		{
			// exception is raised and it'll be handled here
			$ERROR = $e->getMessage();//contains the error message
		}
	}

	if($PartsCount == $ResultCount AND $PriceCount<=0)
	{
		$ERROR = 'Empty prices returned for all <b>'.$ResultCount.'</b> queries. Register your site IP on provider service.';
	}
}
/*
Documentation:
http://www.mikado-parts.ru/ws/service.asmx?op=Code_Search
http://www.mikado-parts.ru/office/HelpWS.asp
Result array sample: 
stdClass Object
(
    [ZakazCode] => xbs-0451103336
    [Supplier] => BOSCH
    [ProducerBrand] => BOSCH
    [ProducerCode] => 0451103336
    [Brand] => BOSCH
    [Country] => Германия
    [Name] => Фильтр масляный
    [OnStocks] => stdClass Object
        (
            [StockLine] => Array
                (
                    [0] => stdClass Object
                        (
                            [StokName] => Волгоград
                            [StokID] => 34
                            [StockQTY] =>  1
                        )
                    [1] => stdClass Object
                        (
                            [StokName] => СПб
                            [StokID] => 1
                            [StockQTY] =>  >10
                            [DeliveryDelay] => 5
                        )
                )
        )
    [PriceRUR] => 225.75
    [CodeType] => Aftermarket
    [Source] => stdClass Object
        (
            [SourceProducer] => BOSCH
            [SourceCode] => 0451103336
        )
    [PrefixLength] => 4
)
*/
?>
