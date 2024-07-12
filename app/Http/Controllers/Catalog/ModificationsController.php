<?php

namespace App\Http\Controllers\Catalog;

use App\Models\ModelUrl;

use Illuminate\Support\Str;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FunctionsController as Functions;
use App\Http\Controllers\Tecdoc\NewTecdocController;
use App\Http\Controllers\Shop\BlogController;

//////////seo
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
//////////seo

class ModificationsController extends Controller
{	
    static function GetModificationsPage(Request $request)
	{
		$group = $request->group;
		$manufacturer = $request->manufacturer;
		$model = $request->model;
		
		$ResultArray = [];
		$ResultArray['group'] = $group;
		$$ResultArray['manufacturer'] = $manufacturer;
		$$ResultArray['model'] = $model;
		dd(compact('ResultArray'));
		$BrandArray = Functions::GetURLmanufacturer($request->manufacturer);
		
		$ResultArray['ubrand'] = $BrandArray['uname'];
		$ResultArray['brand'] = $BrandArray['name'];
		$ResultArray['modifications'] = [];

		$MODURL = Functions::StringForURL($request->model);
		if ($ResultArray['ubrand'] && $MODURL)
		{
			$ManufacturerRequest = NewTecdocController::getManufacturerByCode($group, $ResultArray['ubrand']);
			foreach ($ManufacturerRequest as $ManufacturerArray)
			{
				$ResultArray['brand'] = $ManufacturerArray['brand'];

				$model_id = Functions::GetModelIDByURLName($BrandArray['name'], $MODURL);

				if (0 < $model_id)
				{
					$ModelRequest = NewTecdocController::GetModelByID($group, $model_id);
					foreach ($ModelRequest as $Model2Array)
					{
						$TempModelsArray[] = $Model2Array;
					}
					$MNCn = 0;
					foreach ($TempModelsArray as $TempModelArray)
					{
						$ModelArray = $TempModelArray;
						$MNCn = $MNCn + 1;
					}
					if ($ModelArray['model_id'] !== 0)
					{
						$ModificationsRequest = NewTecdocController::getModifications($group, $ModelArray['model_id']);
						if (0 < count($ModificationsRequest))
						{
						// dd(compact('model_id'));
						foreach($ModificationsRequest as $ModificationArray)
						{
							$mod_id = $ModificationArray['modification_id'];
							$requestData[$ModificationArray['modification_id']] = [];
							$requestData[$ModificationArray['modification_id']]['modification_id'] = $mod_id;
							foreach($res as $ModificationArray)
							{
								if($ModificationArray['modification_id'] == $mod_id)
								{
									
								/*group'=>$group,
								'brand' => $BrandArray['code'],
								'mod_name' => $ModelArray['url_name'],
								'model_filtered_url' => $URLN,
								'model_id' => $ModelArray['model_id']*/
								$ResultArray[$ModificationArray['modification_id']][$ModificationArray['attributetype']] = $ModificationArray['displayvalue'];
																	$ModificationArray['URL'] = Functions::GenerateURL(['group' => $group, 'brand' => $BrandArray['code'], 'model_filtered_url' => $MODURL,'modification_id' => $ModificationArray['modification_id'],
										'ENGINE' => $ModificationArray['ENG_CODE'], 'TYPE_NAME' => $ModificationArray['TYP_CDS_TEXT']]);
								}
							}
						}
						// dd(compact('ResultArray'));

										
							$ResultArray['model_id'] = $model_id;
							$ResultArray['MODEL'] = $ModelArray['MOD_CDS_TEXT'];
							$ResultArray['YEAR'] = '(' . $DateFrom . ' - ' . $DateTo . ')';
							$modificationSrc = '/images/modifications/' . $BrandArray['name'] . '/' . $ModelArray['model_id'] . '.png';
							if (file_exists($_SERVER['DOCUMENT_ROOT'] . $modificationSrc))
							{
								$ResultArray['pictureSrc'] = $modificationSrc;
							}
							else
							{
								$BrandLogoSrc = '/images/brands/' . $ResultArray['ubrand'] . '.png';
								if (file_exists($_SERVER['DOCUMENT_ROOT'] . $BrandLogoSrc))
								{
									$ResultArray['pictureSrc'] = $BrandLogoSrc;
								}
								else
								{
									$ResultArray['pictureSrc'] = '/images/brands/' . $ResultArray['brand'] . '.png';
								}
							}
						}
						else
						{
							return redirect('/catalog/' . $group . '/'. $ResultArray['brand']. '')->with('flash_message', 'There is no modifications of model of brand' . $ResultArray['ubrand']);
						}
					}
					else
					{
						return redirect('/catalog/' . $group . '/' . $ResultArray['brand'] . '/' . $MODURL.'')->with('flash_message', 'There is no modifications of model of brand' . $ResultArray['ubrand']);
					}

				}
				else
				{
					return redirect('/catalog/' . $group . '/'. $BrandArray['name'].'')->with('flash_message', 'There is no modifications of model of brand' . $ResultArray['ubrand']);
				}
			}

			return view('inventory.catalog.modifications', compact('ResultArray'));
		}
		else
		{
			return view('inventory.errors.noparts');
		}
	}


