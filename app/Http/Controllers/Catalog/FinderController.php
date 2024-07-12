<?php

namespace App\Http\Controllers\Catalog;

use Illuminate\Http\Request;

use Illuminate\Support\Str;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Tecdoc\NewTecdocController;
use App\Http\Controllers\FunctionsController as Functions;

class FinderController extends Controller
{
	static function GetManufacturers(Request $request)
	{
		$group = $request->group;
		$res = NewTecdocController::getBrands($group);
		
		$jsonResult = [];
		foreach ($res as $item)
		{
			$jsonResult[] = ["id"=>$item["manufacturer_id"],"manufacturer"=>$item["manufacturer_name"]];
		}
		return response()->json($jsonResult);
	}
	static function GetModels(Request $request)
	{
		$group = $request->group;
		$manufacturer_id = $request->manufacturer_id;
		$res = NewTecdocController::getModels($group, $manufacturer_id);

		$jsonResult = [];
		foreach ($res as $item)
		{
			$jsonResult[] = ["id"=>$item["model_id"], "model"=>"" . $item["model_name"] . "( " . $item["constructioninterval"] . " )"];
		}
		return response()->json($jsonResult);
	}
	
	static function getModifications(Request $request)
	{
		$group = $request->group;
		$manufacturer_id = $request->manufacturer_id;
		$model_id = $request->model_id;
		
		$res = NewTecdocController::getModifications($group, $model_id);
		
		$jsonResult = [];
		$requestData =[];
		switch ($group)
		{
            case 'passenger':
				foreach($res as $item)
				{
					$modification_id_tmp = $item['modification_id'];
					if (!array_key_exists($modification_id_tmp, $requestData))
					{
							$requestData[$modification_id_tmp] = [];
							$requestData[$modification_id_tmp]["modification_id"] = $modification_id_tmp;
					}
					if ($item['attributetype'] != "EngineCode")
					{
						$requestData[$modification_id_tmp][$item['attributetype']] = $item['displayvalue'];
					}
					else
					{
						if (!array_key_exists($item['attributetype'], $requestData[$modification_id_tmp]))
						{
							$requestData[$modification_id_tmp][$item['attributetype']] = $item['displayvalue'];
						}
						else
						{
							$requestData[$modification_id_tmp][$item['attributetype']] .= ", {$item['displayvalue']}";
						}
					}
				}
				
				foreach($requestData as $item)
				{
					
					//EngineCode - is not always set - may be errors
					$modification_id			= $item['modification_id'];
					$Capacity					= $item["Capacity"] ?? "";
					$EngineCode					= $item["EngineCode"] ?? "No code";
					$Power						= $item["Power"] ?? "";
					$FuelType					= $item["FuelType"] ?? "";
					$ConstructionInterval		= $item["ConstructionInterval"] ?? "";

					$modification = $Capacity . " (" . $EngineCode . ", " . $Power . ", " . $FuelType . ", " . $ConstructionInterval . " )";


					$jsonResult[] = ["id"=>$modification_id, "modification"=> $modification];
				}
				break;
            case 'commercial':
				$EngineCodes = NewTecdocController::getEngineByModificationId($group, $model_id);
				
				$incomeDataArray = array_merge($res, $EngineCodes);
				
				foreach($incomeDataArray as $item)
				{
					$modification_id_tmp = $item['modification_id'];
					if (!array_key_exists($modification_id_tmp, $requestData))
					{
							$requestData[$modification_id_tmp] = [];
							$requestData[$modification_id_tmp]["modification_id"] = $modification_id_tmp;
					}
					if ($item['attributetype'] != "EngineCode")
					{
						$requestData[$modification_id_tmp][$item['attributetype']] = $item['displayvalue'];
					}
					else
					{
						if (!array_key_exists($item['attributetype'], $requestData[$modification_id_tmp]))
						{
							$requestData[$modification_id_tmp][$item['attributetype']] = $item['displayvalue'];
						}
						else
						{
							$requestData[$modification_id_tmp][$item['attributetype']] .= ", {$item['displayvalue']}";
						}
					}
				}
				
				foreach($requestData as $item)
				{
					//EngineCode - is not always set - may be errors
					$modification_id			= $item['modification_id'];
					$Capacity					= $item["Capacity"] ?? "";
					$EngineCode					= $item["EngineCode"] ?? "No code";
					$Power						= $item["Power"] ?? "";
					$FuelType					= $item["FuelType"] ?? "";
					$ConstructionInterval		= $item["ConstructionInterval"] ?? "";

					$modification = $Capacity . " (" . $EngineCode . ", " . $Power . ", " . $ConstructionInterval . " )";
					// $modification = $Capacity . " (" . $EngineCode . ", " . $Power . ", " . $FuelType . ", " . $ConstructionInterval . " )";


					$jsonResult[] = ["id"=>$modification_id, "modification"=> $modification];
				}
				break;
            case 'motorbike':
				foreach($res as $item)
				{
					$modification_id			= $item['modification_id'];
					$description				= $item["description"] ?? "No code";
					$ConstructionInterval		= $item["constructioninterval"] ?? "";

					$modification = $description . " (" . $ConstructionInterval . " )";


					$jsonResult[] = ["id"=>$modification_id, "modification"=> $modification];
				}
                break;
            case 'engine':
				foreach($res as $item)
				{
					$modification_id_tmp = $item['modification_id'];
					if (!array_key_exists($modification_id_tmp, $requestData))
					{
							$requestData[$modification_id_tmp] = [];
							$requestData[$modification_id_tmp]["modification_id"] = $modification_id_tmp;
					}
					if ($item['attributetype'] != "EngineCode")
					{
						$requestData[$modification_id_tmp][$item['attributetype']] = $item['displayvalue'];
					}
					else
					{
						if (!array_key_exists($item['attributetype'], $requestData[$modification_id_tmp]))
						{
							$requestData[$modification_id_tmp][$item['attributetype']] = $item['displayvalue'];
						}
						else
						{
							$requestData[$modification_id_tmp][$item['attributetype']] .= ", {$item['displayvalue']}";
						}
					}
				}
				
				foreach($requestData as $item)
				{					
					//EngineCode - is not always set - may be errors
					$modification_id			= $item['modification_id'];
					$Capacity					= $item["Capacity"] ?? "";
					$EngineCode					= $item["EngineCode"] ?? "No code";
					$Power						= $item["Power"] ?? "";
					$FuelType					= $item["FuelType"] ?? "";
					$ConstructionInterval		= $item["ConstructionInterval"] ?? "";

					$modification = $Capacity . " (" . $EngineCode . ", " . $Power . ", " . $FuelType . ", " . $ConstructionInterval . " )";


					$jsonResult[] = ["id"=>$modification_id, "modification"=> $modification];
				}
                break;
            case 'axle':
				$query = CatalogAxleTree::where('axleid','=', (int)$modification_id);
                break;
        }		

		// dd(compact('jsonResult'));
		return response()->json($jsonResult);
	}
	
	static function GoToCatalog(Request $request)
	{
		$group				= $request->group;
		$manufacturer_id	= $request->manufacturer;
		$model_id			= $request->model;
		$modification_id	= $request->modification;
		$uriArray			= [];
		
		// getBrandById
		$manufacturer						= NewTecdocController::getManufacturerById($group, $manufacturer_id);
		dd(compact('manufacturer'));
		$uriArray['manufacturer']			= Str::lower($manufacturer['manufacturer_name']);
		$model								= NewTecdocController::getModelById($group, $model_id);
		$uriArray['model']					= Str::lower($model[0]['name']);
		$modification						= NewTecdocController::getModificationById($group, $modification_id);
		foreach($modification as $item)
		{
			$uriArray['modification'] = Str::lower($item['modification_id'] . '-' . $item['displayvalue']);
		}

		return redirect('/catalog/' . $group . '/' . $uriArray['manufacturer'] . '/' . $uriArray["model"] . '/' . $uriArray["modification"] . '');
	}
}
