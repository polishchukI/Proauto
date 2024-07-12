<?php
// dd($WSPartsArray);
use App\Http\Controllers\FunctionsController as Functions;

if(extension_loaded('soap'))
{
	$ErrorsArray = [];
	$ArticlesArray = [];
	$search_cross = ($WSSettingsArray['links_take']==1) ? 'on' : 'off';
	
	$SClient			= new SoapClient("https://www.avtoto.ru/services/search/soap.wsdl",array('soap_version' => SOAP_1_1));
	$avtotoClient		= new AvtotoListener($SClient);
		
	foreach($WSPartsArray as $PartArray)
	{
		if(!in_array($PartArray['article'],$ArticlesArray))
		{
			try
			{
				$params = ['user_id' => $WSSettingsArray['client_id'],
							'user_login' => $WSSettingsArray['client_login'],
							'user_password' => $WSSettingsArray['client_password'],
							'search_code' => $PartArray['article'],
							'search_cross' => $search_cross];
				$response = $avtotoClient->search_Start($params);
						
			}
			catch(Exception $e)
			{
				$ERROR = $e->getMessage();
			}
		}
		else
		{
			$response=$arCacheData[$PartArray['article']];
		}

		if(isset($response['Info']['Errors']) AND count($response['Info']['Errors'])>0)
		{
			foreach($response['Info']['Errors'] as $ErrorMessage)
			{
				$ErrorsArray[] = $ErrorMessage;
			}
		}
		elseif(isset($response['Parts']) AND count($response['Parts'])>0)
		{
			if(!in_array($PartArray['article'],$ArticlesArray))
			{
				$ArticlesArray[]						=	$PartArray['article'];
				$arCacheData[$PartArray['article']]		=	$response;
			}
			foreach($response['Parts'] as $responsePart)
			{
				//Make valid price array
				$PriceArray = Functions::PriceArray($PartArray); 
				//Webservice data
				// 160 => array:14 [
				// 	"Code" => "0451103336"
				// 	"Manuf" => "BOSCH"
				// 	"Name" => "0 451 103 336_фильтр масляный Renault Clio Megane Laguna 1.4i-1.9DTi 95 "
				// 	"Price" => 586.0
				// 	"Storage" => "Москва"
				// 	"Delivery" => "7"
				// 	"MaxCount" => "20"
				// 	"BaseCount" => "1"
				// 	"StorageDate" => "19.10.2023"
				// 	"DeliveryPercent" => 90.0
				// 	"BackPercent" => -1
				// 	"AvtotoData" => array:1 [ …1]
				// 	"BeingUsed" => "0"
				// 	"Availability" => 0
				//   ]
				$PriceArray["link_to_bkey"]						= $PartArray["bkey"];
				$PriceArray["link_to_akey"]						= $PartArray["akey"];
				$PriceArray["article"]							= $responsePart['Code'];
				$PriceArray["provider_product_name"]			= $responsePart['Name'];
				$PriceArray["brand"]							= $responsePart['Manuf'];
				$PriceArray["price"]							= floatval($responsePart['Price']);
				$PriceArray["currency"]							= $WSSettingsArray['price_currency'];
				$PriceArray["day"]								= $responsePart['Delivery'];
				$PriceArray["available"] 						= $responsePart['MaxCount'];

				// $PriceArray["bkey"]								= Functions::SingleKey($responsePart["Manuf"], true);//test
				// $PriceArray["akey"]								= Functions::SingleKey($responsePart["Code"]);//test

				if($PriceArray["available"] < 1)
				{
					continue;
				}
				$PriceArray["stock"]							= $responsePart['Storage'] . "::" . $responsePart['StorageDate'];
				$OptionsArray									= [];
				$OptionsArray['minimum']						= ($responsePart['BaseCount'] > 1) ? $responsePart['BaseCount'] : 0;
				$OptionsArray['used']							= ($responsePart['BeingUsed'] > 1) ? $responsePart['BeingUsed'] : 0;
				$PriceArray["options"]							= Functions::OptionsImplode($OptionsArray,$PriceArray);
				
				$ProviderPricesArray[] = $PriceArray;
			}
		}
		// dd(compact('ProviderPricesArray'));
	}
	if(count($ErrorsArray)>0)
	{
		$ERROR = implode('<br>',array_unique($ErrorsArray));
	}
}
else
{
	$ERROR = 'Warning! PHP extension SOAP is not loaded';
}

class AvtotoListener
{
    private $soapClient;
    private $responseWaitFirstPeriods = array(0.3, 0.3, 0.3, 0.3, 0.3); //seconds
    private $responseWaitPeriod = 0.5; //seconds
    private $searchExtensionTimeLimit = 10; //seconds

    function __construct ($client)
	{
        $this->soapClient = $client;
    }

    public function search_Start($params)
	{
        $result = [];
        $resultForListener = $this->soapClient->SearchStart($params);
        if ($resultForListener)
		{
            $result = $this->getResultsFromListener($resultForListener);
        }
        return $result;
    }

    private function getResultsFromListener($resultForListener)
	{
        $startTime = microtime(1);
        $result = [];
        $result['Info']['SearchStatus'] = 2; //В обработке
		$sleepCount = 0;
		while( microtime(1) - $startTime < $this->searchExtensionTimeLimit && isset($result['Info']['SearchStatus']) && $result['Info']['SearchStatus'] == 2 )
		{
			$sleepMs = 1000000 * (float)$this->responseWaitPeriod;
            if(isset($this->responseWaitFirstPeriods[$sleepCount]))
			{
                $sleepMs = 1000000 * (float)$this->responseWaitFirstPeriods[$sleepCount];
            }
            usleep( $sleepMs );
			$sleepCount = $sleepCount + 1;
			$result = $this->soapClient->SearchGetParts2($resultForListener);
		}
        return $result;
    }
}
?>