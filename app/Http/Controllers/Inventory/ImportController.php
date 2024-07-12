<?php

namespace App\Http\Controllers\Inventory;

use Illuminate\Support\Str;

use Illuminate\Http\Request;

use App\Models\Inventory\Provider;
use App\Models\Inventory\ProviderPrice;
use App\Models\Inventory\ProviderPriceColumn;

use App\Http\Controllers\FunctionsController as Functions;
use App\Http\Controllers\Controller;

/////////////import
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
/////////////import

class ImportController extends Controller
{
	public function import_price(Request $request)
	{
		\Debugbar::disable();

		
		$ResponseArray = [];
		$provider_code = $request->provider_code;
		
		$ResponseArray[] = "Начало импорта прайса поставщика  " . $provider_code . "";

		if(!isset($provider_code))
		{
			$ResponseArray[] = "Поставщик не выбран";
			return view('inventory.modal.priceimportresult', compact('ResponseArray'));
		}
		
		$provider_params = Provider::where('provider_code', $provider_code)->first()->toArray();

		$provider_price_settings = ProviderPriceColumn::select('field_number','field_type')->where('provider_id', $provider_params['id'])->get()->toArray();

		//column settings test
		$relations_count = 0;
		foreach ($provider_price_settings as $ColumnsArray)
		{
			++$relations_count;
			$price_params[$ColumnsArray['field_type']] = $ColumnsArray['field_number'] - 1;
		}

		if ($relations_count <= 0)
		{
			$ResponseArray[] = "Не настроены колонки прайса поставщика";
			return view('inventory.modal.priceimportresult', compact('ResponseArray'));
		}

		ob_start();
		
		if ($provider_params["column_separator"] == "")
		{
			$ResponseArray[] = "Не указан разделитель колонок";
			return view('inventory.modal.priceimportresult', compact('ResponseArray'));
		}
		if ($provider_params["column_separator"] == "")
		{
			$ResponseArray[] = "Разделитель колонок <b>" . $provider_params["column_separator"] . "</b> пустой. ";
			return view('inventory.modal.priceimportresult', compact('ResponseArray'));

		}
		if (trim($provider_params["file_path"]) == "")
		{
			$ResponseArray[] = "Путь к файлу прайса<b>" . $provider_params["file_path"] . "</b> пустой. ";
			return view('inventory.modal.priceimportresult', compact('ResponseArray'));
		}

		ini_set("auto_detect_line_endings", true);
		ini_set("allow_url_fopen", true);
		if (!(ini_get("allow_url_fopen")))
		{
			return view('inventory.modal.priceimportresult', compact('ResponseArray'));
		}
		set_time_limit(3600);

		$arFPURL = parse_url($provider_params["file_path"]);
		$FileExtension = Str::lower(pathinfo($arFPURL["path"], PATHINFO_EXTENSION));

		/* checking remote/local file */
		if ($provider_params["remote"] == "Local")
		{
			//Local price
			$FileLocation = "Local";
			$provider_params["file_path"] = "../storage/app/prices/" . $provider_params["file_path"];
			if (file_exists($provider_params["file_path"]))
			{
				$ResponseArray[] = "Файл " . $provider_params["file_path"] . " существует на сервере";

			}
			else
			{
				$ResponseArray[] = "Файл " . $provider_params["file_path"] . "  не существует на сервере";
			}
		}
		else
		{
			//Remote price
			$FileLocation = "Remote";
			$ch = curl_init($provider_params["file_path"]);
			curl_setopt($ch, CURLOPT_NOBODY, true);
			curl_exec($ch);
			$HeadersArray = curl_getinfo($ch);
			curl_close($ch);
			if ($HeadersArray["http_code"] == 200)
			{
				if ($HeadersArray["content_type"] == "application/zip")
				{
					$FileExtension = "zip";
				}
				if ($HeadersArray["content_type"] == "application/x-rar-compressed" || $HeadersArray["content_type"] == "application/octet-stream")
				{
					$FileExtension = "zip";
				}
				$ResponseArray[] = "File <a href=\"" . $provider_params["file_path"] . "\">" . $provider_params["file_path"] . "</a> <b>exist on Remote</b> server";
			}
			else
			{
				// return redirect('inventory/providers')->withError('File <b>' . $provider_params["file_path"] . '</b> - is not exist on Remote server');
				$ResponseArray[] = "File <a href=\"" . $provider_params["file_path"] . "\">" . $provider_params["file_path"] . "</a> <b>does not 1exist on Remote</b> server";
				return view('inventory.modal.priceimportresult', compact('ResponseArray'));
			}
		}
		/* file convertation */
		if ($FileExtension == "zip")
		{
			if (trim($provider_params["file_name"]) != "")
			{
				$NewFile = "../storage/app/prices/temp.zip";
				$Bytes = file_put_contents($NewFile, fopen($provider_params["file_path"], "r"));
				$MbSize = round($Bytes / 1024 / 1024, 2);
				if ($FileLocation == "Remote")
				{
					$ResponseArray[] = "Downloaded <b>" . $MbSize . " Mb</b> from <a href=\"" . $provider_params["file_path"] . "\">" . $provider_params["file_path"] . "</a> to /downloads/temp.zip";
					$FileLocation = "Local";
				}
				else
				{
					if ($FileLocation == "Local")
					{
						$ResponseArray[] = "Copyed <b>" . $MbSize . " Mb</b> from " . $provider_params["file_path"] . " to <b>downloads/temp.zip</b>";
					}
				}
				$FPath = pathinfo(realpath($NewFile), PATHINFO_DIRNAME);
				$obZip = new ZipArchive();
				$ZRes = $obZip->open($NewFile);
				if ($provider_params["file_password"] != "")
				{
					if (5.600000 < phpversion())
					{
						$provider_code = $obZip->setPassword($provider_params["file_password"]);
					}
					else
					{
						$ZRes = false;
						// return redirect('inventory/providers')->withError('To UnZip <b>password protected</b> files you need <b>PHP >=5.6</b>');
						$ResponseArray = 'To UnZip <b>password protected</b> files you need <b>PHP >=5.6</b>';
						return view('inventory.modal.priceimportresult', compact('ResponseArray'));
					}
				}
				if ($ZRes === true)
				{
					$obZip->extractTo($FPath);
					$obZip->close();
					unlink($NewFile);
					$ResponseArray[] = "<b>ZIP</b> file extracted to <b>downloads/</b>";
					if (file_exists("../storage/app/prices/" . $provider_params["file_name"]))
					{
						$ResponseArray[] = "" . $provider_params["file_name"] . "</b> is founded and extracted";
						$provider_params["file_path"] = "../storage/app/prices/" . $provider_params["file_name"];
					}
					else
					{
						// return redirect('inventory/providers')->withError('File <b>' . $provider_params["file_name"] . '</b> is not exist in ZIP');
						$ResponseArray = 'File <b>' . $provider_params["file_name"] . '</b> is not exist in ZIP';
						return view('inventory.modal.priceimportresult', compact('ResponseArray'));
					}
				}
				else
				{
					$ResponseArray = 'Cant UnZip file <b>' . $NewFile . '</b>';
					return view('inventory.modal.priceimportresult', compact('ResponseArray'));
				}
			}
			else
			{
				// return redirect('inventory/providers')->withError('<b>file_name</b> - not set');
				$ResponseArray = '<b>File name</b> - not set';
				return view('inventory.modal.priceimportresult', compact('ResponseArray'));
			}
		}					
		if ($FileExtension == "rar")
		{
			if (trim($provider_params["file_name"]) != "")
			{
				if (extension_loaded("rar"))
				{
					$NewFile = "../storage/app/prices/temp.rar";
					$Bytes = file_put_contents($NewFile, fopen($provider_params["file_path"], "r"));
					$MbSize = round($Bytes / 1024 / 1024, 2);
					if ($FileLocation == "Remote")
					{
						$ResponseArray[] = "Downloaded <b>" . $MbSize . " Mb</b> from <a href=\"" . $provider_params["file_path"] . "\">" . $provider_params["file_path"] . "</a> to /downloads/temp.rar";
						$FileLocation = "Local";
					}
					else
					{
						if ($FileLocation == "Local")
						{
							$ResponseArray[] = "Copyed <b>" . $MbSize . " Mb</b> from " . $provider_params["file_path"] . " to <b>downloads/temp.rar</b>";
						}
					}
					if ($rar = @rar_open(realpath($NewFile), $provider_params["file_password"]))
					{
						if ($entry = @rar_entry_get($rar, $provider_params["file_name"]))
						{
							if (@$entry->extract("../storage/app/prices/"))
							{
								rar_close($rar);
								unlink($NewFile);
								$provider_params["file_path"] = "downloads/" . $provider_params["file_name"];
								$ResponseArray[] = "" . $provider_params["file_name"] . "</b> is founded.";
							}
							else
							{
								// return redirect('inventory/providers')->withError('Failed to extract RAR - missing/wrong <b>PASSWORD</b> or bad data');
								$ResponseArray[] = 'Failed to extract RAR - missing/wrong <b>PASSWORD</b> or bad data';
								return view('inventory.modal.priceimportresult', compact('ResponseArray'));
							}
						}
						else
						{
							// return redirect('inventory/providers')->withError('Failed to find <b>' . $provider_params["file_name"] . '</b> in RAR');
							$ResponseArray[] = 'Failed to find <b>' . $provider_params["file_name"] . '</b> in RAR';
							return view('inventory.modal.priceimportresult', compact('ResponseArray'));
						}
					}
					else
					{
						// return redirect('inventory/providers')->withError('Cant open <b>' . $NewFile . '</b>');
						$ResponseArray[] = 'Cant open <b>' . $NewFile . '</b>';
						return view('inventory.modal.priceimportresult', compact('ResponseArray'));
					}
				}
				else
				{
					// return redirect('inventory/providers')->withError('PHP extension <b>php_rar.dll</b> is not installed!');
					$ResponseArray[] = 'PHP extension <b>php_rar.dll</b> is not installed!';
					return view('inventory.modal.priceimportresult', compact('ResponseArray'));
				}
			}
			else
			{
				// return redirect('inventory/providers')->withError('<b>file_name</b> - not set');
				$ResponseArray[] = '<b>File name</b> - not set';
				return view('inventory.modal.priceimportresult', compact('ResponseArray'));
			}
		}
		$FileExtension = Str::lower(pathinfo($provider_params["file_path"], PATHINFO_EXTENSION));
		if ($FileLocation == "Remote")
		{
			$NewFile = "downloads/temp." . $FileExtension;
			$Bytes = file_put_contents($NewFile, fopen($provider_params["file_path"], "r"));
			$MbSize = round($Bytes / 1024 / 1024, 2);
			$ResponseArray[] = "Downloaded <b>" . $MbSize . " Mb</b> from <a href=\"" . $provider_params["file_path"] . "\">" . $provider_params["file_path"] . "</a> to /" . $NewFile . "";
			$provider_params["file_path"] = $NewFile;
		}
		if ($FileExtension == "xlsx" || $FileExtension == "xls")
		{
			$ResponseArray[] = "Конвертируем " . $provider_params["file_name"] . " в формат CSV. Лимит памяти PHP:" . (int)ini_get("memory_limit") . " Mb</b>";
			
			// flush();//error redirecting without converting
			if ($FileLocation == "Remote")
			{
				$fileType = IOFactory::identify($provider_params["file_path"]);
			}
			if ($FileLocation == "Local")
			{
				$fileType = IOFactory::identify($provider_params["file_path"]);
				
			}
			$objReader = IOFactory::createReader($fileType);
			$objReader -> setReadDataOnly(true);
			$objPHPExcel = $objReader -> load($provider_params["file_path"]);
			# WRITECSV
			$objWriter = new \PhpOffice\PhpSpreadsheet\Writer\Csv($objPHPExcel);
			$objWriter -> setDelimiter($provider_params["column_separator"]);
			$objWriter -> setEnclosure("");//double Enclosure error
			$objWriter -> setUseBOM(true);
			$provider_params["file_path"] = str_replace("." . $FileExtension, ".csv", $provider_params["file_path"]);
			$objWriter -> save($provider_params["file_path"]);
			$ResponseArray[] = "Конвертируем файл ." . $FileExtension . " в .csv";
			$ResponseArray[] = "Пиковое использование памяти: " . memory_get_peak_usage(true) / 1024 / 1024 . " Mb";
			$ResponseArray[] = "Текущее использование памяти: " . memory_get_usage(true) / 1024 / 1024 . " Mb";
			$FileExtension = "csv";
		}
		if ($FileExtension == "csv" || $FileExtension == "txt")
		{
			$ResponseArray[] = "Размер файла " . $provider_params["file_path"] . " " . round(filesize($provider_params["file_path"]) / 1024 / 1024, 2) . " Mb";
		}
		else
		{
			// return redirect('inventory/providers')->withError('Unsupported file extension <b>' . $FileExtension . '</b>');
			$ResponseArray[] = 'Unsupported file extension <b>' . $FileExtension . '</b>';
			return view('inventory.modal.priceimportresult', compact('ResponseArray'));
		}

		if($provider_params["file_path"] != "")
		{
			ini_set("memory_limit", "512M");
			if ($arCFile = file($provider_params["file_path"]))
			{
				$CSVcount = count($arCFile);
				if ($provider_params["start_from"] < 2)
				{
					$provider_params["start_from"] = 0;
				}
				else
				{
					--$provider_params["start_from"];
				}
				if ($provider_params["start_from"] < $CSVcount)
				{
					if ($CSVcount < $provider_params["stop_before"] || $provider_params["stop_before"] == 0)
					{
						$provider_params["stop_before"] = $CSVcount;
					}
					$ResponseArray[] = "" . $CSVcount . " записей в фале CSV " . $provider_params["file_path"] . "";
					$PriceTime = Functions::SetPriceDate();
					$StatisticsArray = [];
					$VFArray = [];
					$arInsDupl = ["article", "provider_product_name", "brand", "price", "currency", "available", "options", "date"];
					$LogicOptionsArray = ["used", "restored", "damaged", "noreturn", "copy", "hot"];
					$arIntvOps = ["set", "weight", "percentgive", "minimum"];
					$arLngs = ["article" => 32, "provider_product_name" => 128, "brand" => 32, "provider" => 32, "stock" => 32, "options" => 64, "provider_code" => 32];
					$limit = 1000;
					if ($provider_params["delete_on_start"] == "Yes")
					{
						$DeletedOld = ProviderPrice::where('provider_code', $provider_params["provider_code"])->delete();
						$ResponseArray[] = "Удалено старых цен " . $DeletedOld . " записей";
					}
					$OnePerc = ($provider_params["stop_before"] - $provider_params["start_from"]) / 100;
					$start = 0;
					$inserted = 0;
					$ignored = 0;
					$updated = 0;
					if(0 <= $start)
					{
						$TotalP = ceil($start / $OnePerc);
						$BxW = $TotalP * 7;
						$InW = ceil($inserted / $OnePerc * 7);
						$IgW = ceil($ignored / $OnePerc * 7);
					}
					else
					{
						session()->put('ImportData', []);
					}
					if (98 < $TotalP)
					{
						$TotalP = 100;
						$PRows = $CSVcount;
					}
					else
					{
						$PRows = $start + 1;
					}
					$ResponseArray[] = "Добавлено " . $inserted . " записей из CSV файла";
					$ResponseArray[] = "Проигнорировано " . $ignored . " записей из CSV файла";
					$ResponseArray[] = "Total(?) in CSV file " . intval($TotalP) . "";
					$ResponseArray[] = "Total(?) in CSV file " . $PRows . "";
					$ResponseArray[] = "Количество записей в 1% из CSV файла - " . $OnePerc . "";
					$LnNum = 0;
					$success = "N";
					foreach ($arCFile as $Line => $strLine)
					{
						if ($start <= 0 && $Line < $provider_params["start_from"])
						{
							continue;
						}
						if (0 < $start && $Line <= $start)
						{
							continue;
						}
						if ($provider_params["stop_before"] < $Line)
						{
							$success = "Y";
							break;
						}
						++$LnNum;
						$arCSVrow = explode($provider_params["column_separator"], $strLine);
						
						$FieldsArray = [];
						foreach ($price_params as $field_type => $field_number)
						{
							$FieldsArray[$field_type] = trim($arCSVrow[$field_number]);
						}
						if ($provider_params["article_brand_separator"] != "" && $FieldsArray["article_brand"] != "")
						{
							$ArticleBrandArray = explode($provider_params["article_brand_separator"], $FieldsArray["article_brand"]);
							if (1 < count($ArticleBrandArray))
							{
								if ($provider_params["article_brand_side"] == "Left")
								{
									$FieldsArray["article"] = $ArticleBrandArray[0];
									list(, $FieldsArray["brand"]) = $ArticleBrandArray;
								}
								else
								{
									if ($provider_params["article_brand_side"] == "Right")
									{
										list(, $FieldsArray["article"]) = $ArticleBrandArray;
										$FieldsArray["brand"] = $ArticleBrandArray[0];
									}
								}
							}
							else
							{
								++$StatisticsArray["wrong_article_brand_separator"];
							}
							unset($FieldsArray["article_brand"]);
						}
						if ($provider_params["price_encoding"] != "UTF-8")
						{
							if (isset($FieldsArray["provider_product_name"]))
							{
								try
								{
									$FieldsArray["provider_product_name"] = iconv($provider_params["price_encoding"], "UTF-8//TRANSLIT", $FieldsArray["provider_product_name"]);
								}
								catch (Throwable $e)
								{
									Log::error($e->getMessage());
									Log::warning($FieldsArray["provider_product_name"]);
								}
							}
							if(isset($FieldsArray["brand"]))
							{
								$FieldsArray["brand"] = iconv($provider_params["price_encoding"], "UTF-8//TRANSLIT", $FieldsArray["brand"]);
							}
							if(isset($FieldsArray["article"]))
							{
								$FieldsArray["article"] = iconv($provider_params["price_encoding"], "UTF-8//TRANSLIT", $FieldsArray["article"]);
							}
							if(isset($FieldsArray["day"]))
							{
								$FieldsArray["day"] = iconv($provider_params["price_encoding"], "UTF-8//TRANSLIT", $FieldsArray["day"]);
							}
							if(isset($FieldsArray["available"]))
							{
								$FieldsArray["available"] = iconv($provider_params["price_encoding"], "UTF-8//TRANSLIT", $FieldsArray["available"]);
							}
							if(isset($FieldsArray["stock"]))
							{
								$FieldsArray["stock"] = iconv($provider_params["price_encoding"], "UTF-8//TRANSLIT", $FieldsArray["stock"]);
							}
						}
						//test for unfilled parameters++
						if(!isset($FieldsArray["brand"]))
						{
							$FieldsArray["brand"] = $provider_params["default_brand"];
						}
						if(!isset($FieldsArray["currency"]))
						{
							$FieldsArray["currency"] = $provider_params["price_currency"];
						}
						if(!isset($FieldsArray["available"]))
						{
							$FieldsArray["available"] = $provider_params["default_available"];
						}
						if(!isset($FieldsArray["stock"]))
						{
								$FieldsArray["stock"] = $provider_params["default_stock"];
						}

						//test for unfilled parameters-
						//double quotes
						$FieldsArray["brand"] = str_replace("\"", "", $FieldsArray["brand"]);
						$FieldsArray["brand"] = Str::upper($FieldsArray["brand"]);// brand name to uppercase
						$FieldsArray["price"] = str_replace("\"", "", $FieldsArray["price"]);
						$FieldsArray["price"] = str_replace(" ", "", $FieldsArray["price"]);
						$FieldsArray["price"] = str_replace(",", ".", $FieldsArray["price"]);
						$FieldsArray["price"] = floatval($FieldsArray["price"]);
						//double quotes
						$FieldsArray["provider"] = $provider_params["name"];
						$FieldsArray["provider_code"] = $provider_params["provider_code"];
						$FieldsArray["date"] = $PriceTime;			
						$FieldsArray["type"] = $provider_params["price_type"];

						$FieldsArray["src"] = floatval($FieldsArray["price"]);
						$FieldsArray["src"] = str_replace(",", ".", $FieldsArray["src"]);
						$FieldsArray["percentgive"] = $provider_params["percentgive"];//percentgive

						foreach ($arLngs as $LField => $Lng)
						{
							if(isset($FieldsArray[$LField]))
							{
								if (!($Lng < mb_strlen($FieldsArray[$LField], "UTF-8")))
								{
									continue;
								}
								$FieldsArray[$LField] = mb_substr(trim($FieldsArray[$LField]), 0, $Lng, "UTF-8");
							}
							else
							{
								$FieldsArray[$LField] = "";
							}
						}
						$FieldsArray["bkey"] = Functions::SingleKey($FieldsArray["brand"], true);
						$FieldsArray["akey"] = Functions::SingleKey($FieldsArray["article"]);
						$FieldsArray["provider_product_name"] = Functions::ClearName($FieldsArray["provider_product_name"]);
						$OptionsArray = [];
						//percentgive
						if (isset($FieldsArray["percentgive"]))//percentgive
						{
							if (!is_null($FieldsArray["percentgive"]))
							{
								$OptionsArray["percentgive"] = $FieldsArray["percentgive"];
							}
							unset($FieldsArray["percentgive"]);
						}
						//percentgive
						if (isset($FieldsArray["liters"]))
						{
							if ($FieldsArray["liters"] != "")
							{
								$OptionsArray["liters"] = floatval($FieldsArray["liters"]);
							}
							unset($FieldsArray["liters"]);
						}
						foreach ($arIntvOps as $LOp)
						{
							if (!(isset($FieldsArray[$LOp])))
							{
								continue;
							}
							if ($FieldsArray[$LOp] != "")
							{
								$OptionsArray[$LOp] = intval($FieldsArray[$LOp]);
							}
							unset($FieldsArray[$LOp]);
						}
						foreach ($LogicOptionsArray as $LOp)
						{
							if (!(isset($FieldsArray[$LOp])))
							{
								continue;
							}
							if ($FieldsArray[$LOp] != "")
							{
								$OptionsArray[$LOp] = 1;
							}
							unset($FieldsArray[$LOp]);
						}
						$FieldsArray["options"] = Functions::OptionsImplode($OptionsArray, $FieldsArray);
						if (isset($FieldsArray["day"]))
						{
							$FieldsArray["day"] = Functions::OnlyNumbers($FieldsArray["day"]);
						}
						else
						{
							$FieldsArray["day"] = 0;
						}
						$FieldsArray["available"] = Functions::OnlyNumbers($FieldsArray["available"]);
						if (9999 < $FieldsArray["available"])
						{
							$FieldsArray["available"] = 9999;
						}
						if ($provider_params["day_add"] != 0)
						{
							$FieldsArray["day"] = $FieldsArray["day"] + $provider_params["day_add"];
						}
						if (9999 < $FieldsArray["day"])
						{
							$FieldsArray["day"] = 9999;
						}
						if (0 < $provider_params["min_availability"] && $FieldsArray["available"] < $provider_params["min_availability"])
						{
							++$ignored;
							continue;
						}
						if (0 < $provider_params["max_day"] && $provider_params["max_day"] < $FieldsArray["day"])
						{
							++$ignored;
							continue;
						}
						if ($provider_params["consider_hot"] != 1 || $OptionsArray["hot"] != 1)
						{
							if ($provider_params["price_extra"] != 0)
							{
								$FieldsArray["price"]					= (($provider_params["price_extra"] + 100) * $FieldsArray["price"]) / 100;
								// $FieldsArray["price"]					= ceil($FieldsArray["price"]);
								// $FieldsArray["price"]					= ceil($FieldsArray["price"] / 50) * 50;
								$FieldsArray["price"]					= Functions::priceRounding($FieldsArray["price"]);
							}
						}
						$FieldsArray["price"] = round($FieldsArray["price"], 2);
						if (1 < strpos($FieldsArray["price"], "."))
						{
							$FieldsArray["price"] = substr($FieldsArray["price"], 0, strpos($FieldsArray["price"], ".", 0) + 3);
						}
						if (0 < $provider_params["price_add"])
						{
							$FieldsArray["price"] = $FieldsArray["price"] + $provider_params["price_add"];
						}
						$FieldsArray["price"] = str_replace(",", ".", $FieldsArray["price"]);
						$FieldsArray["article"] = str_replace("\"", "", $FieldsArray["article"]);
						$FieldsArray["article"] = str_replace("'", "", $FieldsArray["article"]);
						$FieldsArray["article"] = str_replace(" ", "", $FieldsArray["article"]);//убираем пробелы в номере по кат.
						$FieldsArray["article"] = Str::upper($FieldsArray["article"]);
						//pkey
						$FieldsArray["pkey"] = Functions::SingleKey($FieldsArray["brand"], true) . Functions::SingleKey($FieldsArray["article"]);
						
						//uid:bkey/akey/type/day/provider/stock
						$FieldsArray["uid"] = md5($FieldsArray["bkey"] . $FieldsArray["akey"] . $FieldsArray["type"] . $FieldsArray["day"] . $FieldsArray["provider"] . $FieldsArray["stock"]);
						
						$ViewFsArray = [];
						//проверка заполнения ключей, если они не соответствуют - загрузка пропускает все подряд	
						if ($FieldsArray["bkey"] != "" && $FieldsArray["akey"] != "" && 0 < $FieldsArray["price"])
						{
							// $prices = ProviderPrice::where('uid',$FieldsArray["uid"])->get()->first();
							$prices = ProviderPrice::where('uid',$FieldsArray["uid"])->get();
							$priceCount = count($prices);
							
							if($priceCount)
							{
								ProviderPrice::where('uid',$FieldsArray["uid"])->update($FieldsArray);
								++$updated;
							}
							else
							{

								ProviderPrice::insert($FieldsArray);
								if (count($ViewFsArray) < 20)
								{
									$ViewFsArray[] = $FieldsArray;
								}
								++$inserted;
							}
							$FieldsArray["N"] = $Line;
						}
						else
						{
							++$ignored;
						}

						if (!($limit <= $LnNum))
						{
							continue;
						}
					}
				}
				else
				{
					// return redirect('inventory/providers')->withError('Файл CSV: 0 активных записей');
					$ResponseArray[] = 'Файл CSV: 0 активных записей';
					return view('inventory.modal.priceimportresult', compact('ResponseArray'));
				}
			}
			else
			{
				// return redirect('inventory/providers')->withError('Function false <b>file(' . $provider_params["file_path"] . ')</b>');
				$ResponseArray[] = 'Function false <b>file(' . $provider_params["file_path"] . ')</b>';
				return view('inventory.modal.priceimportresult', compact('ResponseArray'));
			}
			// dd(compact('success'));
			// if ($success == "Y")
			// {
				$ResponseArray[] = "Импорт завершен";
				// return view('inventory.modal.priceimportresult')->json($ResponseArray);
				// return redirect('inventory/providers')->withError('Function false <b>file(' . $provider_params["file_path"] . ')</b>');
				return view('inventory.modal.priceimportresult', compact('ResponseArray'));
			// }
		}
		else
		{
			$ResponseArray[] = "Импорт завершен";
			// return view('inventory.modal.priceimportresult')->json($ResponseArray);
			return view('inventory.receipts.priceimportresult', compact('ResponseArray'));

		}
	}
	
	public function import_crosses(Request $request)
	{
		
	}
}