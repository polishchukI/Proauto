<?php

namespace App\Http\Controllers\Special;

use App\Models\Inventory\ProviderPrice;
use App\Models\Special\Oil;
use App\Models\Product\ProductRating;
use App\Models\Blog\Post;
use App\Http\Controllers\Prices;
use App\Http\Controllers\Controller;
use App\Http\Controllers\WSController;
use App\Http\Controllers\Shop\ShopController;
use App\Http\Controllers\FunctionsController as Functions;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
//////////seo
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
//////////seo

class OilsController extends Controller
{
    public function OilsFullList(Request $request)
    {
		// dd(compact('request'));
		$ResultArray = [
			"oil_viscosity" => $this->oil_viscosity(),
			"oil_acea" => $this->oil_acea(),
			"oil_type" => $this->oil_type(),
			"oil_brand" => $this->oil_brand(),
			"oil_api" => $this->oil_api(),
			"oil_oem" => $this->oil_oem(),
			"oil_basis" => $this->oil_basis(),
			"art_logos" => [],
			"parts" => [],
			"prices" => [],
			"all_brands" => [],
			"properties_name" => [],
			"ab_min_price" => [],
			"filtrable" => true,
			"ab_min_price_f" => [],
			"latestpost" => Post::orderBy('created_at','desc')->first()->toArray(),
			"randomproducts" => ShopController::RandomProductsWidget()];
			
		$partsNoPArray = [];
		$OilsArray = Oil::filter()->get();

		if($OilsArray)
		{
			$OilsArray = $OilsArray->toArray();
			foreach ($OilsArray as $OilsItem)
			{
				$OilsItem["bkey"] = Functions::SingleKey($OilsItem["brand"],true);
				$OilsItem["akey"] = Functions::SingleKey($OilsItem["article"]);
				// "id" => 1
				// "article" => "441416"
				// "brand" => "aral"
				// "name" => "HighTronic"
				// "image" => "/images/oils/aral/441416.jpg"
				// "volume" => 5
				// "ean" => null----------------------------
				// "type" => 1--------------------------------
				// "acea" => "A3/B3;A3/B4"
				// "sae" => "5W40"
				// "oem" => "MB229.3;MB229.5;VW502.00;VW505.00;Longlife-01;GM-LL-A-025;GM-LL-B-025"
				// "api" => "SL/CF"
				// "astm" => null
				// "ilsac" => null
				// "jaso" => null
				// "nato" => null
				// "global" => null
				// "zf" => null
				$OilsItem["pkey"] = $OilsItem["bkey"] . $OilsItem["akey"];
				$partsNoPArray[$OilsItem["pkey"]] = [
						"pkey" => $OilsItem["pkey"],
						"bkey" => $OilsItem["bkey"],
						"akey" => $OilsItem["akey"],
						"article" => $OilsItem["article"],
						"brand" => $OilsItem["brand"],
						"name" => $OilsItem["type"] . ' ' . $OilsItem["brand"] . ' ' . $OilsItem["name"] . ' ' . $OilsItem["sae"] . ' ' . $OilsItem["volume"] . 'L ',
						"prices_count" => "",
						"prices" => [],
						"properties_count" => "",
						"properties" =>
						[
							"ACEA" => $OilsItem["acea"],
							"SAE" => $OilsItem["sae"],
							"OEM" => $OilsItem["oem"],
							"API" => $OilsItem["api"],
							"ASTM" => $OilsItem["astm"],
							"ILSAC" => $OilsItem["ilsac"],
							"JASO" => $OilsItem["jaso"],
							"NATO" => $OilsItem["nato"],
							"GLOBAL" => $OilsItem["global"],
							"ZF" => $OilsItem["zf"],
						],
						"img_src" => $OilsItem["image"]];
			}
		}
		/////////////////////////Oils
		foreach($partsNoPArray as $pkey=>$TPartArray)
		{
			//All Brands
			$ResultArray['all_brands'][$TPartArray['bkey']] = $TPartArray['brand'];
			if (isset($ResultArray['brands_parts_count'][$TPartArray['brand']]))
			{
				$ResultArray['brands_parts_count'][$TPartArray['brand']]++;
			}
			else
			{
				$ResultArray['brands_parts_count'][$TPartArray['brand']] = 1;
			}
		}
		$arPARTS = $partsNoPArray;
		///////////////
		foreach ($arPARTS as $pkey => $TPartArray)
		{
			//star rating
			$rate = ProductRating::where('pkey',$TPartArray["bkey"] . $TPartArray["akey"])->avg('rating');
			if($rate)
			{
				$arPARTS[$pkey]["rating"]					= $rate;
				$arPARTS[$pkey]["rating_left"]				= 5 - $rate;
				$arPARTS[$pkey]["reviewscount"]				= ProductRating::where('pkey',$TPartArray["bkey"] . $TPartArray["akey"])->count('client_id');
			}
			else
			{
				$arPARTS[$pkey]["rating"]					= intval(0);
				$arPARTS[$pkey]["rating_left"]				= intval(5);
				$arPARTS[$pkey]["reviewscount"]				= intval(0);
			}
		}
			
		// 
		foreach ($arPARTS as $NumKey => $PartArray)
		{
			//////if (array_key_exists('aid',$PartArray))
			if (isset($PartArray["aid"]))
			{
				if (0 < $PartArray["aid"])
				{
					$PartArray["uaid"] = $PartArray["ean"];
				}
			}
			$ResultArray["parts"][$PartArray["bkey"] . $PartArray["akey"]] = $PartArray;
		}
		

		if (0 < count($partsNoPArray))
		{
			$ViewSort = $ResultArray["sort"] = $request->get('ViewSort', 1);

			if (0 < count($partsNoPArray))
			{
				$i = 0;
				foreach ($partsNoPArray as $TPartArray)
				{
					$q = ProviderPrice::where('akey','=', $TPartArray["akey"])->where('bkey','=', $TPartArray["bkey"]);

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
				/////////////////////
				if($ViewSort == 1)
				{
					$PrcsSQL->orderBy('price');
				}
				elseif($ViewSort == 2)
				{
					$PrcsSQL->orderBy('price', 'DESC');//error modal prices popup
				}
				elseif($ViewSort == 3)
				{
					$PrcsSQL->orderBy('day');
				}
				elseif($ViewSort == 4)
				{
					$PrcsSQL->orderBy('price');
				}
				else
				{
					$PrcsSQL->orderBy('available');
				}
				/////////////////////
				$PricesArray = $PrcsSQL->get()->toArray();

				$arNmC = [];
				foreach ($PricesArray as $PriceItem)
				{
					if (config('tecdoc_config.hide_prices_noavail') == 1 && $PriceItem["available"] < 1)
					{
						continue;
					}
					$PrPKey = $PriceItem["bkey"] . $PriceItem["akey"];
					$PriceItem = Functions::FormatPrice($PriceItem);
					$ResultArray["prices"][$PrPKey][] = $PriceItem;
					
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
					if (isset($MaxAvailableArray[$PrPKey]) && ($MaxAvailableArray[$PrPKey]==0 OR $PriceItem["available"]>$MaxAvailableArray[$PrPKey]))
					{
						$MaxAvailableArray[$PrPKey] = $PriceItem["available"];
					}
					//Minimal prices for sorting
					if (isset($MinPricesArray[$PrPKey]) && ($MinPricesArray[$PrPKey]==0 OR $PriceItem["price_converted"] < $MinPricesArray[$PrPKey]))
					{
						$MinPricesArray[$PrPKey] = $PriceItem["price_converted"];
					}
					//Minimal day for sorting
					//Что бы товары без цен были всёравно в конце даже если дней доставки =0
					$ItemDAY = intval($PriceItem["day"]) + 1;
					if(!isset($MinDaysArray[$PrPKey]) OR $ItemDAY<$MinDaysArray[$PrPKey])
					{
						$MinDaysArray[$PrPKey] = $ItemDAY;
					}
				}
				unset($arNmC);
			}
		}
		
		////////////////////////////////
		$total = count($ResultArray["parts"]);
		$perPage = 15;
		$page = $request->page??1;
		$offSet = ($page * $perPage) - $perPage;  
		$itemsForCurrentPage = array_slice($ResultArray["parts"], $offSet, $perPage, true); 
		$Numbers = new LengthAwarePaginator($itemsForCurrentPage, $total, $perPage, $page,['path'  => $request->url(),'query' => $request->query(),]);
		////////////////////////////////
		$SEO = "";
		foreach ($ResultArray["parts"] as $PartArray)
		{
			$SEO .= implode([$PartArray["brand"] . " " . $PartArray["article"] . ", "]);
		}
		
		SEOMeta::setTitle('Масло автомобильное  ' . $SEO . '');
		SEOMeta::setDescription('Масло автомобильное  ' . $SEO . '');
		OpenGraph::setTitle('Масло автомобильное  ' . $SEO . '');
        OpenGraph::setDescription('Масло автомобильное  ' . $SEO . '');
		SEOMeta::setKeywords($SEO);
		////////////////////////////////
		
		// dd(compact('ResultArray', 'Numbers', 'total', 'perPage', 'bestsellers', 'featured', 'posts', 'newarrivals'));
		return view('shop.special.oils', compact('ResultArray', 'Numbers', 'total', 'perPage', 'bestsellers', 'featured', 'posts', 'newarrivals'));
    }

	function oil_viscosity()
	{
		$oil_viscosity = [
			"0W-8"=>"0W-8","0W-12"=>"0W-12","0W-15"=>"0W-15","0W-16"=>"0W-16","0W-20"=>"0W-20","0W-30"=>"0W-30","0W-40"=>"0W-40","0W-50"=>"0W-50","0W-10"=>"0W-10","0W-5"=>"0W-5",
			"5W-16"=>"5W-16","5W-20"=>"5W-20","5W-30"=>"5W-30","5W-40"=>"5W-40","5W-50"=>"5W-50","7.5W-40"=>"7.5W-40","10W-30"=>"10W-30","10W-40"=>"10W-40","10W-50"=>"10W-50","10W-60"=>"10W-60",
			"15W-30"=>"15W-30","15W-40"=>"15W-40","15W-50"=>"15W-50","15W-60"=>"15W-60","20W-20"=>"20W-20","20W-40"=>"20W-40","20W-50"=>"20W-50","20W-60"=>"20W-60","20W-30"=>"20W-30","25W-40"=>"25W-40",
			"25W-50"=>"25W-50","25W-60"=>"25W-60","70W-80"=>"70W-80","75W-80"=>"75W-80","75W-85"=>"75W-85","75W-90"=>"75W-90","75W-110"=>"75W-110","75W-140"=>"75W-140","75W-250"=>"75W-250","70W-75W"=>"70W-75W",
			"80W-85"=>"80W-85","80W-90"=>"80W-90","80W-140"=>"80W-140","80W-250"=>"80W-250","85W-90"=>"85W-90","85W-140"=>"85W-140","85W-80"=>"85W-80","SAE 20"=>"SAE 20","SAE 30"=>"SAE 30","SAE 40"=>"SAE 40",
			"SAE 50"=>"SAE 50","SAE 60"=>"SAE 60","40W"=>"40W","SAE 80"=>"SAE 80","SAE 90"=>"SAE 90","SAE 140"=>"SAE 140","10W"=>"10W","75W"=>"75W","90W"=>"90W"];
		return $oil_viscosity;
	}

	function oil_acea()
	{
		$oil_acea = [
			"A1"=>"A1","A2"=>"A2","A3"=>"A3","A3/B3"=>"A3/B3","A3/B4"=>"A3/B4","A4"=>"A4","A5"=>"A5","A5/B5"=>"A5/B5","B1"=>"B1","B2"=>"B2",
			"B3"=>"B3","B4"=>"B4","B5"=>"B5","C1"=>"C1","C2"=>"C2","C3"=>"C3","C4"=>"C4","C5"=>"C5","E2"=>"E2","E3"=>"E3","E4"=>"E4","E5"=>"E5",
			"E6"=>"E6","E7"=>"E7","E9"=>"E9"];
		return $oil_acea;
	}
	function oil_type()
	{
		$oil_type = [
			"engine_oil"=>"Моторное масло",
			"transmission_oil"=>"Трансмиссионное масло",
			"reducer_oil"=>"Редукторное масло",
			"hydraulic_oil"=>"Гидравлическое масло",
			"hydraulic_fluid"=>"Гидравлическая жидкость",
			"coolant"=>"Охлаждающая жидкость",
			"braking_fluid"=>"Тормозная жидкость",
			"washer_fluid"=>"Жидкость омывателя",
			"sealant"=>"Герметик",
			"grease"=>"Смазка"];
		return $oil_type;
	}
	function oil_basis()
	{
		$oil_basis = [
			"mineral"=>"Минеральное масло",
			"semisynthetic"=>"Полусинтетическое масло",
			"synthetic"=>"Синтетическое масло"];
		return $oil_basis;
	}

	function oil_api()
	{
		$oil_api = [
			"CB"=>"CB","CC"=>"CC","CD"=>"CD","CE"=>"CE","CF"=>"CF","CF-2"=>"CF-2","CF-3"=>"CF-3","CF-4"=>"CF-4","CG-4"=>"CG-4","CH-4"=>"CH-4","CI-4"=>"CI-4","CI-4+"=>"CI-4+","CJ-4"=>"CJ-4","CK-4"=>"CK-4",
			"CK-4"=>"CK-4","CP"=>"CP","EC"=>"EC","GL 3+"=>"GL 3+","GL-1"=>"GL-1","GL-2"=>"GL-2","GL-3"=>"GL-3","GL-4"=>"GL-4","GL-4+"=>"GL-4+","GL-5"=>"GL-5","GL-5+"=>"GL-5+","GL-6"=>"GL-6","LS"=>"LS",
			"MT-1"=>"MT-1","RC"=>"RC","SA"=>"SA","SB"=>"SB","SD"=>"SD","SE"=>"SE","SF"=>"SF","SG"=>"SG","SH"=>"SH","SJ"=>"SJ","SL"=>"SL","SM"=>"SM","SN"=>"SN","SN+"=>"SN+","TC"=>"TC","TC+"=>"TC+","TD"=>"TD"];
		return $oil_api;
	}

	function oil_brand()
	{
		$oil_brand = [
			"ASPORT"=>"A-Sport","ABRO"=>"Abro","ACDELCO"=>"AC Delco","ADDINOL"=>"Addinol","AGA"=>"AGA","AGROL"=>"Agrol","AIMOL"=>"Aimol","AISIN"=>"Aisin","AJUSA"=>"Ajusa","AKROSS"=>"AKross","ALPINE"=>"Alpine",
			"AMALIE"=>"Amalie","AMIWA"=>"Amiwa","AMSOIL"=>"Amsoil","ARAL"=>"Aral","ARCTICCAT"=>"Arctic cat","ARDECA"=>"Ardeca","ARECA"=>"Areca","AREOL"=>"Areol","ARIAL"=>"Arial","ASTRON"=>"Astron","ATE"=>"Ate",
			"AUTOBACS"=>"Autobacs","AVENO"=>"Aveno","AVISTA"=>"Avista","AWM"=>"Awm","BARDAHL"=>"Bardahl","BEHRHELLA"=>"Behr-hella","BERU"=>"Beru","BIZOL"=>"Bizol","BMW"=>"BMW","BOMBARDIER"=>"Bombardier",
			"BOSAL"=>"Bosal","BOSCH"=>"Bosch","BP"=>"BP","BRAVOIL"=>"Bravoil","CNRG"=>"C.N.R.G","CAM2"=>"Cam2","CARLSONOIL"=>"Carlson oil","CARTECHNIC"=>"Cartechnic","CASTROL"=>"Castrol","CHAMPIONOIL"=>"Champion oil",
			"CHEMIPRO"=>"Chemipro","CHEMPIOIL"=>"Chempioil","CHEVRON"=>"Chevron","CHRYSLER"=>"Chrysler","CITROENPEUGEOT"=>"Citroen/peugeot","COMMA"=>"Comma","COOLSTREAM"=>"Cool stream","CRC"=>"Crc","CUPPER"=>"Cupper",
			"CWORKS"=>"Cworks","DATSUN"=>"Datsun","DELPHI"=>"Delphi","DETROIL"=>"Detroil","DIESELTECHNIC"=>"Diesel technic","DIVINOL"=>"Divinol","DONEDEAL"=>"Done deal","ELF"=>"Elf","ELRING"=>"Elring",
			"ENEOS"=>"Eneos","ENI"=>"Eni","ESPER"=>"Esper","EUROL"=>"Eurol","EUROREPAR"=>"EuroRepar","EVEREST"=>"Everest","EXTREMELUBRICANTS"=>"Extreme Lubricants","FANFARO"=>"Fanfaro","FAVORIT"=>"Favorit",
			"FEBI"=>"Febi","FELIX"=>"Felix","FERODO"=>"Ferodo","FILLINN"=>"Fill inn","FINKE"=>"Finke","FLEETQUARD"=>"Fleetquard","FORD"=>"Ford","FTE"=>"Fte","FUCHS"=>"Fuchs","GZOX"=>"G zox","GENERGY"=>"G-Energy",
			"GAZPROMNEFT"=>"Gazpromneft","GENERALMOTORS"=>"General Motors","GLYSANTIN"=>"Glysantin","GTOIL"=>"GT oil","GULF"=>"Gulf","GUNK"=>"Gunk","HANAKO"=>"Hanako","HANSPRIES"=>"Hans pries",
			"HELLAPAGID"=>"Hella-pagid","HEPU"=>"Hepu","HIGEAR"=>"Hi-Gear","HONDA"=>"Honda","HPX"=>"Hpx","HYUNDAIKIA"=>"Hyundai / Kia","XTEER"=>"Hyundai XTeer","ICETIGER"=>"Ice tiger","IDEMITSU"=>"Idemitsu",
			"IMG"=>"Img","JETGO"=>"Jet go","JURIDBENDIX"=>"Jurid/bendix","KAMOKA"=>"Kamoka","KANGAROO"=>"Kangaroo","KENDALL"=>"Kendall","KIXX"=>"Kixx","KROONOIL"=>"Kroon oil","KUTTENKEULER"=>"Kuttenkeuler",
			"KYK"=>"Kyk","LADA"=>"Lada","LANDROVER"=>"Land rover","LAVRNEXT"=>"Lavr next","LIQUIMOLY"=>"Liqui Moly","LOCTITE"=>"Loctite","LOTOS"=>"Lotos","LUBEX"=>"Lubex","LUCASOIL"=>"Lucas Oil","LUK"=>"Luk",
			"LUKOIL"=>"Lukoil","LUXE"=>"Luxe","MAG1"=>"Mag1","MANNOL"=>"Mannol","MAZDA"=>"Mazda","MEGUIN"=>"Meguin","MERCEDESBENZ"=>"Mercedes Benz","MEYLE"=>"Meyle","MGROVER"=>"Mg rover","MINTEX"=>"Mintex",
			"MITASU"=>"Mitasu","MITSUBISHI"=>"Mitsubishi","MOBIL"=>"Mobil","MOL"=>"Mol","MOLYGREEN"=>"Moly green","MOPAR"=>"Mopar","MOTIP"=>"Motip","MOTORCRAFT"=>"Motorcraft","MOTOREX"=>"Motorex","MOTRIO"=>"Motrio",
			"MPMOIL"=>"Mpm oil","NESTE"=>"Neste","NGNOIL"=>"NGN oil","NIGRIN"=>"Nigrin","NIRO"=>"Niro","NISSAN"=>"Nissan","NOVUS"=>"Novus","OILRIGHT"=>"Oilright","OPEL"=>"Opel","OREGON"=>"Oregon","ORLENOIL"=>"Orlen Oil",
			"OSCAR"=>"Oscar","PARAFLU"=>"Paraflu","PATRON"=>"Patron","PEAUTOMOTIVE"=>"Pe automotive","PENNASOL"=>"Pennasol","PENNZOIL"=>"Pennzoil","PENTOSIN"=>"Pentosin","PERMATEX"=>"Permatex","PETROCANADA"=>"Petro-Сanada",
			"PETRONASOLEOBLITZ"=>"Petronas OLEOBLITZ","PETRONASPARAFLU"=>"PETRONAS PARAFLU","PETRONASSYNTIUM"=>"Petronas syntium","PINGO"=>"Pingo","POLYMERIUM"=>"Polymerium","PORSCHE"=>"Porsche","PRESTO"=>"Presto",
			"PRESTONE"=>"Prestone","PRIDE"=>"Pride","PRISTA"=>"Prista","PROFESSIONALHUNDERT"=>"Professional hundert","PROFIX"=>"Profix","QUAKERSTATE"=>"Quaker State","QUICKBRAKE"=>"Quick brake","QUICKSILVER"=>"Quicksilver",
			"RAVENOL"=>"Ravenol","REDLINEOIL"=>"Red line oil","REINZ"=>"Reinz","REKTOL"=>"Rektol","RENAULT"=>"Renault","REPSOL"=>"Repsol","RHEINOL"=>"Rheinol","RINKAI"=>"Rinkai","RIXX"=>"Rixx","ROLF"=>"Rolf",
			"ROSDOT"=>"Rosdot","ROWE"=>"Rowe","RYMAX"=>"Rymax","SOIL"=>"S-oil","SACHS"=>"Sachs","SAKURA"=>"Sakura","SAMURAIGT"=>"Samurai GT","SEIKEN"=>"Seiken","SELENIA"=>"Selenia","SHELL"=>"Shell","SINTEC"=>"Sintec",
			"SKF"=>"Skf","SMART"=>"Smart","SOFT99"=>"Soft99","SONAX"=>"Sonax","SPRINTA"=>"Sprinta","SRS"=>"Srs","SSANGYONG"=>"SsangYong","STARKRAFT"=>"Starkraft","STATOIL"=>"Statoil","STIHL"=>"Stihl","SUBARU"=>"Subaru",
			"SUMICOALPHAS"=>"Sumico / Alphas","SUPERHELP"=>"Superhelp","SUPROTEC"=>"Suprotec","SUZUKI"=>"Suzuki","SWAG"=>"SWAG","SWD"=>"Swd","SWDRHEINOL"=>"Swd rheinol","TAKAYAMA"=>"Takayama","TATNEFT"=>"Tatneft",
			"TCL"=>"Tcl","TEBOIL"=>"Teboil","TEROSON"=>"Teroson","TEXACO"=>"Texaco","TEXOIL"=>"Texoil","TEXTAR"=>"Textar","TOPRAN"=>"Topran","TOTACHI"=>"Totachi","TOTAL"=>"Total","TOYOTA"=>"Toyota","TRW"=>"Trw",
			"TUNAP"=>"Tunap","TUTELA"=>"Tutela","UAZ"=>"Uaz","UNIL"=>"Unil","UNITED"=>"United","URANIA"=>"Urania","VAG"=>"VAG","VAICO"=>"Vaico","VALEO"=>"Valeo","VALVOLINE"=>"Valvoline","VAPSOIL"=>"Vapsoil",
			"VERITY"=>"Verity","VITEX"=>"Vitex","VMPAUTO"=>"Vmpauto","VOLVO"=>"Volvo","VS"=>"Vs","WD40"=>"Wd-40","WEGO"=>"Wego","WYNNS"=>"Wynn s","XFREEZE"=>"X-freeze","XADO"=>"Xado","XENUM"=>"Xenum","YACCO"=>"Yacco",
			"YAMAHA"=>"YamaLube","YOKKI"=>"Yokki","ZFPARTS"=>"Zf parts","ZIC"=>"ZIC","BARS"=>"Барс","VOLGAOIL"=>"Волга-ойл","DEVON"=>"Девон","NEVAM"=>"Нева-м","POLYARNIK"=>"Полярник","ROSA"=>"Роса",
			"ROSNEFT"=>"Роснефть","TNK"=>"Тнк","TOM"=>"Томь"
		];
		return $oil_brand;
	}

	function oil_oem()
	{
		$oil_oem = [
			"MB 236.17"=>"MB 236.17","AcDelco 10-4032"=>"AcDelco 10-4032","Acura HTO-06"=>"Acura HTO-06","AFNOR NFR 15-601"=>"AFNOR NFR 15-601","AFNOR R-15-501"=>"AFNOR R-15-501","Aisin AW JWS 3309"=>"Aisin AW JWS 3309",
			"Aisin Warner"=>"Aisin Warner","Allison C3"=>"Allison C3","Allison C4"=>"Allison C4","Allison TES 295"=>"Allison TES 295","Allison TES 389"=>"Allison TES 389","Arvin Meritor Transmission 076-N"=>"Arvin Meritor Transmission 076-N",
			"ATF 134 FE"=>"ATF 134 FE","ATF 134 ME"=>"ATF 134 ME","ATF 3292"=>"ATF 3292","ATF 7134 FE"=>"ATF 7134 FE","ATF DCG-II"=>"ATF DCG-II","ATF L 12108"=>"ATF L 12108","Audi 6 speed FWD"=>"Audi 6 speed FWD",
			"Audi TL 52180"=>"Audi TL 52180","Bentley"=>"Bentley","BMW"=>"BMW","BMW 1375.4"=>"BMW 1375.4","BMW 7045 E"=>"BMW 7045 E","BMW 8122 9 407 758"=>"BMW 8122 9 407 758","BMW 8122 9 407 858"=>"BMW 8122 9 407 858",
			"BMW 8122 9 407 859"=>"BMW 8122 9 407 859","BMW 8322 0 136 376"=>"BMW 8322 0 136 376","BMW 8322 0 142 516"=>"BMW 8322 0 142 516","BMW 8322 0 144 137"=>"BMW 8322 0 144 137","BMW 8322 0 309 031"=>"BMW 8322 0 309 031",
			"BMW 8322 0 397 114"=>"BMW 8322 0 397 114","BMW 8322 0 429 154"=>"BMW 8322 0 429 154","BMW 8322 0 429 159"=>"BMW 8322 0 429 159","BMW 8322 0 440 214"=>"BMW 8322 0 440 214","BMW 8322 2 147 477"=>"BMW 8322 2 147 477",
			"BMW 8322 2 148 578"=>"BMW 8322 2 148 578","BMW 8322 2 148 579"=>"BMW 8322 2 148 579","BMW 8322 2 152 426"=>"BMW 8322 2 152 426","BMW 8322 2 152 426 ATF L 12108"=>"BMW 8322 2 152 426 ATF L 12108",
			"BMW 8322 2 167 720"=>"BMW 8322 2 167 720","BMW 8322 9 407 807"=>"BMW 8322 9 407 807","BMW DCTF-1"=>"BMW DCTF-1","BMW Drivelogic 7 speed"=>"BMW Drivelogic 7 speed","BMW ETL-7045E"=>"BMW ETL-7045E",
			"BMW GS 9400"=>"BMW GS 9400","BMW High Performance Diesel Oil"=>"BMW High Performance Diesel Oil","BMW LA 2634"=>"BMW LA 2634","BMW Longlife- 01 FE"=>"BMW Longlife- 01 FE","BMW Longlife-01"=>"BMW Longlife-01",
			"BMW Longlife-04"=>"BMW Longlife-04","BMW Longlife-98"=>"BMW Longlife-98","BMW LT 71141"=>"BMW LT 71141","BMW Mini Cooper D 2007"=>"BMW Mini Cooper D 2007","BMW MTF LT-1"=>"BMW MTF LT-1","BMW MTF LT-2"=>"BMW MTF LT-2",
			"BMW MTF LT-3"=>"BMW MTF LT-3","BMW MTF LT-4"=>"BMW MTF LT-4","BMW N 600 69.0"=>"BMW N 600 69.0","BMW N 600 6910"=>"BMW N 600 6910","BMW N60069.0"=>"BMW N60069.0","BMW Spezial"=>"BMW Spezial","Bombardier"=>"Bombardier",
			"BS 5117"=>"BS 5117","BS 6580"=>"BS 6580","BS6580-1992"=>"BS6580-1992","Caltex 1712"=>"Caltex 1712","Case JIC 501"=>"Case JIC 501","Case MS1710"=>"Case MS1710","Caterpillar EC-1"=>"Caterpillar EC-1","Caterpillar ECF-1"=>"Caterpillar ECF-1",
			"Caterpillar ECF-1a"=>"Caterpillar ECF-1a","Caterpillar ECF-2"=>"Caterpillar ECF-2","Caterpillar ECF-3"=>"Caterpillar ECF-3","Caterpillar TO-2"=>"Caterpillar TO-2","Caterpillar TO-4"=>"Caterpillar TO-4","CHF 11 S"=>"CHF 11 S",
			"Chrysler ATF +3"=>"Chrysler ATF +3","Chrysler ATF +4"=>"Chrysler ATF +4","Chrysler ATF 4"=>"Chrysler ATF 4","Chrysler DBL-7700"=>"Chrysler DBL-7700","Chrysler MS 10725"=>"Chrysler MS 10725","Chrysler MS 10850"=>"Chrysler MS 10850",
			"Chrysler MS 10902"=>"Chrysler MS 10902","Chrysler MS 11106"=>"Chrysler MS 11106","Chrysler MS 6395"=>"Chrysler MS 6395","Chrysler MS 6395-N"=>"Chrysler MS 6395-N","Chrysler MS 6395-Q"=>"Chrysler MS 6395-Q","Chrysler MS 6395-R"=>"Chrysler MS 6395-R",
			"Chrysler MS 6395-S"=>"Chrysler MS 6395-S","Chrysler MS-10216"=>"Chrysler MS-10216","Chrysler MS-5644"=>"Chrysler MS-5644","Chrysler MS-5931"=>"Chrysler MS-5931","Chrysler MS-7170"=>"Chrysler MS-7170","Chrysler MS-8985"=>"Chrysler MS-8985",
			"Chrysler MS-9070"=>"Chrysler MS-9070","Chrysler MS-9224"=>"Chrysler MS-9224","Chrysler MS-9417"=>"Chrysler MS-9417","Chrysler MS-9602"=>"Chrysler MS-9602","Chrysler MS-9763"=>"Chrysler MS-9763","Chrysler MS-9769"=>"Chrysler MS-9769",
			"Chrysler Powershift 6 speed"=>"Chrysler Powershift 6 speed","Citroen ATF LT 71141"=>"Citroen ATF LT 71141","Citroen DCS 6 speed"=>"Citroen DCS 6 speed","CNH MAT 3505"=>"CNH MAT 3505","CNH MAT 3509"=>"CNH MAT 3509",
			"CNH MAT 3525"=>"CNH MAT 3525","Cummins 85T8-2"=>"Cummins 85T8-2","Cummins 90T8-4"=>"Cummins 90T8-4","Cummins CES 14603"=>"Cummins CES 14603","Cummins CES 20071"=>"Cummins CES 20071","Cummins CES 20072"=>"Cummins CES 20072",
			"Cummins CES 20076"=>"Cummins CES 20076","Cummins CES 20077"=>"Cummins CES 20077","Cummins CES 20078"=>"Cummins CES 20078","Cummins CES 20081"=>"Cummins CES 20081","CUNA NC 956-16"=>"CUNA NC 956-16","DAF"=>"DAF",
			"DAF 74002"=>"DAF 74002","DAF HP1"=>"DAF HP1","DAF HP2"=>"DAF HP2","DAIHATSU CVT Fluid DC"=>"DAIHATSU CVT Fluid DC","DANA SHAES-234"=>"DANA SHAES-234","DANA SHAES-256"=>"DANA SHAES-256","DANA SHAES-429 A"=>"DANA SHAES-429 A",
			"DDC 7SE270"=>"DDC 7SE270","DDC 93K214"=>"DDC 93K214","DDC 93K215"=>"DDC 93K215","DDC 93K218"=>"DDC 93K218","Denison HF-0"=>"Denison HF-0","Detroit Diesel 93k217"=>"Detroit Diesel 93k217","Detroit Diesel Corp"=>"Detroit Diesel Corp",
			"Deutz DQC II-05"=>"Deutz DQC II-05","Deutz DQC II-10"=>"Deutz DQC II-10","Deutz DQC III-05"=>"Deutz DQC III-05","Deutz DQC III-10"=>"Deutz DQC III-10","Deutz DQC III-10 LA"=>"Deutz DQC III-10 LA","Deutz DQC IV-05"=>"Deutz DQC IV-05",
			"Deutz DQC IV-10"=>"Deutz DQC IV-10","Deutz TR 0119-399-1115"=>"Deutz TR 0119-399-1115","DEX-CVT"=>"DEX-CVT","Dia-Queen SSTF-I"=>"Dia-Queen SSTF-I","Eaton PS-164 rev 7"=>"Eaton PS-164 rev 7","Federal Specification A-A-870"=>"Federal Specification A-A-870",
			"Fiat 9.55523"=>"Fiat 9.55523","FIAT 9.55535-CR1"=>"FIAT 9.55535-CR1","FIAT 9.55535-D2"=>"FIAT 9.55535-D2","FIAT 9.55535-G1"=>"FIAT 9.55535-G1","FIAT 9.55535-G2"=>"FIAT 9.55535-G2","FIAT 9.55535-GH2"=>"FIAT 9.55535-GH2",
			"FIAT 9.55535-GS1"=>"FIAT 9.55535-GS1","FIAT 9.55535-H2"=>"FIAT 9.55535-H2","FIAT 9.55535-H3"=>"FIAT 9.55535-H3","FIAT 9.55535-M2"=>"FIAT 9.55535-M2","FIAT 9.55535-N"=>"FIAT 9.55535-N","FIAT 9.55535-N2"=>"FIAT 9.55535-N2",
			"FIAT 9.55535-S1"=>"FIAT 9.55535-S1","FIAT 9.55535-S2"=>"FIAT 9.55535-S2","FIAT 9.55535-Z2"=>"FIAT 9.55535-Z2","FIAT 9.55550"=>"FIAT 9.55550","FIAT 9.55550-AV4"=>"FIAT 9.55550-AV4","FIAT 9.55550-AV5"=>"FIAT 9.55550-AV5",
			"FIAT 9.55550-DA5"=>"FIAT 9.55550-DA5","FIAT 9.55550-MZ6"=>"FIAT 9.55550-MZ6","FMK"=>"FMK","Ford CVT23"=>"Ford CVT23","Ford CVT30"=>"Ford CVT30","Ford EPS-M2C 138-CJ"=>"Ford EPS-M2C 138-CJ","Ford EPS-M2C 166-H"=>"Ford EPS-M2C 166-H",
			"Ford ESD-M2C 175-A"=>"Ford ESD-M2C 175-A","Ford ESD-M97 B49-A"=>"Ford ESD-M97 B49-A","Ford ESE-M978B4H-A"=>"Ford ESE-M978B4H-A","Ford ESE-M97B44-A"=>"Ford ESE-M97B44-A","Ford ESE-M97B44-D"=>"Ford ESE-M97B44-D",
			"Ford ESP-M2C 154-A"=>"Ford ESP-M2C 154-A","Ford ESP-M2C 166-H"=>"Ford ESP-M2C 166-H","Ford ESP-M2C 33-F"=>"Ford ESP-M2C 33-F","Ford ESP-M2C 33-G"=>"Ford ESP-M2C 33-G","Ford ESW-M2C 105-A"=>"Ford ESW-M2C 105-A","Ford FOCUS RS"=>"Ford FOCUS RS",
			"Ford M2C 134-A"=>"Ford M2C 134-A","Ford M2C 134-B"=>"Ford M2C 134-B","Ford M2C 134-C"=>"Ford M2C 134-C","Ford M2C 134-D"=>"Ford M2C 134-D","Ford M2C 138-CJ"=>"Ford M2C 138-CJ","Ford M2C 153-E"=>"Ford M2C 153-E",
			"Ford M2C 159-B"=>"Ford M2C 159-B","Ford M2C 159-C"=>"Ford M2C 159-C","Ford M2C 159-D"=>"Ford M2C 159-D","Ford M2C 163-A"=>"Ford M2C 163-A","Ford M2C 166-H"=>"Ford M2C 166-H","Ford M2C 175"=>"Ford M2C 175","Ford M2C 185-A"=>"Ford M2C 185-A",
			"Ford M2C 33-F"=>"Ford M2C 33-F","Ford M2C 33-G"=>"Ford M2C 33-G","Ford M2C 41-B"=>"Ford M2C 41-B","Ford M2C 48-B"=>"Ford M2C 48-B","Ford M2C 53-A"=>"Ford M2C 53-A","Ford M2C 86-B"=>"Ford M2C 86-B","Ford M2C 9002-A"=>"Ford M2C 9002-A",
			"Ford M2C 925-B"=>"Ford M2C 925-B","Ford M2C 928-A"=>"Ford M2C 928-A","Ford Mercon"=>"Ford Mercon","Ford Mercon LV"=>"Ford Mercon LV","Ford MERCON SP"=>"Ford MERCON SP","Ford Mercon V"=>"Ford Mercon V",
			"FORD Powershift 6 speed"=>"FORD Powershift 6 speed","Ford SQM-2C 9001-A"=>"Ford SQM-2C 9001-A","Ford SQM-2C 9002- A"=>"Ford SQM-2C 9002- A","Ford SQM-2C 9002-AA"=>"Ford SQM-2C 9002-AA","Ford SQM-2C 9008-A"=>"Ford SQM-2C 9008-A",
			"Ford SQM-2C 9010-A"=>"Ford SQM-2C 9010-A","Ford SQM-2C 9010-B"=>"Ford SQM-2C 9010-B","Ford WSD-M2C 200-C"=>"Ford WSD-M2C 200-C","Ford WSL-M2C 192-A"=>"Ford WSL-M2C 192-A","Ford WSS-M2C 153-H"=>"Ford WSS-M2C 153-H",
			"Ford WSS-M2C 171-E"=>"Ford WSS-M2C 171-E","Ford WSS-M2C 1717-E"=>"Ford WSS-M2C 1717-E","Ford WSS-M2C 200-B"=>"Ford WSS-M2C 200-B","Ford WSS-M2C 200-C"=>"Ford WSS-M2C 200-C","Ford WSS-M2C 200-D2"=>"Ford WSS-M2C 200-D2",
			"Ford WSS-M2C 202-B"=>"Ford WSS-M2C 202-B","Ford WSS-M2C 204-A"=>"Ford WSS-M2C 204-A","Ford WSS-M2C 205-A"=>"Ford WSS-M2C 205-A","Ford WSS-M2C 912-A1"=>"Ford WSS-M2C 912-A1","Ford WSS-M2C 913-A"=>"Ford WSS-M2C 913-A","Ford WSS-M2C 913-B"=>"Ford WSS-M2C 913-B",
			"Ford WSS-M2C 913-C"=>"Ford WSS-M2C 913-C","Ford WSS-M2C 913-D"=>"Ford WSS-M2C 913-D","Ford WSS-M2C 917-A"=>"Ford WSS-M2C 917-A","Ford WSS-M2C 920-A"=>"Ford WSS-M2C 920-A","Ford WSS-M2C 924-A"=>"Ford WSS-M2C 924-A",
			"Ford WSS-M2C 925-A"=>"Ford WSS-M2C 925-A","Ford WSS-M2C 925-B"=>"Ford WSS-M2C 925-B","Ford WSS-M2C 928-A"=>"Ford WSS-M2C 928-A","Ford WSS-M2C 929-A"=>"Ford WSS-M2C 929-A","Ford WSS-M2C 930-A"=>"Ford WSS-M2C 930-A",
			"Ford WSS-M2C 930-B"=>"Ford WSS-M2C 930-B","Ford WSS-M2C 931-B"=>"Ford WSS-M2C 931-B","Ford WSS-M2C 933-A"=>"Ford WSS-M2C 933-A","Ford WSS-M2C 934-A"=>"Ford WSS-M2C 934-A","Ford WSS-M2C 934-B"=>"Ford WSS-M2C 934-B",
			"Ford WSS-M2C 934-C"=>"Ford WSS-M2C 934-C","Ford WSS-M2C 936"=>"Ford WSS-M2C 936","Ford WSS-M2C 936-A"=>"Ford WSS-M2C 936-A","Ford WSS-M2C 937-A"=>"Ford WSS-M2C 937-A","Ford WSS-M2C 938-A"=>"Ford WSS-M2C 938-A",
			"Ford WSS-M2C 945-A"=>"Ford WSS-M2C 945-A","Ford WSS-M2C 945-B"=>"Ford WSS-M2C 945-B","Ford WSS-M2C 946-A"=>"Ford WSS-M2C 946-A","Ford WSS-M2C 947-A"=>"Ford WSS-M2C 947-A","Ford WSS-M2C 948-B"=>"Ford WSS-M2C 948-B","Ford WSS-M97B44-D"=>"Ford WSS-M97B44-D",
			"Ford WSS-M97B51-A"=>"Ford WSS-M97B51-A","Ford WSS-M97B51-A1"=>"Ford WSS-M97B51-A1","Ford WSS-M97B55"=>"Ford WSS-M97B55","G 34088"=>"G 34088","Global DHD-1"=>"Global DHD-1","GM 1825M"=>"GM 1825M","GM 1899M"=>"GM 1899M",
			"GM 1940713"=>"GM 1940713","GM 1940714"=>"GM 1940714","GM 4118M"=>"GM 4118M","GM 4718M"=>"GM 4718M","GM 6038M"=>"GM 6038M","GM 6085M"=>"GM 6085M","GM 6094M"=>"GM 6094M","GM 613714"=>"GM 613714","GM 6277M"=>"GM 6277M","GM 6417M"=>"GM 6417M",
			"GM 9985648"=>"GM 9985648","GM 9986195"=>"GM 9986195","GM B 040 0240"=>"GM B 040 0240","GM B 0401010"=>"GM B 0401010","GM B 040104"=>"GM B 040104","GM Dexos 1"=>"GM Dexos 1","GM Dexos 2"=>"GM Dexos 2","GM Dexron II"=>"GM Dexron II","GM Dexron II D"=>"GM Dexron II D",
			"GM Dexron II E"=>"GM Dexron II E","GM Dexron III"=>"GM Dexron III","GM Dexron III D"=>"GM Dexron III D","GM Dexron III F"=>"GM Dexron III F","GM Dexron III G"=>"GM Dexron III G","GM Dexron III H"=>"GM Dexron III H","GM Dexron VI"=>"GM Dexron VI",
			"GM GMN10060"=>"GM GMN10060","GM N1006"=>"GM N1006","GM QL130100"=>"GM QL130100","GM Saturn"=>"GM Saturn","GM-LL-A-025"=>"GM-LL-A-025","GM-LL-B-025"=>"GM-LL-B-025","GM-LL-B-026"=>"GM-LL-B-026","HONDA"=>"HONDA","Honda ATF-Z1"=>"Honda ATF-Z1",
			"Honda HMMF"=>"Honda HMMF","Honda PSF-S"=>"Honda PSF-S","Honda PSF-V"=>"Honda PSF-V","Honda Ultra PSF-II"=>"Honda Ultra PSF-II","HUSQVARNA 242 Chainsaw Test"=>"HUSQVARNA 242 Chainsaw Test","Hyundai 040000C90SG"=>"Hyundai 040000C90SG",
			"Hyundai ATF Red-1K"=>"Hyundai ATF Red-1K","Hyundai SP II"=>"Hyundai SP II","Hyundai SP III"=>"Hyundai SP III","HYUNDAI SP-IV"=>"HYUNDAI SP-IV","Hyundai SP-IVM"=>"Hyundai SP-IVM","Hyundai SPH-IV"=>"Hyundai SPH-IV","Hyundai SPH-IVRR"=>"Hyundai SPH-IVRR",
			"Idemitsu K17"=>"Idemitsu K17","International TMS 6816"=>"International TMS 6816","Isuzu BESCO ATF-II"=>"Isuzu BESCO ATF-II","Isuzu BESCO ATF-IIl"=>"Isuzu BESCO ATF-IIl","IVECO"=>"IVECO","IVECO 18-1807 AG3"=>"IVECO 18-1807 AG3","IVECO 18-1830"=>"IVECO 18-1830",
			"Jaguar ATF LT 71141"=>"Jaguar ATF LT 71141","Jaguar C2C 8432"=>"Jaguar C2C 8432","Jaguar Fluid 02JDE 26444"=>"Jaguar Fluid 02JDE 26444","Jaguar Fluid 8432"=>"Jaguar Fluid 8432","Jaguar JLM 202 38"=>"Jaguar JLM 202 38",
			"JASO 1-A"=>"JASO 1-A","JASO 315M 1A"=>"JASO 315M 1A","JASO M3151A"=>"JASO M3151A","JASO M325"=>"JASO M325","Jenbacher TA-NR1000- 0201"=>"Jenbacher TA-NR1000- 0201","JIS K 2234"=>"JIS K 2234","John Deere 8650-5"=>"John Deere 8650-5",
			"John Deere H24B1"=>"John Deere H24B1","John Deere H24C1"=>"John Deere H24C1","John Deere J20C"=>"John Deere J20C","John Deere J27"=>"John Deere J27","John Deere JDM H24"=>"John Deere JDM H24","Kia ATF Red-1K"=>"Kia ATF Red-1K","Kia SP II"=>"Kia SP II",
			"Kia SP III"=>"Kia SP III","Kia SPH-IV"=>"Kia SPH-IV","Komatsu KES 07.868.1"=>"Komatsu KES 07.868.1","LAND ROVER"=>"LAND ROVER","Land Rover - ST JLR.03.5003"=>"Land Rover - ST JLR.03.5003","Land Rover - ST JLR.03.5004"=>"Land Rover - ST JLR.03.5004",
			"Land Rover - ST JLR.51.5122"=>"Land Rover - ST JLR.51.5122","Land Rover LR023288"=>"Land Rover LR023288","Land Rover LR023289"=>"Land Rover LR023289","Land Rover TYK500050"=>"Land Rover TYK500050","Landrover ATF N 402"=>"Landrover ATF N 402",
			"Lexus LFA Service Fill"=>"Lexus LFA Service Fill","Liebherr A 934 C HD Litronic"=>"Liebherr A 934 C HD Litronic","Liebherr A 934 C Litronic"=>"Liebherr A 934 C Litronic","Liebherr TLV 035"=>"Liebherr TLV 035","Liebherr TLV 23009A"=>"Liebherr TLV 23009A",
			"M033MOT042"=>"M033MOT042","Mack EO L"=>"Mack EO L","Mack EO M"=>"Mack EO M","Mack EO M Plus"=>"Mack EO M Plus","Mack EO M Premium Plus"=>"Mack EO M Premium Plus","Mack EO N"=>"Mack EO N","Mack EO N Plus"=>"Mack EO N Plus",
			"Mack EO N Premium Plus"=>"Mack EO N Premium Plus","Mack EO O"=>"Mack EO O","Mack EO O Plus"=>"Mack EO O Plus","Mack EO O Premium Plus"=>"Mack EO O Premium Plus","MACK EO-K2"=>"MACK EO-K2","MACK EO-L"=>"MACK EO-L",
			"Mack GO-G"=>"Mack GO-G","Mack GO-GGM"=>"Mack GO-GGM","Mack GO-H"=>"Mack GO-H","Mack GO-J"=>"Mack GO-J","Mack GO-J Plus"=>"Mack GO-J Plus","Mack PG-1"=>"Mack PG-1","Mack PG-2"=>"Mack PG-2","MACK TO A Plus"=>"MACK TO A Plus","MAN 270"=>"MAN 270",
			"MAN 271"=>"MAN 271","MAN 324"=>"MAN 324","MAN 324 Type NF"=>"MAN 324 Type NF","MAN 324 Type Si-OAT"=>"MAN 324 Type Si-OAT","MAN 324 Type SNF"=>"MAN 324 Type SNF","MAN 3271-1"=>"MAN 3271-1","MAN 3275"=>"MAN 3275",
			"MAN 3275-1"=>"MAN 3275-1","MAN 3277"=>"MAN 3277","MAN 3289"=>"MAN 3289","MAN 3343 Type M"=>"MAN 3343 Type M","MAN 3343 Type ML"=>"MAN 3343 Type ML","MAN 3343 Type S"=>"MAN 3343 Type S","MAN 3343 Type SL"=>"MAN 3343 Type SL",
			"MAN 339 Type A"=>"MAN 339 Type A","MAN 339 Type C"=>"MAN 339 Type C","MAN 339 Type D"=>"MAN 339 Type D","MAN 339 Type F"=>"MAN 339 Type F","MAN 339 Type V1"=>"MAN 339 Type V1","MAN 339 Type V2"=>"MAN 339 Type V2",
			"MAN 339 Type Z1"=>"MAN 339 Type Z1","MAN 339 Type Z2"=>"MAN 339 Type Z2","MAN 339 Type Z3"=>"MAN 339 Type Z3","MAN 341"=>"MAN 341","MAN 341 Type E1"=>"MAN 341 Type E1","MAN 341 Type E2"=>"MAN 341 Type E2","MAN 341 Type E3"=>"MAN 341 Type E3",
			"MAN 341 Type M3"=>"MAN 341 Type M3","MAN 341 Type N"=>"MAN 341 Type N","MAN 341 Type TL"=>"MAN 341 Type TL","MAN 341 Type Z1"=>"MAN 341 Type Z1","MAN 341 Type Z2"=>"MAN 341 Type Z2","MAN 341 Type Z3"=>"MAN 341 Type Z3",
			"MAN 341 Type Z4"=>"MAN 341 Type Z4","MAN 341-1 Type Z2"=>"MAN 341-1 Type Z2","MAN 341Type Z5"=>"MAN 341Type Z5","MAN 342"=>"MAN 342","MAN 342 Typ M1"=>"MAN 342 Typ M1","MAN 342 Typ M2"=>"MAN 342 Typ M2",
			"MAN 342 Typ S1"=>"MAN 342 Typ S1","MAN 342 Typ SL"=>"MAN 342 Typ SL","MAN 342 Type M1"=>"MAN 342 Type M1","MAN 342 Type M2"=>"MAN 342 Type M2","MAN 342 Type M3"=>"MAN 342 Type M3","MAN 342 Type ML"=>"MAN 342 Type ML",
			"MAN 342 Type N"=>"MAN 342 Type N","MAN 342 Type S1"=>"MAN 342 Type S1","MAN 342 Type SL"=>"MAN 342 Type SL","MAN 3477"=>"MAN 3477","MAN 3575"=>"MAN 3575","MAN 3677"=>"MAN 3677","MAN M 3275"=>"MAN M 3275","MAN M 3289"=>"MAN M 3289","MAN M 3343 Type S"=>"MAN M 3343 Type S","MAN M271"=>"MAN M271","MAN M3271-1"=>"MAN M3271-1","MAN M3275"=>"MAN M3275",
			"MAN M3275-1"=>"MAN M3275-1","MAN M3277"=>"MAN M3277","MAN M3277-CRT"=>"MAN M3277-CRT","MAN M3477"=>"MAN M3477","MAN M3575"=>"MAN M3575","MAN N 3343 S"=>"MAN N 3343 S","Massey Ferguson CMS M 1143"=>"Massey Ferguson CMS M 1143",
			"Massey Ferguson CMS M 1145"=>"Massey Ferguson CMS M 1145","Mazda ATF D-III"=>"Mazda ATF D-III","Mazda ATF FZ"=>"Mazda ATF FZ","Mazda FL22 Coolant"=>"Mazda FL22 Coolant","Mazda M-3"=>"Mazda M-3","Mazda TFF CVT Fluid TC"=>"Mazda TFF CVT Fluid TC",
			"MB 226.5"=>"MB 226.5","MB 226.51"=>"MB 226.51","MB 226.9"=>"MB 226.9","MB 227.0"=>"MB 227.0","MB 227.1"=>"MB 227.1","MB 228.0"=>"MB 228.0","MB 228.1"=>"MB 228.1","MB 228.3"=>"MB 228.3","MB 228.31"=>"MB 228.31","MB 228.5"=>"MB 228.5",
			"MB 228.51"=>"MB 228.51","MB 229.1"=>"MB 229.1","MB 229.3"=>"MB 229.3","MB 229.31"=>"MB 229.31","MB 229.5"=>"MB 229.5","MB 229.51"=>"MB 229.51","MB 229.52"=>"MB 229.52","MB 235.0"=>"MB 235.0","MB 235.1"=>"MB 235.1","MB 235.10"=>"MB 235.10",
			"MB 235.11"=>"MB 235.11","MB 235.20"=>"MB 235.20","MB 235.27"=>"MB 235.27","MB 235.28"=>"MB 235.28","MB 235.4"=>"MB 235.4","MB 235.5"=>"MB 235.5","MB 235.6"=>"MB 235.6","MB 235.61"=>"MB 235.61","MB 235.7"=>"MB 235.7","MB 235.72"=>"MB 235.72",
			"MB 235.8"=>"MB 235.8","MB 236.1"=>"MB 236.1","MB 236.10"=>"MB 236.10","MB 236.11"=>"MB 236.11","MB 236.12"=>"MB 236.12","MB 236.14"=>"MB 236.14","MB 236.15"=>"MB 236.15","MB 236.2"=>"MB 236.2","MB 236.20"=>"MB 236.20",
			"MB 236.21"=>"MB 236.21","MB 236.3"=>"MB 236.3","MB 236.41"=>"MB 236.41","MB 236.5"=>"MB 236.5","MB 236.6"=>"MB 236.6","MB 236.7"=>"MB 236.7","MB 236.8"=>"MB 236.8","MB 236.81"=>"MB 236.81","MB 236.9"=>"MB 236.9","MB 236.91"=>"MB 236.91",
			"MB 325.0"=>"MB 325.0","MB 325.2"=>"MB 325.2","MB 325.3"=>"MB 325.3","MB 325.5"=>"MB 325.5","MB 326.3"=>"MB 326.3","MB 344.0"=>"MB 344.0","MB 345.0"=>"MB 345.0","MB A 001 989 77 03"=>"MB A 001 989 77 03","MB A 001 989 78 03"=>"MB A 001 989 78 03",
			"Mercon"=>"Mercon","Mercon SP"=>"Mercon SP","MERCON-N2C-194A"=>"MERCON-N2C-194A","MERCON® C"=>"MERCON® C","MEZ 121 C"=>"MEZ 121 C","MF 1139"=>"MF 1139","MF 1144"=>"MF 1144","MIL-2105D"=>"MIL-2105D","MIL-L-2015EZF"=>"MIL-L-2015EZF",
			"MIL-L-2104D"=>"MIL-L-2104D","MIL-L-2104E"=>"MIL-L-2104E","MIL-L-2105"=>"MIL-L-2105","MIL-L-2105A"=>"MIL-L-2105A","MIL-L-2105B"=>"MIL-L-2105B","MIL-L-2105C"=>"MIL-L-2105C","MIL-L-2105D"=>"MIL-L-2105D","MIL-L-2105E"=>"MIL-L-2105E",
			"MIL-L-46152B"=>"MIL-L-46152B","MIL-L-46152D"=>"MIL-L-46152D","MIL-L-46152E"=>"MIL-L-46152E","MIL-PRF-2105D"=>"MIL-PRF-2105D","MIL-PRF-2105E"=>"MIL-PRF-2105E","Mini Cooper CVT"=>"Mini Cooper CVT","MINI EZL799"=>"MINI EZL799","Mitsubish J2"=>"Mitsubish J2",
			"Mitsubishi CVTF-J1"=>"Mitsubishi CVTF-J1","Mitsubishi CVTF-S"=>"Mitsubishi CVTF-S","Mitsubishi J3"=>"Mitsubishi J3","Mitsubishi J4"=>"Mitsubishi J4","Mitsubishi MZ320065"=>"Mitsubishi MZ320065","Mitsubishi S0001401"=>"Mitsubishi S0001401",
			"Mitsubishi SP-II"=>"Mitsubishi SP-II","Mitsubishi SP-III"=>"Mitsubishi SP-III","Mitsubishi SP-IV"=>"Mitsubishi SP-IV","Mitsubishi TC-SST"=>"Mitsubishi TC-SST","MOPAR ATF +3"=>"MOPAR ATF +3","MOPAR ATF +4"=>"MOPAR ATF +4",
			"Mopar CVTF+4"=>"Mopar CVTF+4","MTF BOT 207"=>"MTF BOT 207","MTU MTL 5048"=>"MTU MTL 5048","MTU MTL 5049"=>"MTU MTL 5049","MTU Type 1"=>"MTU Type 1","MTU Type 2"=>"MTU Type 2","MTU Type 3"=>"MTU Type 3","MTU Type 3.1"=>"MTU Type 3.1",
			"NATO S-759"=>"NATO S-759","Navistar B-1 typ 3"=>"Navistar B-1 typ 3","Navistar TMS 6816"=>"Navistar TMS 6816","New Holland NH 410B"=>"New Holland NH 410B","NF R 15 601"=>"NF R 15 601","Nissan ECVT"=>"Nissan ECVT","Nissan KLE5200002"=>"Nissan KLE5200002","Nissan KLE520000403"=>"Nissan KLE520000403",
			"Nissan L250 Coolant"=>"Nissan L250 Coolant","Nissan Matic-C"=>"Nissan Matic-C","Nissan Matic-D"=>"Nissan Matic-D","Nissan Matic-J"=>"Nissan Matic-J","Nissan Matic-K"=>"Nissan Matic-K","Nissan Matic-S"=>"Nissan Matic-S","Nissan Matic-W"=>"Nissan Matic-W",
			"Nissan NS-1"=>"Nissan NS-1","Nissan NS-2"=>"Nissan NS-2","Nissan NS-3"=>"Nissan NS-3","NMMA FC-W"=>"NMMA FC-W","NMMA TC W III"=>"NMMA TC W III","NMMA TC-W"=>"NMMA TC-W","NMMA TC-W3 R-56623"=>"NMMA TC-W3 R-56623","NMMA TC-W3 RL93938K"=>"NMMA TC-W3 RL93938K",
			"NMMA TC-WII"=>"NMMA TC-WII","Onorm V-5123"=>"Onorm V-5123","OPEL 19 40 766"=>"OPEL 19 40 766","Opel B0400240"=>"Opel B0400240","Opel B0401065"=>"Opel B0401065","Opel B401065"=>"Opel B401065","Pentosin CHF 11S"=>"Pentosin CHF 11S",
			"Peugeot B712710"=>"Peugeot B712710","Porsche"=>"Porsche","Porsche 000 043 304 00"=>"Porsche 000 043 304 00","Porsche 10 52 107"=>"Porsche 10 52 107","Porsche 999 917 080 00"=>"Porsche 999 917 080 00","PORSCHE 999 917 547 00"=>"PORSCHE 999 917 547 00","Porsche A30"=>"Porsche A30",
			"PORSCHE A40"=>"PORSCHE A40","Porsche ATF 3403 M11"=>"Porsche ATF 3403 M11","Porsche ATF LT 71141"=>"Porsche ATF LT 71141","PORSCHE C30"=>"PORSCHE C30","Porsche FFL-3"=>"Porsche FFL-3","PSA 9730A2"=>"PSA 9730A2","PSA 9730A8"=>"PSA 9730A8",
			"PSA 9734S2"=>"PSA 9734S2","PSA 9735EF"=>"PSA 9735EF","PSA B 71 2290"=>"PSA B 71 2290","PSA B71 2294"=>"PSA B71 2294","PSA B71 2295"=>"PSA B71 2295","PSA B71 2296"=>"PSA B71 2296","PSA B71 2297"=>"PSA B71 2297",
			"PSA B71 2300"=>"PSA B71 2300","PSA B71 2312"=>"PSA B71 2312","PSA B71 2315"=>"PSA B71 2315","PSA B71 2330"=>"PSA B71 2330","PSA B71 2375"=>"PSA B71 2375","PSA B71 2710"=>"PSA B71 2710","PSA S71 2710"=>"PSA S71 2710","Ready Mix -25°C"=>"Ready Mix -25°C","Ready Mix -30°C"=>"Ready Mix -30°C",
			"Renault"=>"Renault","Renault DP0"=>"Renault DP0","Renault EDC 6 speed"=>"Renault EDC 6 speed","RENAULT JXX"=>"RENAULT JXX","Renault LKW"=>"Renault LKW","RENAULT NDX"=>"RENAULT NDX","RENAULT PXX"=>"RENAULT PXX","Renault RD"=>"Renault RD","Renault RD-2"=>"Renault RD-2","Renault RGD"=>"Renault RGD",
			"Renault RLD"=>"Renault RLD","Renault RLD-2"=>"Renault RLD-2","Renault RLD-3"=>"Renault RLD-3","Renault RN 0700"=>"Renault RN 0700","Renault RN 0710"=>"Renault RN 0710","Renault RN 0720"=>"Renault RN 0720","Renault RVI"=>"Renault RVI",
			"Renault RXD"=>"Renault RXD","Renault RXD-2"=>"Renault RXD-2","RENAULT TL4"=>"RENAULT TL4","Renault Type D"=>"Renault Type D","Renault VI"=>"Renault VI","Renault VI RDL"=>"Renault VI RDL","Renault VI RLD-2"=>"Renault VI RLD-2",
			"Renault VI RLD-3"=>"Renault VI RLD-3","Rolls Royce PL 31493PA"=>"Rolls Royce PL 31493PA","SAAB 6901599"=>"SAAB 6901599","Scania"=>"Scania","SCANIA"=>"SCANIA","Scania LDF"=>"Scania LDF","Scania LDF II"=>"Scania LDF II",
			"Scania LDF III"=>"Scania LDF III","Scania STO 1"=>"Scania STO 1","Scania STO 2"=>"Scania STO 2","SCANIA TB 1451"=>"SCANIA TB 1451","SCION ATF WS"=>"SCION ATF WS","SHELL M-1375.4"=>"SHELL M-1375.4","Subaru ATF"=>"Subaru ATF",
			"Subaru i-CVTF"=>"Subaru i-CVTF","Subaru Lineartronic CVTF"=>"Subaru Lineartronic CVTF","Subaru NS-2"=>"Subaru NS-2","Suzuki CVT Green 1"=>"Suzuki CVT Green 1","Suzuki CVT green1 V"=>"Suzuki CVT green1 V","Suzuki NS-2"=>"Suzuki NS-2",
			"Suzuki S-CVT Oil"=>"Suzuki S-CVT Oil","Suzuki TC"=>"Suzuki TC","TMC of ATA RP-302A"=>"TMC of ATA RP-302A","TMC RP 302"=>"TMC RP 302","TMC RP 329"=>"TMC RP 329","TMC RP 338"=>"TMC RP 338","TMC RP 351"=>"TMC RP 351",
			"Toyota D-2"=>"Toyota D-2","Toyota JWS"=>"Toyota JWS","Toyota JWS 3309"=>"Toyota JWS 3309","Toyota T"=>"Toyota T","Toyota T-II"=>"Toyota T-II","Toyota T-III"=>"Toyota T-III","Toyota T-IV"=>"Toyota T-IV",
			"Toyota TC"=>"Toyota TC","Toyota TSK 2601"=>"Toyota TSK 2601","Toyota WS"=>"Toyota WS","UNE 25-361"=>"UNE 25-361","UNE 26361-88"=>"UNE 26361-88","US 6277 M"=>"US 6277 M","Voith 55.6336.32"=>"Voith 55.6336.32",
			"Voith DIWA"=>"Voith DIWA","Voith G1363"=>"Voith G1363","Voith G607"=>"Voith G607","Voith H55.6335"=>"Voith H55.6335","Voith H55.6335.35"=>"Voith H55.6335.35","Voith H55.6336"=>"Voith H55.6336","Voith H55.6336.36"=>"Voith H55.6336.36",
			"Voith H55.6336.38"=>"Voith H55.6336.38","Volvo 1161521"=>"Volvo 1161521","VOLVO 1161529"=>"VOLVO 1161529","Volvo 1161621"=>"Volvo 1161621","Volvo 1161838"=>"Volvo 1161838","Volvo 1161839"=>"Volvo 1161839","Volvo 1286083"=>"Volvo 1286083",
			"Volvo 97305"=>"Volvo 97305","Volvo 97307"=>"Volvo 97307","Volvo 97310"=>"Volvo 97310","Volvo 97313"=>"Volvo 97313","Volvo 97314"=>"Volvo 97314","Volvo 97316"=>"Volvo 97316","Volvo 97330"=>"Volvo 97330",
			"Volvo 97340"=>"Volvo 97340","Volvo 97341"=>"Volvo 97341","Volvo CE WB101"=>"Volvo CE WB101","Volvo CNG"=>"Volvo CNG","Volvo PKW"=>"Volvo PKW","Volvo STD 1273.36"=>"Volvo STD 1273.36","VOLVO VCC 95200377"=>"VOLVO VCC 95200377",
			"VOLVO VCC RBSO-2AE"=>"VOLVO VCC RBSO-2AE","Volvo VDS"=>"Volvo VDS","Volvo VDS-2"=>"Volvo VDS-2","Volvo VDS-3"=>"Volvo VDS-3","Volvo VDS-4"=>"Volvo VDS-4","Volvo WB-101"=>"Volvo WB-101","VW 500.00"=>"VW 500.00","VW 501.00"=>"VW 501.00",
			"VW 501.01"=>"VW 501.01","VW 501.50"=>"VW 501.50","VW 501.60"=>"VW 501.60","VW 502.00"=>"VW 502.00","VW 503.00"=>"VW 503.00","VW 503.01"=>"VW 503.01","VW 504.00"=>"VW 504.00","VW 505.00"=>"VW 505.00","VW 505.01"=>"VW 505.01","VW 505.02"=>"VW 505.02",
			"VW 506.00"=>"VW 506.00","VW 506.01"=>"VW 506.01","VW 507.00"=>"VW 507.00","VW 508 00"=>"VW 508 00","VW 509 00"=>"VW 509 00","VW 6 speed FWD"=>"VW 6 speed FWD","VW G 002 000"=>"VW G 002 000","VW G 004 000"=>"VW G 004 000",
			"VW G 009 317"=>"VW G 009 317","VW G 052 025 A2"=>"VW G 052 025 A2","VW G 052 162"=>"VW G 052 162","VW G 052 162 A1"=>"VW G 052 162 A1","VW G 052 162 A2"=>"VW G 052 162 A2","VW G 052 162 A6"=>"VW G 052 162 A6","VW G 052 171"=>"VW G 052 171",
			"VW G 052 171 A1"=>"VW G 052 171 A1","VW G 052 171 A2"=>"VW G 052 171 A2","VW G 052 178"=>"VW G 052 178","VW G 052 178 A2"=>"VW G 052 178 A2","VW G 052 180"=>"VW G 052 180","VW G 052 180 A1"=>"VW G 052 180 A1","VW G 052 180 A2"=>"VW G 052 180 A2",
			"VW G 052 180 A6"=>"VW G 052 180 A6","VW G 052 182"=>"VW G 052 182","VW G 052 190"=>"VW G 052 190","VW G 052 196 A2"=>"VW G 052 196 A2","VW G 052 512"=>"VW G 052 512","VW G 052 512 A2"=>"VW G 052 512 A2","VW G 052 515 A2"=>"VW G 052 515 A2",
			"VW G 052 516"=>"VW G 052 516","VW G 052 516 A2"=>"VW G 052 516 A2","VW G 052 527"=>"VW G 052 527","VW G 052 529"=>"VW G 052 529","VW G 052 532"=>"VW G 052 532","VW G 052 533 A2"=>"VW G 052 533 A2","VW G 052 726"=>"VW G 052 726",
			"VW G 052 726 A2"=>"VW G 052 726 A2","VW G 052 798"=>"VW G 052 798","VW G 052 911"=>"VW G 052 911","VW G 052 990"=>"VW G 052 990","VW G 055 005 A1"=>"VW G 055 005 A1","VW G 055 005 A2"=>"VW G 055 005 A2","VW G 055 005 A6"=>"VW G 055 005 A6","VW G 055 025 A2"=>"VW G 055 025 A2",
			"VW G 055 190"=>"VW G 055 190","VW G 055 540 A2"=>"VW G 055 540 A2","VW G 060 162"=>"VW G 060 162","VW G 060 162 A1"=>"VW G 060 162 A1","VW G 060 162 A2"=>"VW G 060 162 A2","VW G 060 162 A6"=>"VW G 060 162 A6",
			"VW G 060 726 A2"=>"VW G 060 726 A2","VW G 070 726 A2"=>"VW G 070 726 A2","VW LT 71141"=>"VW LT 71141","VW TL 52146"=>"VW TL 52146","VW TL 52162"=>"VW TL 52162","VW TL 52171"=>"VW TL 52171","VW TL 52178"=>"VW TL 52178","VW TL 52180"=>"VW TL 52180",
			"VW TL 52182"=>"VW TL 52182","VW TL 52512"=>"VW TL 52512","VW TL 726"=>"VW TL 726","VW TL 727"=>"VW TL 727","VW TL-774C"=>"VW TL-774C (G11)","VW TL-774D"=>"VW TL-774D (G12)","VW TL-774F"=>"VW TL-774F (G12+)","VW TL-774G"=>"VW TL-774G (G12++)",
			"VW TL-774J"=>"VW TL-774J (G13)","VW TL525 77"=>"VW TL525 77","WSS M2C950-A"=>"WSS M2C950-A","ZF S671 090 312"=>"ZF S671 090 312",];
		return $oil_oem;
	}
}