	public static function GetShopModifications(Request $request)
	{
		$group = $request->group;
		$manufacturer = $request->manufacturer;
		$model = $request->model;
		
		$ResultArray = [];
		$BrandArray = Functions::GetURLmanufacturer($request->manufacturer);
		
		$ResultArray['group'] = $group;
		$ResultArray['ubrand'] = $BrandArray['uname'];
		$ResultArray['brand'] = $BrandArray['name'];
		$ResultArray['modifications'] = [];

		$MODURL = Functions::StringForURL($request->model);
		if ($ResultArray['ubrand'] && $MODURL)
		{
			$ManufacturerRequest = NewTecdocController::getManufacturerByCode($group, $ResultArray['ubrand']);
			
			foreach ($ManufacturerRequest as $ManufacturerArray)
			{
				$model_id = ModelUrl::where('url_name','=', $model)->first()->model_id;
				if (0 < $model_id)
				{
					$ModelRequest = NewTecdocController::GetModelByID($group, $model_id);
					foreach ($ModelRequest as $Model2Array)
					{
						$TempModelsArray[] = $Model2Array;
					}
					$MNCn = 0;
					foreach ($TempModelsArray as $TempModelArray)
					{
						$ModelArray = $TempModelArray;
						$MNCn = $MNCn + 1;
					}
					if ($ModelArray['model_id'] !== 0)
					{
						// "id" => 19904
						// "constructioninterval" => "11.2005 - 11.2010"
						// "power" => "97 PS"
						// "capacity_tax" => "0 ccm"
						// "capacity_technical" => "1399 ccm"
						// "capacity" => "1.4 l"
						// "modification_name" => "1.4-l"
						// "numberofvalves" => "4"
						// "numberofcylinders" => "4"
						// "enginetype" => "Бензиновый двигатель"
						// "bodytype" => "седан"
						// "drivetype" => "Привод на передние колеса"
						// "fueltype" => "бензин"
						// "fuelmixture" => "Впрыскивание во впускной коллектор/Карбюратор"
						// "kbanumber" => "8252 AAA"
						// "enginecode" => "G4EE"
						$ModificationsRequest = NewTecdocController::getModifications($group, $ModelArray['model_id']);
						if (0 < count($ModificationsRequest))
						{
							switch ($group)
							{
								case 'passenger':
									foreach($ModificationsRequest as $ModificationArray)
									{
										$mod_id = $ModificationArray['modification_id'];
										$requestData[$ModificationArray['modification_id']] = [];
										$requestData[$ModificationArray['modification_id']]['modification_id'] = $mod_id;
										foreach($ModificationsRequest as $ModificationArray)
										{
											if($ModificationArray['modification_id'] == $mod_id)
											{
												$modification[$ModificationArray['modification_id']]['id'] = $mod_id;
												$modification[$ModificationArray['modification_id']][Str::lower($ModificationArray['attributetype'])] = $ModificationArray['displayvalue'];
												if($ModificationArray['attributetype'] == 'Capacity')
												{
													$modification_name = Functions::StringForURL($ModificationArray['displayvalue']);
													$modification[$ModificationArray['modification_id']]['modification_name'] = $modification_name;
												}
												if($ModificationArray['attributetype'] == 'EngineCode')
												{
													$enginecode = Functions::StringForURL($ModificationArray['displayvalue']);											
												}
												else
												{
													$enginecode = $ModificationArray['modification_id'];
												}
												if($ModificationArray['attributetype'] == 'Capacity')
												{
													$modification[$ModificationArray['modification_id']]['modification_name'] = Functions::StringForURL($ModificationArray['displayvalue']);
												}
												$ResultArray['modifications'] = $modification;
											}
										}
										if(isset($modification_name))
										{
											$modification[$mod_id]['url'] = Functions::GenerateURL(['group' => $group, 'brand' => $BrandArray['code'], 'model_name' => $model, 'modification_id' => $mod_id, 'engine' => $enginecode, 'modification_name' => $modification_name]);
										}
										else
										{
											$modification[$mod_id]['url'] = Functions::GenerateURL(['group' => $group, 'brand' => $BrandArray['code'], 'model_name' => $model, 'modification_id' => $mod_id, 'engine' => $enginecode]);

										}
									}
									$ResultArray['model_id'] = $model_id;
									$ResultArray['model'] = $ModelArray['name'];
									$ResultArray['year'] = '(' . $ModelArray['constructioninterval'] . ')';
									$modificationSrc = '/images/modifications/' . $BrandArray['name'] . '/' . $ModelArray['model_id'] . '.png';
									if (file_exists($_SERVER['DOCUMENT_ROOT'] . $modificationSrc))
									{
										$ResultArray['pictureSrc'] = $modificationSrc;
									}
									else
									{
										$BrandLogoSrc = '/images/brands/' . $ResultArray['ubrand'] . '.png';
										if (file_exists($_SERVER['DOCUMENT_ROOT'] . $BrandLogoSrc))
										{
											$ResultArray['pictureSrc'] = $BrandLogoSrc;
										}
										else
										{
											$ResultArray['pictureSrc'] = '/images/brands/' . $ResultArray['brand'] . '.png';
										}
									}
									break;
								case 'commercial':
									$modification = [];
									$EngineCodes = NewTecdocController::getEngineByModificationId($group, $model_id);
									
									$incomeDataArray = array_merge($ModificationsRequest, $EngineCodes);
									foreach($incomeDataArray as $item)
									{
										$modification_id_tmp = $item['modification_id'];
										if (!array_key_exists($modification_id_tmp, $modification))
										{
												$modification[$modification_id_tmp] = [];
												$modification[$modification_id_tmp]["modification_id"] = $modification_id_tmp;
										}
										if ($item['attributetype'] != "EngineCode")
										{
											$modification[$modification_id_tmp][$item['attributetype']] = $item['displayvalue'];
										}
										else
										{
											if (!array_key_exists($item['attributetype'], $modification[$modification_id_tmp]))
											{
												$modification[$modification_id_tmp][$item['attributetype']] = $item['displayvalue'];
											}
											else
											{
												$modification[$modification_id_tmp][$item['attributetype']] .= ", {$item['displayvalue']}";
											}
										}
										$modification[$modification_id_tmp]['Modification'] = NewTecdocController::getModificationNameById($group, $modification_id_tmp)->name;
										
										$ResultArray['modifications'] = $modification;
									}
									
									// dd(compact('ResultArray'));
									
									$ResultArray['model_id'] = $model_id;
									$ResultArray['model'] = $ModelArray['name'];
									$ResultArray['year'] = '(' . $ModelArray['constructioninterval'] . ')';
									$modificationSrc = '/images/modifications/' . $BrandArray['name'] . '/' . $ModelArray['model_id'] . '.png';
									if (file_exists($_SERVER['DOCUMENT_ROOT'] . $modificationSrc))
									{
										$ResultArray['pictureSrc'] = $modificationSrc;
									}
									else
									{
										$BrandLogoSrc = '/images/brands/' . $ResultArray['ubrand'] . '.png';
										if (file_exists($_SERVER['DOCUMENT_ROOT'] . $BrandLogoSrc))
										{
											$ResultArray['pictureSrc'] = $BrandLogoSrc;
										}
										else
										{
											$ResultArray['pictureSrc'] = '/images/brands/' . $ResultArray['brand'] . '.png';
										}
									}
									break;
								case 'motorbike':
									$modification = [];

									foreach($ModificationsRequest as $item)
									{
										// "modification_id" => 101460
										// "constructioninterval" => "02.2013 - "
										// "description" => "Multistrada 1200 S Touring"
										
										$modification_id = $item['modification_id'];
										$modification[$modification_id] = ['modification_id' => $item['modification_id'], "description" => $item["description"], "constructioninterval" => $item["constructioninterval"]];
										
										$ResultArray['modifications'] = $modification;
									}
									$ResultArray['model_id'] = $model_id;
									$ResultArray['model'] = $ModelArray['name'];
									// $ResultArray['year'] = '(' . $ModelArray['constructioninterval'] . ')';
									$modificationSrc = '/images/modifications/' . $BrandArray['name'] . '/' . $ModelArray['model_id'] . '.png';
									if (file_exists($_SERVER['DOCUMENT_ROOT'] . $modificationSrc))
									{
										$ResultArray['pictureSrc'] = $modificationSrc;
									}
									else
									{
										$BrandLogoSrc = '/images/brands/' . $ResultArray['ubrand'] . '.png';
										if (file_exists($_SERVER['DOCUMENT_ROOT'] . $BrandLogoSrc))
										{
											$ResultArray['pictureSrc'] = $BrandLogoSrc;
										}
										else
										{
											$ResultArray['pictureSrc'] = '/images/brands/' . $ResultArray['brand'] . '.png';
										}
									}
									break;
								case 'engine':
									// self::GetShopEngineModifications($request);
									break;
								case 'axle':
									// self::GetShopAxleModifications($request);
									break;
							}
							
							
						}
						else
						{
							return redirect('/catalog/' . $group . '/'. $ResultArray['brand']. '')->with('flash_message', 'There is no modifications of model of brand' . $ResultArray['ubrand']);
						}
					}
					else
					{
						return redirect('/catalog/' . $group . '/' . $ResultArray['brand'] . '/' . $MODURL.'')->with('flash_message', 'There is no modifications of model of brand' . $ResultArray['ubrand']);
					}

				}
				else
				{
					return redirect('/catalog/' . $group . '/'. $BrandArray['name'].'')->with('flash_message', 'There is no modifications of model of brand' . $ResultArray['ubrand']);
				}
			}			
			
			$posts = BlogController::ShowPostsCarousel();
			// dd(compact('ResultArray','posts'));
			return view('shop.catalog.modifications', compact('ResultArray','posts'));
		}
		else
		{
			return view('shop.errors.noparts');
		}
	}
}

