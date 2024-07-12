<?php

////////
use App\Models\Product\ProductCross;
use App\Models\Inventory\ProviderPrice;
use App\Models\Webservice\Webservice;
use App\Models\Product\ProductRating;

use App\Http\Controllers\Tecdoc\TecdocController;
use App\Http\Controllers\FunctionsController as Functions;
use App\Http\Controllers\WSController;
use App\Http\Controllers\Prices;
//////////

mb_internal_encoding("UTF-8");
$PartPropertiesArray = [];
$ResultArray["all_brands"] = [];
$ResultArray["parts_count"] = 0;
$ResultArray["all_brands_letters"] = [];
$ResultArray["all_brands_count"] = 0;
$ResultArray["filtered_properties_count"] = 0;

if(count($partsNoPArray) > 0)
{
	//Crosses
	/////////////////////////////
	$LinksCnt = 0;
	$CrRNum = 0;
	$CrLNum = 0;
	//настройка поиска в кроссах сайта
	//если ее выключить то не будет обрабатываться никакой из дополнительных каталогов
	//таблица crosses - start
	if(config('tecdoc_config.hide_analogs_of_analogs') == 1 AND isset($SrPKEYc) AND $SrPKEYc != "")
	{
		$arSrCrParts[$SrPKEYc] = [];
	}
	else
	{
		$arSrCrParts = $partsNoPArray;
	}
	$cpk = 0;
	$PNumb = 0;
	foreach($arSrCrParts as $pkey=>$TPartArray)
	{
		$arPKEY_LIST[] = $pkey;
		$arCrPK[$cpk][] = '"'.$pkey.'"';
		$PNumb++;
		if($PNumb > 30)
		{
			$cpk++;
			$PNumb = 0;
		}
	}

	//поиск в кроссах сайта
	foreach($arCrPK as $cpk=>$arPKEYs)
	{
		$PKEYs = implode(',',$arPKEYs);
		$PKyCnt = 0;
		
		$LinksRequest = [];
		$Cross = ProductCross::whereIn('akey1', [$PKEYs])->orWhereIn('akey2', [$PKEYs])->get();
		if($Cross)
		{
			$LinksRequest = $Cross->toArray();
		}
		foreach($LinksRequest as $LinkArray)
		{
			if(in_array($LinkArray["pkey1"],$arPKEY_LIST))
			{
				$LinkArray["EXISTS_1"]=true;
				$CrLable='2';
			}
			if(in_array($LinkArray["pkey2"],$arPKEY_LIST))
			{
				$LinkArray["EXISTS_2"]=true;
				$CrLable='1';
			}
			if($LinkArray["EXISTS_1"] AND $LinkArray["EXISTS_2"])
			{
				//Эта крос запись дуюлирует TecDoc - удалить её...
				continue;
			}
			$CrRNum++;
			if($LinkArray["side"]==1)
			{
				$SLable='&#8594;';
				if($CrLable=='1')
				{
					//Если только ВПРАВО
					continue;
				}
			}
			elseif($LinkArray["side"]==2)
			{
				$SLable='&#8592;';
				if($CrLable=='2')
				{
					//Если только ВЛЕВО
					continue;
				}
			}
			else
			{
				$SLable='&#8596;';
			}
			$partsNoPArray[$LinkArray["pkey".$CrLable]] = [
				"pkey"=>$LinkArray["pkey".$CrLable],
				"bkey"=>$LinkArray["bkey".$CrLable],
				"brand"=>$LinkArray["bkey".$CrLable], //As default
				"akey"=>$LinkArray["akey".$CrLable],
				"article"=>$LinkArray["akey".$CrLable], //As default
				"link_side"=>$LinkArray["side"],//сторона кросса по таблице кроссов
				"link_code"=>$LinkArray["code"],
				"link_info"=>'<b>' . $LinkArray["bkey1"] . '</b> ' . $LinkArray["akey1"] . ' ' . $SLable . ' <b>' . $LinkArray["bkey2"] . '</b> ' . $LinkArray["akey2"],//для всплывающей подсказки, потом уберем
				"img_src" => "/images/logomedia/" . $LinkArray["bkey" . $CrLable] . ".webp"];//картинка
		}
	}
	//таблица crosses - finish
	$LinksCnt = $CrRNum + $CrLNum;	

	//поиск в вебсервисах поставщиков
	//ищет только то что кэшируется в настройках поиска
	//и только по активным поставщиках
	//Webservers (CAHCE)
	/////////////////////////WS
	$WSWS = Provider::where('cache','=', "1")->where('hasprice','=', "Webservice")->where('active','=', "1")->get();
	if ($WSWS)
	{
		$WSWS = $WSWS->toArray();
		if(isset($TYP_ID) && isset($SUB_SEC_ID))
		{
			$SID = $TYP_ID.$SUB_SEC_ID;
		}
		else
		{
			$SID = "";
		}
		if(isset($S_BRAND) && isset($S_ARTICLE))
		{
			$pkey = $S_BRAND.$S_ARTICLE;
		}
		else
		{
			$pkey = "";
		}
		if(isset($arWSP) AND is_array($arWSP) AND count($arWSP)>0)
		{
			$arWSPartsActual = $arWSP;
		}
		else
		{
			$arWSPartsActual = $partsNoPArray;
		}
		$WS = new WSController();
		$WS->SearchPrices($arWSPartsActual,[],["cache_mode"=>true, "links_take" => "ON", "sid"=>$sid, "pkey"=>$pkey]); //Сработают только WS с включенным кэшированием
		if(count($WS->arNewCrosses)>0)
		{
			foreach($WS->arNewCrosses as $NewCrPKEY=>$arNewCr)
			{
				$partsNoPArray[$NewCrPKEY] = $arNewCr;
			}
		}
	}
	
	//Настройки сортировки
	//это сотрировка которая на страницах поиска
	//из за того что не все корректно - не все сортировки работают
	//в какой-то дохнет
	///////////////////////////
	if(!$request->session()->has('search_sorting') OR ($request->session()->get('search_sorting')==null))
	{
		$request->session()->put('search_sorting', config('tecdoc_config.search_sorting'));
	}
	if ($request->has('sort'))
	{
		$arAvailSortModes = array(1, 2, 3, 4, 5);
		if (in_array($request->sort, $arAvailSortModes))
		{
			$request->session()->put('search_sorting', $request->sort);
		}
	}
	$ResultArray["sort"] = $request->session()->get('search_sorting');
	
	//Получение цен из таблицы прайсов массивом по всем ключам
	/////////////////////////////
	$ResultArray["prices"] = [];
	if(count($partsNoPArray)>0)
	{
		$i = 0;
		foreach($partsNoPArray as $TPartArray)
		{
			$q = ProviderPrice::where('pkey',$TPartArray["pkey"])->orderBy('price');
				if($i < 1)
				{
					$PrcsSQL = $q;
				}
				else
				{
					$PrcsSQL->union($q);
				}
			$i = $i + 1;
		}
		//сортировка прайса по запросу из фронта
		if($ResultArray["sort"] == 1)
		{
			$PrcsSQL->orderBy('price');
		}
		elseif($ResultArray["sort"] == 2)
		{
			$PrcsSQL->orderBy('day');
		}
		else
		{
			$PrcsSQL->orderBy('available');
		}
		/////////////////////
		if($PrcsSQL)
		{
			$ProvidersPrices = $PrcsSQL->get()->toArray();
		}
		$arNmC = [];
		$MinDaysArray = [];
		$MaxAvailableArray = [];
		$MinPricesArray = [];
		$ResultArray['ab_min_price'] = [];
		$ResultArray['ab_min_price_f'] = [];
		//скрытие товара без наличия
		foreach($ProvidersPrices as $PriceArray)
		{
			if(config('tecdoc_config.hide_prices_noavail')==1 AND $PriceArray["available"]<1)
			{
				continue;
			}
			$PrPKey = $PriceArray["bkey"].$PriceArray["akey"];
			if(trim($PriceArray["provider_product_name"])!="")
			{
				//Clear TecDoc default name
				//Удалаяется название текдок и заменяется на название из прайса
				if(!in_array($PrPKey,$arNmC))
				{
					$partsNoPArray[$PrPKey]["name"] = "";
					$arNmC[] = $PrPKey;
				}
				//Longest name of prices records
				if(strlen($partsNoPArray[$PrPKey]["name"]) < strlen($PriceArray["provider_product_name"]))
				{
					$partsNoPArray[$PrPKey]["name"] = $PriceArray["provider_product_name"];
				}
			}

			$PriceArray = Functions::FormatPrice($PriceArray);//форматирование цены
			
			$ResultArray["prices"][$PrPKey][] = $PriceArray;
			//my counter undefied index error fix
			if(isset($partsNoPArray[$PrPKey]["prices_count"]))
			{
				$partsNoPArray[$PrPKey]["prices_count"]++;
			}
			else
			{
				$partsNoPArray[$PrPKey]["prices_count"] = 0;
			}
			//error fix end
			
			//Maximal avail for sorting
			//здесь не все поля заполняются - почему - ненашел
			//изза этого не работает сортировка которые выше
			// if($MaxAvailableArray[$PrPKey]==0 OR $PriceArray['available']>$MaxAvailableArray[$PrPKey]){$MaxAvailableArray[$PrPKey]=$PriceArray['available'];}//initial
			if(!isset($MaxAvailableArray[$PrPKey]) OR $PriceArray['available'] > $MaxAvailableArray[$PrPKey])
			{
				$MaxAvailableArray[$PrPKey] = $PriceArray['available'];
			}

			// if($MinPricesArray[$PrPKey]==0 OR $PriceArray['price_converted']<$MinPricesArray[$PrPKey]){$MinPricesArray[$PrPKey]=$PriceArray['price_converted'];}//initial
			if(!isset($MinPricesArray[$PrPKey]) OR $PriceArray['price_converted'] < $MinPricesArray[$PrPKey])
			{
				$MinPricesArray[$PrPKey] = $PriceArray['price_converted'];
			}
			
			//Minimal day for sorting
			$ItemDAY = intval($PriceArray['day']) + 1; //Что бы товары без цен были всёравно в конце даже если дней доставки =0
			if(!isset($MinDaysArray[$PrPKey]) OR $ItemDAY<$MinDaysArray[$PrPKey])
			{
				$MinDaysArray[$PrPKey] = $ItemDAY;
			}
			//Brands min price
			if(!isset($ResultArray['ab_min_price'][$PriceArray['bkey']]) OR $ResultArray['ab_min_price'][$PriceArray['bkey']]>$PriceArray['price_converted'])
			{
				$ResultArray['ab_min_price'][$PriceArray['bkey']] = $PriceArray['price_converted'];
				$ResultArray['ab_min_price_f'][$PriceArray['bkey']] = $PriceArray['price_converted'];
			}
		}
		unset($arNmC);
	}
	
	//Hide parts without prices
	/////////////////////////////
	if(config('tecdoc_config.hide_noprices')==1)
	{
		$ResultArray["hide_noprices"]='Y';
		$arPARTS_HdP = $partsNoPArray;
		$partsNoPArray=[];
		$arPAIDs_noP=[];
		foreach($arPARTS_HdP as $pkey=>$TPartArray)
		{
			if($TPartArray["prices_count"]>0)
			{
				$partsNoPArray[$pkey] = $TPartArray;
				//For criteria & images
				if($TPartArray["aid"]>0)
				{
					$arPAIDs_noP[] = $TPartArray["aid"];
				}
			}
			else
			{
				$HdWP++;
			}
		}
	}
	if(count($partsNoPArray)>0)
	{
		//ФИЛЬТРЫ - setup
		/////////////////////////////
		$ResultArray["letters_limit"] = config('tecdoc_config.filter_brands_letters_limit');//это количество брендов, выводимых в фильтр, для сворачиваемой видимости
		$ResultArray["show_filter_brands"] = config('tecdoc_config.show_filter_brands');//вкл/выкл отображение фильтров
		$ResultArray["filtered_brands"] = [];//массив брендов которые при фильтрации исключаются из отображения
		$ResultArray["filter_is_applyed"] = false;//применен или нет фильтр
		//Сброс фильтра: 1) если перешли в другой раздел 2) если нажали кнопку сброса
		//исходное условие - давало ошибку при выводе
		// if(($_SESSION["LIST_FILTER_SECTION"]!=strtok($_SERVER["REQUEST_URI"],'&')) OR ($_REQUEST["FilterProp"]=='Action' AND $_REQUEST["FilterValue"]=='Reset') )
		//замененное условие - не дает ошибку - но и не работает
		//здесь - я так понимаю создаются по request запросу массивы фильтрации в сессии
		//а чтоб фильтр не зависал на остальных страницах - еще и записывается uri
		//по моему - надо просто добавить массивы в сессию - и потом кидать туда значения
		//чтоб было меньше глюков, и делать проверку только на соответствие запрошенной ссылки и проверки наличия/отсутствия фильтрации
		if(($request->session()->get('LIST_FILTER_SECTION') != strtok($_SERVER["REQUEST_URI"],'&')) OR ($request["FilterProp"]=='Action' AND $request["FilterValue"]=='Reset'))
		// if(($request->session()->get('LIST_FILTER_SECTION') != strtok($_SERVER["REQUEST_URI"],'&')) OR ($request->has('FilterProp"]=='Action' AND $_REQUEST["FilterValue"]=='Reset'))
		{
			// $_SESSION["LIST_FILTER_SECTION"] = strtok($_SERVER["REQUEST_URI"],'&');//я так понимаю адрес фильтруемой страницы
			$request->session()->put('LIST_FILTER_SECTION', strtok($_SERVER["REQUEST_URI"],'&'));
			// $_SESSION["list_filter_brands"] = [];//список отфильтрованых брендов
			$request->session()->put('list_filter_brands', []);
			// $_SESSION["list_filter_props"] = [];//список отфильтрованных свойств
			$request->session()->put('list_filter_props', []);
			// $_SESSION["list_filter_fixed"] = "";//какой то фикс в исходной версии
			$request->session()->put('list_filter_fixed', "");
		}
		//ФИЛЬТР : БРЕНД
		/////////////////////////////
		//вывод массива брендов для фильтра и счетчик запчастей с таким брендом
		foreach($partsNoPArray as $pkey=>$TPartArray)
		{
			//Убрать с фильтра по брендам ПЕРВУЮ запчасть
			if(!isset($arFirstProduct))
			{
				$arFirstProduct = $TPartArray;
				continue;
			}
			
			//твой фикс для счетчиков
			$ResultArray["all_brands"][$TPartArray["bkey"]] = $TPartArray["brand"];
			if (isset($ResultArray["brands_parts_count"][$TPartArray["brand"]]))
			{
				$ResultArray["brands_parts_count"][$TPartArray["brand"]]++;
			}
			else
			{
				$ResultArray["brands_parts_count"][$TPartArray["brand"]] = 1;
			}
		}
		
		$ResultArray["all_brands_count"] = count($ResultArray["all_brands"]);
		//старт фильтрования - там ajax
		//проверка включеной фильтрации по бренду и поиск этого бренда по массиву брендов
		//так же здесь проверки - какие кнопки нажали
		//и соответственно пересортировка массива с удалением выводимых брендов по фильтру
		if($request['FilterProp'] && $request['FilterProp']=='Brand' AND array_key_exists($request["FilterValue"],$ResultArray["all_brands"]))
		{
			// if(!in_array($_REQUEST["FilterValue"],$_SESSION["list_filter_brands"]))
			if(!in_array($request["FilterValue"],$request->session()->get("list_filter_brands")))
			{
				// $_SESSION["list_filter_brands"][] = $_REQUEST["FilterValue"];
				$request->session()->push("list_filter_brands", $request["FilterValue"]);
			}
			elseif($_REQUEST["FilterValue"]=='Clear_Brands')
			{
				// $_SESSION["list_filter_brands"]=[];
				$request->session()->put('list_filter_brands',[]);
			}
			else
			{
				// $DelBKEY = array_search($_REQUEST['FilterValue'],$_SESSION['LIST_FILTER_BRANDS']);
				$DelBKEY = array_search($request["FilterValue"],$request->session()->get('list_filter_brands'));
				$request->session()->forget('list_filter_brands.' . $DelBKEY);
			}
		}
		//фильтрация по критериям
		$arPAIDs_AppCrit_noP = $arPAIDs_noP;
		// if(isset($_SESSION['LIST_FILTER_BRANDS']) AND count($_SESSION['LIST_FILTER_BRANDS'])>0)
		if($request->session()->has("list_filter_brands") AND count($request->session()->get("list_filter_brands"))>0)
		{
			//Apply filter
			$arPAIDs_AppCrit_noP = [];
			foreach($partsNoPArray as $pkey=>$TPartArray)
			{
				// if(!in_array($TPartArray['bkey'],$_SESSION['LIST_FILTER_BRANDS']))
				if(!in_array($TPartArray["bkey"],$request->session()->get("list_filter_brands")))
				{
					//Запомнить какие запчасти удалены при филтрации по бренду
					$arParts_WOF[$pkey] = $TPartArray;
					$arParts_WOF[$pkey]["brand_filtered"] = 'Y';
					unset($partsNoPArray[$pkey]);
					$ResultArray["filter_is_applyed"] = true;
					// if(count($_SESSION["list_filter_props"])<=0)
					if(count($request->session()->get("list_filter_props"))<=0)
					{
						if(($PAKey = array_search($TPartArray["aid"],$arPAIDs_noP))!==false)
						{
							unset($arPAIDs_noP[$PAKey]);
						}
					}
				}
				else
				{
					$arPAIDs_AppCrit_noP[] = $TPartArray["aid"];
					$ResultArray["filtered_brands"][$TPartArray["bkey"]] = $TPartArray["brand"];
				}
			}
			$ResultArray["filtered_brands_count"] = count($ResultArray["filtered_brands"]);
		}
		
		$arPAIDs_noP_cnt = count($arPAIDs_noP);

		////////////////////////////////////////
		// Свойства - товары ВСЕ
		//"Fitting Position" - Сторона установки
		$arRenameProps = ['Supplementary Article/Supplementary Info'=>'options', 'Supplementary Article/Info 2'=>'options'];
		
		$arOnlyValueProps = [];
		$arHideFromAdmin = ['Weight [kg]','Weight [gr]','Weight [g]','for article number','Manufacturer Restriction','Organisation number from','Parameter','Inspection Tag',
					'Part number of recommended accessories','Technical Information Number','Thickness/Strength 1 [mm]','Height 1 [mm]','Thickness [mm]',
					'Width 1 [mm]','Height [mm]','WVA Number','Length 1/ Length 2 [mm]','Width 2 [mm]','Packaging length [cm]','Packaging width [cm]',
					'Height 2 [mm]','Packaging height [cm]','Thickness/Strength 2 [mm]','Length 1 [mm]','for OE number','Length 2 [mm]','Outer Length [mm]',
					'Paired article numbers','Diameter 1 [mm]','Diameter [mm]','Thread Size','Diameter 2 [mm]','Length 2 [mm]','Alternative Repair Kit'];
		//массив свойств
		$ResultArray["properties_name"] = [];
		//массив свойств товаров на конкретной странице
		$arPageItemProps = [];
		if($arPAIDs_noP_cnt > 0 AND config('tecdoc_config.SHOW_ITEM_PROPS')==1)
		{
			//НАСТРОЙКИ - Какие значения свойств переименовывать
			$_RenamePVPath = '../app/Http/Controllers/Catalog/components/rename-prop-values.php';
			if(file_exists($_RenamePVPath))
			{
				require($_RenamePVPath);
				if(!is_array($arRename_Prop_Values))
				{
					die('Error# $arRename_Prop_Values');
				}
			}
			else
			{
				die('rename-prop-values.php not exists!');
			}
			//НАСТРОЙКИ - Какие свойства показывать
			$_ShowPFPath = '../app/Http/Controllers/Catalog/components/showprops.php';
			require($_ShowPFPath);

			$arCridValues = [];
			$arCridValuesA = [];
			$arHIDDEN_PROPS = [];
			$ResultArray["items_properties_count"] = config('tecdoc_config.items_properties_count');
			// if(isset($arComSets['GET_ALL_properties_count']) AND intval($arComSets['GET_ALL_properties_count'])!=1){ $ResultArray['items_properties_count']=false; }else{ $ResultArray['items_properties_count']=true; }
			
			//Критерии применимости
			//это для вывода страницы запчастей для авто
			//которая начинается в sectionpartsController.php
			//проверяется наличие $TYP_ID - и если да - то это страница запчастей по модели авто
			// если нет - то это поиск по бренд/номерам
			//второй метод из SearchController.php
			$CritCnt = 0;
			if(isset($TYP_ID) && $TYP_ID>0)
			{
				$rsAppCrit = TecdocController::GetAppCriteriaUnion($arPAIDs_noP,$TYP_ID);
				foreach($rsAppCrit as $arAppCrit)
				{
					//aid, criteria, value
					if($arAppCrit["value"]!="")
					{
						//$arAppCrit["value"] = str_replace('&nbsp;',' ',$arAppCrit["value"]);
						if(mb_strtolower($arAppCrit["criteria"])=='место установки')
						{
							$CritCnt++;
							$PartPropertiesArray[] = [
								'aid' => $arAppCrit["aid"],
								'crid' => 100,
								'name' => 'Сторона установки',
								'en' => 'Fitting Position',
								'value' => $arAppCrit["value"]
							];
						}
						else
						{
							foreach($partsNoPArray as $pkey=>$TPartArray)
							{
								if($TPartArray["aid"]==$arAppCrit["aid"])
								{
									if (isset($partsNoPArray[$pkey]["criterias_count"]))
									{
										$partsNoPArray[$pkey]["criterias_count"]++;
									}
									else
									{
										$partsNoPArray[$pkey]["criterias_count"] = 1;
									}
									$CrKey = Functions::UWord($arAppCrit["criteria"]);
									$partsNoPArray[$pkey]["criterias"][$arAppCrit["criteria"]] = $arAppCrit["value"]; 
									//break;
								}
							}
						}
					}
				}
			}
			
			//СВОЙСТВА
			$rsProps = TecdocController::GetPropertiesUnion($arPAIDs_noP,$ResultArray["items_properties_count"]);
			$arPropsChecked = [];
			$arPpEnLng = [];
			$PropsRecords = 0;
			foreach($rsProps as $arProp)
			{
				//Может вернуть для 400 товаров 2500 свойств если включена привязка DISTINCT -> aid
				//одинаковые записи СВОЙСТВО:ЗНАЧЕНИЕ но с привязкой к другому aid артикула
				$PropsRecords++;
				// echo '<pre>'; print_r($arProp); echo '</pre>';
				$PartPropertiesArray[] = $arProp;
			}
			//properties error
			//вывод свойств на двух языках
			foreach($PartPropertiesArray as $arProp)
			{
				$arProp["value"] = trim($arProp["value"]);
				$arProp["value"] = mb_strtoupper(mb_substr($arProp["value"],0,1)).mb_substr($arProp["value"],1);
				if($arProp["value"]!="")
				{
					//На en языке разные названия - а на РУ одинаковые - это склеивает разные значения под одним названием
					if(!isset($arPpEnLng[$arProp["name"]]))
					{
						$arPpEnLng[$arProp["name"]] = $arProp["en"];
					}
					else
					{
						if($arPpEnLng[$arProp["name"]] != $arProp["en"])
						{
							$arProp["name"] = $arProp["en"];
						}
					}
					//Переименовать название СВОЙСТВА (и публично и для админа)
					if(array_key_exists($arProp["en"],$arRenameProps))
					{
						$arProp["name"] = $arRenameProps[$arProp["en"]];
						$arProp["en"] = $arRenameProps[$arProp["en"]];
					}
					//Переименовать название ЗНАЧЕНИЙ (и публично и для админа)
					if(array_key_exists($arProp["value"],$arRename_Prop_Values))
					{
						$arProp["value"] = $arRename_Prop_Values[$arProp["value"]];
					}
					$pCRID = $arProp["crid"];
					$pNAME = $arProp["name"];
					$pVALUE = $arProp["value"];
					//Для удобства
					$pEN = $arProp["en"];
					//ФИЛЬТР - Применить/Удалить
					if(isset($request["FilterProp"]))
					{
						$request["FilterProp"] = urldecode($request["FilterProp"]);
					}
					if(isset($request["FilterValue"]))
					{
						$request["FilterValue"] = urldecode($request["FilterValue"]);
					}
					if(mb_strtolower($request["FilterProp"]) == mb_strtolower($pNAME) 
						AND mb_strtolower($request["FilterValue"]) == mb_strtolower($pVALUE)
						AND !in_array($pNAME.$pVALUE, $arPropsChecked))
						{
							//Что бы не проверять больше такое же свойство которое уже обработалось
							$arPropsChecked[] = $pNAME . $pVALUE;
							// if(!isset($_SESSION["list_filter_props"][$pNAME]) OR !in_array($pVALUE,$_SESSION["list_filter_props"][$pNAME]))
							if(!isset($request->session()->get("list_filter_props")[$pNAME]) OR !in_array($pVALUE, $request->session()->get("list_filter_props")[$pNAME]))
							{
								//Если выбрали ДРУГОЕ значение из первого выбранного свойства - то сбросить весь фильтр
								// if($pNAME==$_SESSION["list_filter_fixed"] AND !in_array($pVALUE,$_SESSION["list_filter_props"][$pNAME]))
								if($pNAME == $request->session()->get("list_filter_fixed") AND !in_array($pVALUE, $request->session()->get("list_filter_props")[$pNAME]))
								{
									// $_SESSION["list_filter_props"] = [];
									$request->session()->put("list_filter_props", []);
								}
								// $_SESSION["list_filter_props"][$pNAME][] = $pVALUE;
								$request->session()->push("list_filter_props." . $pNAME, $pVALUE);
								// if(count($_SESSION["list_filter_props"])==1)
								if(count($request->session()->get("list_filter_props")) == 1)
								{
									//Для первого выбранного свойства "закрепить" все значения
									// $_SESSION["list_filter_fixed"] = $pNAME;
									$request->session()->put("list_filter_fixed", $pNAME);
								}
							}
							elseif($_REQUEST["FilterValue"]=='Clear_Brands')
							{
								// $_SESSION["list_filter_props"] = [];
								$request->session()->put("list_filter_props", []);
								// $_SESSION["list_filter_fixed"] = 0;
								$request->session()->put("list_filter_fixed", 0);
							}
							else
							{
								// if(isset($_SESSION["list_filter_props"][$pNAME]))
								if(isset($request->session()->get("list_filter_props")[$pNAME]))
								{
									// $DelPVKEY = array_search($pVALUE,$_SESSION["list_filter_props"][$pNAME]);
									$DelPVKEY = array_search($pVALUE,$request->session()->get("list_filter_props")[$pNAME]);
									// unset($_SESSION["list_filter_props"][$pNAME][$DelPVKEY]);
									$request->session()->forget('list_filter_brands.' . $pNAME . '.'. $DelPVKEY);
									//Удалить ключ crid если не осталось в нем значений свойства
									// if(count($_SESSION["list_filter_props"][$pNAME])<=0)
									if(count($request->session()->get("list_filter_props")[$pNAME]) <= 0)
									{
										// unset($_SESSION["list_filter_props"][$pNAME]);
										$request->session()->forget('list_filter_brands.' . $pNAME);
										// if($_SESSION["list_filter_fixed"] == $pNAME)
										if($request->session()->get("list_filter_fixed") == $pNAME)
										{
											// $_SESSION["list_filter_fixed"] = "";
											$request->session()->put("list_filter_fixed", "");
										}
									}
								}
							}
						}
						//Добавить в полный ФИЛЬТР
						if(in_array($arProp["en"],$arShowProps["en"]))
						{
							// if(!is_array($arCridValues[$pNAME]) OR !in_array($pVALUE,$arCridValues[$pNAME]))//original
							if(!isset($arCridValues[$pNAME])
								OR !array_key_exists($pNAME,$arCridValues)
									OR !in_array($pVALUE,$arCridValues[$pNAME]))
							{
								$arCridValues[$pNAME][] = $pVALUE;
								if(!isset($ResultArray["properties_name"][$arProp["name"]]["checked"]))
								{
									$ResultArray["properties_name"][$arProp["name"]]["checked"]=[];
								}
								// if(isset($_SESSION["list_filter_props"][$pNAME]))
								if(isset($request->session()->get("list_filter_props")[$pNAME]))
								{
									// $ResultArray["properties_name"][$arProp["name"]]["checked"] = $_SESSION["list_filter_props"][$pNAME];
									$ResultArray["properties_name"][$arProp["name"]]["checked"] = $request->session()->get("list_filter_props")[$pNAME];
								}
								else
								{
									$ResultArray["properties_name"][$arProp["name"]]["checked"]=[];
								}
								$ResultArray["properties_name"][$arProp["name"]]["crid"] = $arProp["crid"];
								$ResultArray["properties_name"][$arProp["name"]]["en"] = $arProp["en"];
								$ResultArray["properties_name"][$arProp["name"]]["values"][$arProp["value"]] = 1;
							}
							else
							{
								$ResultArray["properties_name"][$arProp["name"]]["values"][$arProp["value"]]++;
							}
						}
						//Добавить для списка запчастей
						if(in_array($arProp["en"],$arOnlyValueProps))
						{
							//Убрать НАЗВАНИЕ свойства, оставить только значение
							$arProp["name"]=$arProp["value"]; $arProp["value"]="";
						}
						$arPageItemProps[] = $arProp;
				}
			}
			///////////////////////////////properties error
			//Сортировка ЗНАЧЕНИЙ свойств
			foreach($ResultArray["properties_name"] as $name=>$arValues)
			{
				ksort($arValues["values"]);
				$ResultArray["properties_name"][$name]["values"]=$arValues["values"];
			}
			//Применить фильтр по свойствам к полному списку запчастей
			// if(isset($_SESSION['list_filter_props']) AND count($_SESSION['list_filter_props'])>0)
			if($request->session()->get('list_filter_props') AND count($request->session()->get('list_filter_props')) > 0)
			{
				$ResultArray["all_brands"] = $ResultArray["brands_parts_count"] = [];//original
				$arPAIDs_temp_noP = $arPAIDs_noP;
				$arPAIDs_noP = []; 
				//Сбросить доступные свойства для фильтра что бы заново их наполнить - доступными
				$ar_temp_PROPS_NAME = $ResultArray['properties_name']; 
				$ResultArray["properties_name"] = [];
				foreach($ar_temp_PROPS_NAME as $PN_KEY=>$arTpmProp)
				{
					if($PN_KEY != $request->session()->get("list_filter_fixed"))
					{
						//Стереть все значения свойств фильтра что бы позднее добавить только значения отфильтрованых товаров
						$ar_temp_PROPS_NAME[$PN_KEY]["values"] = [];
					}
				}
				//Для всех запчастей
				if(isset($arParts_WOF) AND count($arParts_WOF)>0)
				{
					$arApplyPARTS = array_merge($partsNoPArray, $arParts_WOF);
				}
				else
				{
					$arApplyPARTS = $partsNoPArray;
				}
				Log::info($request->session()->get("list_filter_props"));
				foreach($arApplyPARTS as $pkey=>$TPartArray)
				{
					$NotInFilter=true;					
					//Запомнить какие ВСЕ разом свойство:значение должны совпасть что бы не удалять этот товар
					$TPartArray["need_to_filter"] = $request->session()->get("list_filter_props");
					//Все свойства
					foreach($arPageItemProps as $pk=>$arProp)
					{
						if($TPartArray["aid"] == $arProp["aid"])
						{
							//Если УЖЕ привязалось к запчасти то убрать из списка foreach
							unset($arPageItemProps[$pk]);
							if(array_key_exists($arProp["name"], $request->session()->get("list_filter_props")) AND in_array($arProp["value"],$request->session()->get("list_filter_props")[$arProp["name"]]))
							{
								$DelNeed = array_search($arProp["value"],$TPartArray["need_to_filter"][$arProp["name"]]);
								//Удалить из списка требуемых
								unset($TPartArray["need_to_filter"][$arProp["name"]][$DelNeed]);
								$ResultArray["filtered_properties_count"]++;
								$NotInFilter = false;
							}
							if(isset($TPartArray["brand_filtered"]) && $TPartArray["brand_filtered"] != 'Y')
							{
								$partsNoPArray[$pkey]["properties_count"]++;
								if(!isset($partsNoPArray[$pkey]["properties"][$arProp["name"]]))
								{
									//Может быть одно название свойства и два значения "задний мост / передний мост"
									$partsNoPArray[$pkey]["properties"][$arProp["name"]] = $arProp["value"];
								}
								else
								{
									if($partsNoPArray[$pkey]["properties"][$arProp["name"]]!=$arProp["value"])
									{
										$partsNoPArray[$pkey]["properties"][$arProp["name"]] .= "; ".$arProp["value"];
									}
								}
							}
						}
					}
					//Проверить ВСЕ ли требуемые значения свойств совпали
					foreach($TPartArray["need_to_filter"] as $PrtNAME=>$arPPropVal)
					{
						if(count($arPPropVal)>0)
						{
							$NotInFilter = true;
						}
					}
					if($NotInFilter)
					{
						if(isset($TPartArray["brand_filtered"]) && $TPartArray["brand_filtered"] != 'Y')
						{
							unset($partsNoPArray[$pkey]);
							$UnsettedByProps++;
							$ResultArray["filter_is_applyed"] = true;
						}
					}
					else
					{

						if(isset($TPartArray["brand_filtered"]) && $TPartArray["brand_filtered"] != 'Y')
						{
							$arPAIDs_noP[] = $TPartArray["aid"];
							//Наполнить фильтр заново свойствами - только доступными
							foreach($partsNoPArray[$pkey]["properties"] as $PROP_NAME=>$PROP_VALUE)
							{
								if(in_array($ar_temp_PROPS_NAME[$PROP_NAME]["en"],$arShowProps["en"]))
								{
									if(!isset($ResultArray["properties_name"][$PROP_NAME]))
									{
										$ResultArray["properties_name"][$PROP_NAME] = $ar_temp_PROPS_NAME[$PROP_NAME];
									}
									if($PROP_NAME != $request->session()->get("list_filter_fixed"))
									{
										if(strpos($PROP_VALUE,"; ")>0)
										{
											$arPROP_VALUE = explode("; ",$PROP_VALUE);
											foreach($arPROP_VALUE as $PROP_VALUE_n)
											{
												$ResultArray["properties_name"][$PROP_NAME]["values"][$PROP_VALUE_n]++;
											}
										}
										else
										{
											$ResultArray["properties_name"][$PROP_NAME]["values"][$PROP_VALUE]++;
										}
									}
								}
							}
						}
						//Запомнить какие остались БРЕНДЫ после фильтрации
						$ResultArray["all_brands"][$TPartArray["bkey"]] = $TPartArray["brand"];
						//Еще раз мой фикс)
						if (isset($ResultArray["brands_parts_count"][$TPartArray["brand"]]))
						{
							$ResultArray["brands_parts_count"][$TPartArray["brand"]]++;
						}
						else
						{
							$ResultArray["brands_parts_count"][$TPartArray["brand"]] = 1;
						}
						//$ResultArray["properties_name"][!!] = $arTempPropsName[!!]; //Оставить в фильтре только те свойства которые остались после фильтрации
					}
				}
				$ResultArray["all_brands_count"] = count($ResultArray["all_brands"]);
			}
			$arPAIDs_noP_cnt = count($arPAIDs_noP);
			//Сортировка СВОЙСТВ
			foreach($ResultArray["properties_name"] as $name=>$arPROP)
			{
				$arNamesByEn[$arPROP["en"]] = $name;
				$arPropsByEn[$arPROP["en"]] = $arPROP;
			}
			$ResultArray["properties_name"]=[];
			foreach($arShowProps["en"] as $EnName)
			{
				if(isset($arNamesByEn[$EnName]))
				{
					$ResultArray["properties_name"][$arNamesByEn[$EnName]] = $arPropsByEn[$EnName];
				}
			}
		}
		/////////////////////////////////
		$arPAIDs_noP_cnt = count($arPAIDs_noP);

		//СОРТИРОВКА - ВСЕ
		/////////////////////////////
		$arSortKeys = [];
		foreach($partsNoPArray as $pkey=>$TPartArray)
		{
			$SortNum=999999999;
			//По бренду
			if($ResultArray['sort'] == 1)
			{
				if(isset($TPartArray["prices_count"]))
				{
					$SortNum = 999;
				}
			}
			//По сроку доставки
			elseif($ResultArray['sort'] == 2)
			{
				if(isset($MinDaysArray[$pkey]))
				{
					$SortNum = $MinDaysArray[$pkey];
				}
			}
			//По цене
			else
			{
				if(isset($MinPricesArray[$pkey]))
				{
					$SortNum = $MinPricesArray[$pkey];
				}
			}
			if(isset($SrPKEYc) AND $SrPKEYc==$pkey)
			{
				$SortNum=0;
			}
			//analogparts
			$arSortKeys[] = $SortNum;
		}
		if(count($arSortKeys)>0 AND count($partsNoPArray)>0)
		{
			array_multisort($arSortKeys,$partsNoPArray);
		}
		
		$ResultArray["parts_count"] = count($partsNoPArray);
		
		/////////deleted original pagination
		$arPARTS = $partsNoPArray;
		$arPAIDs = $arPAIDs_noP;

		//Get TecDoc info about LINKS
		/////////////////////////////
		if($LinksCnt>0)
		{
			foreach($arPARTS as $pkey=>$TPartArray)
			{
				if(isset($TPartArray["link_code"]) AND !isset($TPartArray["aid"]))
				{
					//Если это кросс которого НЕТ в базе текдока (aid для картинок не известен)
					$arGPart = TecdocController::GetPartByPKEY($TPartArray["bkey"],$TPartArray["akey"]);
					// if($arGPart["aid"]>0)//original
					if (isset($arGPart["aid"]))
					{
						$SetCrNum = $SetCrNum + 1;
						$partsNoPArray[$pkey]["aid"] = $arGPart["aid"];
						$partsNoPArray[$pkey]["article"] = $arGPart["article"];
						$partsNoPArray[$pkey]["brand"] = $arGPart["brand"];
						$partsNoPArray[$pkey]["product_name"] = $arGPart["product_name"];
						$partsNoPArray[$pkey]["bkey"] = Functions::SingleKey($arGPart["brand"],true);
						$partsNoPArray[$pkey]["akey"] = Functions::SingleKey($arGPart["article"]);
						$partsNoPArray[$pkey]["kind"] = $arGPart["kind"];
						if (!isset($partsNoPArray[$pkey]["name"]))
						{
							$partsNoPArray[$pkey]["name"] = $arGPart["product_name"];
						}
						$arPAIDs_noP[] = $arGPart["aid"];
						$ResultArray["all_brands"][$TPartArray["bkey"]] = $arGPart["brand"];
					}
				}
			}
		}
		
		/////////////////////////////
		$arPAIDs_cnt = count($arPAIDs);
		
		//Комплектация (Спецификация)
		/*
		$rsSpecifs = TecdocController::GetSpecificationsUnion($arPAIDs); //aid - искомый, COMP_AID - к которому привязан как часть комплекта, COMP_ARTICLE - артикул к которому привязан, QNT - кол. шт в этом комплекте, COMP_NAME ...
		while($arSpecif = $rsSpecifs->Fetch()){
			echo '<pre>'; print_r($arSpecif); echo '</pre>'; 
		}
		*/
		
		////////////////////////////////////////////////
		// Обработка товаров СРАНИЦЫ
		////////////////////////////////////////////////
		//$arCrPrior=Array(100=>1,410=>2,497=>3);
		foreach($arPARTS as $pkey=>$TPartArray)
		{
			//Detail page
			$arPARTS[$pkey]["detail_url"] = Functions::GetProductURL($TPartArray["brand"],$TPartArray["akey"]);
			$arPARTS[$pkey]["search_url"] = Functions::GetSearchURL($TPartArray["brand"],$TPartArray["akey"]);
			//star rating
			$rate = ProductRating::where('pkey',$TPartArray["bkey"] . $TPartArray["akey"])->avg('rating');
			if($rate)
			{
				$arPARTS[$pkey]["RATING"] = $rate;
				$arPARTS[$pkey]["RATING_LEFT"] = 5 - $rate;
				$arPARTS[$pkey]["REVIEWSCOUNT"] = ProductRating::where('pkey',$TPartArray["bkey"] . $TPartArray["akey"])->count('client_id');
			}
			else
			{
				$arPARTS[$pkey]["RATING"] = intval(0);
				$arPARTS[$pkey]["RATING_LEFT"] = intval(5);
				$arPARTS[$pkey]["REVIEWSCOUNT"] = intval(0);
			}
			
			//Characteristics
			if($ResultArray["filtered_properties_count"]<=0)
			{
				//Если фильтр по свойствам не применялся и свойства ещё не привязаны к запчастям
				foreach($arPageItemProps as $arProp)
				{
					// if($TPartArray["aid"] == $arProp["aid"])
					if(isset($TPartArray["aid"]) && $TPartArray["aid"] == $arProp["aid"])
					{
						/*
						//if($arProp["crid"]==410){$arProp["value"]='<a href="/'.ROOT_DIR.'/templates/descriptions/spring_'.LANG.'.php?trd='.ROOT_DIR.'" class="popup">'.$arProp["value"].'</a>';}
						$PName = str_replace('/мм?','/мм²',$arProp["name"]);
						$PName = str_replace('? ','Ø ',$PName);
						if(strpos($PName,'[")>0)
						{
							$Dim = substr($PName,strpos($PName,'["));
							$PName = str_replace(' '.$Dim,"",$PName);
							$Dim = str_replace('[","",$Dim); $Dim = str_replace("]',"",$Dim);
							$arProp["value"] = $arProp["value"].' '.$Dim;
						}
						if(!array_key_exists(UWord($PName),$arSortedProps))
						{
							if($arCrPrior[$arProp["crid"]]>0)
							{
								$SortNum=$arCrPrior[$arProp["crid"]];
							}
							else
							{
								$SortNum=99999;
							}
							$arSortKeys[] = $SortNum;
							$arSortedProps[UWord($PName)] = $arProp["value"];
						}
						else
						{
							$arSortedProps[UWord($PName)] .= ' ('.$arProp["value"].')';
						}
						if(count($arSortKeys)>1 AND count($arSortedProps)>1)
						{
							array_multisort($arSortKeys,$arSortedProps);
						}
						$arPARTS[$pkey]["properties"] = $arSortedProps;*/
						if(!isset($arPARTS[$pkey]["properties"][$arProp["name"]]))
						{
							//Может быть одно название свойства и два значения "задний мост / передний мост"
							$arPARTS[$pkey]["properties"][$arProp["name"]] = $arProp["value"];
							$arPARTS[$pkey]["properties_count"]++;
						}
						else
						{
							if($arPARTS[$pkey]["properties"][$arProp["name"]]!=$arProp["value"])
							{
								$arPARTS[$pkey]["properties"][$arProp["name"]] .= "; ".$arProp["value"];
							}
						}
					}
				}
			}
		}
		
		//superseded articles
		/////////////////////////////
		// if($arPAIDs_cnt>0)
		// {
			// $arSArts=[];
			// $rsSArts = TecdocController::Getsuperseded($arPAIDs);
			// foreach($rsSArts as $arSArt)
			// {
				// aid, NEW_ARTICLE
				// $arSArts[$arSArt["aid"]] = $arSArt["NEW_ARTICLE"];
			// }
			// if(count($arSArts)>0)
			// {
				// foreach($arPARTS as $pkey=>$TPartArray)
				// {
					// if(array_key_exists($TPartArray["aid"],$arSArts))
					// {
						// $arPARTS[$pkey]["superseded"]=$arSArts[$TPartArray["aid"]];
					// }
				// }
			// }
		// }
		if (0 < $arPAIDs_cnt)
		{
			// $arSArts = [];//xz
			$rsSArts = TecdocController::Getsuperseded($arPAIDs);
			if (isset($rsSArts))
			{
				foreach ($rsSArts as $arSArt)
				{
					$arSArts[$arSArt["aid"]] = $arSArt["NEW_ARTICLE"];
				}
				// if (0 < count($arSArts))
				if (isset($arSArts))
				{
					foreach ($arPARTS as $pkey => $TPartArray)
					{
						if (isset($TPartArray["aid"]))
						{
							if (array_key_exists($TPartArray["aid"], $arSArts))
							{
								$arPARTS[$pkey]["superseded"] = $arSArts[$TPartArray["aid"]];
							}
						}
					}
				}
			}
		}
							
		//Images
		/////////////////////////////
		$ResultArray["ART_LOGOS"] = [];
		if(count($arPARTS)>0)
		{
			$arTImgs=[];
			$arLogoPAIDs=[];
			$rsImages = TecdocController::GetImagesUnion($arPAIDs);
			if($rsImages)
			{
				foreach($rsImages as $arImage)
				{
					//aid, PATH
					$arTImgs[$arImage["aid"]][] = $arImage;
				}
			}
			//echo '<pre>'; print_r($arTImgs); echo '</pre>';
			foreach($arPARTS as $pkey=>$TPartArray)
			{
				if(isset($TPartArray["aid"]) && array_key_exists($TPartArray["aid"],$arTImgs))//no aid error
				// if(isset($arTImgs[$TPartArray["aid"]]))
				{
					foreach($arTImgs[$TPartArray["aid"]] as $arImg)
					{
						if(!strpos($arImg["PATH"],'0/0.jpg'))
						{
							if($TPartArray["kind"]!=3)
							{
								////Не привязывать картинки аналогов к оригинальным номерам
								if($arPARTS[$pkey]["img_zoom"]=="" AND $TPartArray["kind"]!=3)
								{
									$arPARTS[$pkey]["img_src"]= $arImg["PATH"];
									$arPARTS[$pkey]["img_zoom"]='Y';
									$arPARTS[$pkey]["img_from"]='TDBase';
								}
								else
								{
									//Additional images
									$arPARTS[$pkey]["IMG_ADDITIONAL"][] = $arImg["PATH"];
								}
								$arPARTS[$pkey]["img_count"]++;
							}
						}
					}
				}
				//LOCAL
				$ArtMedia = '/uploads/artmedia/'.$TPartArray["bkey"].'/'.$TPartArray["akey"].'.jpg';
				$ArtPath = $_SERVER["DOCUMENT_ROOT"].$ArtMedia;
				if(file_exists($ArtPath))
				{
					if($arPARTS[$pkey]["img_zoom"]!="")
					{
						$arPARTS[$pkey]["IMG_ADDITIONAL"][] = $arPARTS[$pkey]["img_src"];
					}
					$arPARTS[$pkey]["img_src"]=$ArtMedia;
					$arPARTS[$pkey]["img_zoom"]='Y';
					$arPARTS[$pkey]["img_from"]='Local';
				}
				if(isset($TPartArray["BRAND_CODE"]))
				{
					$BrandLogoPath = '/images/brands/'.$TPartArray["BRAND_CODE"].'.png';
					if(isset($TPartArray["kind"]))
					{
						if($TPartArray["kind"]==3 AND file_exists($_SERVER["DOCUMENT_ROOT"].$BrandLogoPath))
						{
							$arPARTS[$pkey]["logo_src"] = $BrandLogoPath;
						}
					}
				}
				elseif(isset($TPartArray["bkey"]))
				{
					$BrandLogoPath = '/images/brands/'.$TPartArray["bkey"].'.png';
					if(isset($TPartArray["kind"]))
					{
						if($TPartArray["kind"]==3 AND file_exists($_SERVER["DOCUMENT_ROOT"].$BrandLogoPath))
						{
							$arPARTS[$pkey]["logo_src"] = $BrandLogoPath;
						}
					}
				}
				//Logo media folder
				$TPartArray["Local_logo"] = false;
				$LogoMediaJPG = '/images/logomedia/'.$TPartArray["bkey"].'.jpg'; 
				$LogoMediaPNG = '/images/logomedia/'.$TPartArray["bkey"].'.png';
				if(file_exists($_SERVER["DOCUMENT_ROOT"].$LogoMediaPNG))
				{
					$arPARTS[$pkey]["logo_src"] = $LogoMediaPNG;
					$TPartArray["Local_logo"] = true;
				}
				elseif(file_exists($_SERVER["DOCUMENT_ROOT"].$LogoMediaJPG))
				{
					$arPARTS[$pkey]["logo_src"] = $LogoMediaJPG; $TPartArray["Local_logo"]=true;
				}
				if(!$TPartArray["Local_logo"])
				{
					if(isset($TPartArray["kind"]))
					{
						if($TPartArray["kind"]==0 OR $TPartArray["kind"]==1 OR $TPartArray["kind"]==3)
						{
							//Лого только для kind = 1 и 3 иначе будут неверные лого
							//( $TPartArray["kind"]==0 для товаров созданных из URL которых нет в ARTICLES но только как аналог из LOOKUP)
							$arLogoPAIDs[] = $TPartArray["aid"];
						}
					}
				}
			}
			// Brands LOGO
			if(count($arLogoPAIDs)>0)
			{
				$rsBLogos = TecdocController::GetArtsLogoUnion($arLogoPAIDs);
				foreach($rsBLogos as $arBLogos)
				{
					//aid, PATH
					if(!isset($ResultArray["ART_LOGOS"][$arBLogos["aid"]]) OR $ResultArray["ART_LOGOS"][$arBLogos["aid"]]=="")
					{
						$ResultArray["ART_LOGOS"][$arBLogos["aid"]] = $arBLogos["PATH"];
					}
				}
			}
			foreach($arPARTS as $pkey=>$TPartArray)
			{
				if(isset($TPartArray["aid"]))
				{
					if(isset($ResultArray["ART_LOGOS"][$TPartArray["aid"]]) AND $arPARTS[$pkey]["logo_src"]=="")
					{
						$arPARTS[$pkey]["logo_src"] = $ResultArray["ART_LOGOS"][$TPartArray["aid"]];
					}
				}
			}
		}
			
		//Sorting of PAGE parts (base & online prices)
		/////////////////////////////
		$arSortKeys=[];
		foreach($arPARTS as $pkey=>$TPartArray)
		{
			//echo '<pre>'; print_r($TPartArray); echo '</pre>';
			$SortNum = 999999999;
			$MinPrice=0;
			$MinDays=0;
			$MaxAvail=0;
			$arItemSortKeys=[];
			if(array_key_exists($pkey,$ResultArray["prices"]))
			{
				if(is_array($ResultArray["prices"][$pkey]) AND count($ResultArray["prices"][$pkey])>0)
				{
					foreach($ResultArray["prices"][$pkey] as $arSPr)
					{
						$arItemSortKeys[] = $arSPr["price_converted"];
						if($MinPrice==0 OR $arSPr["price_converted"]<$MinPrice)
						{
							$MinPrice=$arSPr["price_converted"];
						}
						$MaxAvail=$MaxAvail+intval($arSPr["available"]);
						if($MinDays==0 OR (($arSPr["day"]+1)<$MinDays))
						{
							//Что бы товары без цен были всёравно в конце даже если дней доставки ==0
							$MinDays = ($arSPr["day"]+1);
						}
						//Additional price images option
						if($arSPr["options"]["img_src"]!="")
						{
							if($TPartArray["img_zoom"]=="")
							{
								$arPARTS[$pkey]["img_src"]=$arSPr["options"]["img_src"];
								$arPARTS[$pkey]["img_zoom"]='Y';
								$arPARTS[$pkey]["img_from"]='PriceOption';
							}
							else
							{
								$arPARTS[$pkey]["IMG_ADDITIONAL"][]=$arSPr["options"]["img_src"];
							}
							$arPARTS[$pkey]["img_count"]++;
						}
					}
					//Сортировать внутри списка ЦЕН товара
					array_multisort($arItemSortKeys,$ResultArray["prices"][$pkey]);
				}
			}
			//По бренду
			if($ResultArray["sort"]==1)
			{
				//По сроку доставки
				if($TPartArray["prices_count"]>0){$SortNum=9999;}
			}
			elseif($ResultArray["sort"]==3)
			{
				if($MinDays>0)
				{
					$SortNum = $MinDays;
				}
				//Наличию описания и цены
				//}elseif($ResultArray["sort"]==2){
					//if($TPartArray["prices_count"]>0){$SortNum=9999;}
					//if($TPartArray["img_count"]>0){$SortNum=$SortNum-100;}
					//if($MaxAvail>0){$SortNum = $SortNum-($MaxAvail*5);}
					//elseif($arPARTS[$pkey]["properties_count"]>0){$SortNum=$SortNum-$arPARTS[$pkey]["properties_count"];}
			}
			else
			{
				//По цене
				if($MinPrice>0)
				{
					$SortNum = $MinPrice;
				}
			}
			if(isset($SrPKEYc) AND $SrPKEYc==$pkey)
			{
				//analogparts
				$SortNum=0;
			}
			$arSortKeys[] = $SortNum;
		}
		if(count($arSortKeys)>0 AND count($arPARTS)>0)
		{
			array_multisort($arSortKeys,$arPARTS);
		}
	}
}
$ResultArray["PARTS"] = [];
foreach($arPARTS as $NumKey=>$PartArray)
{
	if(array_key_exists("aid",$PartArray))
	{
		if($PartArray["aid"]>0)
		{
			$PartArray["uaid"] = Functions::SetUrID($PartArray["aid"]);
		}
	}
	$ResultArray["PARTS"][$PartArray["bkey"].$PartArray["akey"]] = $PartArray;
}
unset($TDMxBI);
if($ResultArray["all_brands_count"]>1)
{
	$arABSortKeys = [];
	foreach($ResultArray["all_brands"] as $bkey=>$brand)
	{
		if(!in_array(substr($bkey,0,1),$ResultArray["all_brands_letters"]))
		{
			$ResultArray["all_brands_letters"][]=substr($bkey,0,1);
		}
		// if($ResultArray["ab_min_price_f"][$bkey]>0)
		if(isset($ResultArray["ab_min_price_f"][$bkey]))
		{
			$arABSortKeys[] = $ResultArray["ab_min_price_f"][$bkey];
		}
		else
		{
			$arABSortKeys[]=99999999;
		}
	}
	if(is_array($ResultArray["all_brands_letters"]) AND count($ResultArray["all_brands_letters"])>0)
	{
		asort($ResultArray["all_brands_letters"]);
	}
	if(count($ResultArray["all_brands"])>0 AND count($arABSortKeys)>0)
	{
		array_multisort($arABSortKeys,$ResultArray["all_brands"]);
	}
	//Фильтрованные спереди
	if(isset($ResultArray["filtered_brands"]) AND count($ResultArray["filtered_brands"])>0)
	{
		$ResultArray["all_brands"] = array_merge($ResultArray["filtered_brands"],$ResultArray["all_brands"]);
	}
}
?>