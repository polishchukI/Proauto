<?php

namespace App\Http\Controllers\Tecdoc;

use DB;

use App\Models\Tecdoc\ModelTecdoc;
use App\Models\Tecdoc\ArticleTecdoc;
use App\Models\Tecdoc\TypeTecdoc;
use App\Models\Tecdoc\SectionTecdoc;
use App\Models\Tecdoc\DesignationTecdoc;
use App\Models\Tecdoc\LinkArtTecdoc;
use App\Models\Tecdoc\LinkGaTecdoc;
use App\Models\Tecdoc\LinkLaTecdoc;
use App\Models\Tecdoc\LinkGraTecdoc;
use App\Models\Tecdoc\LookupTecdoc;
use App\Models\Tecdoc\AddressTecdoc;
use App\Models\Tecdoc\CriteriaTecdoc;
use App\Models\Tecdoc\SupersededTecdoc;
use App\Models\Tecdoc\ManufacturerTecdoc;

use App\Http\Controllers\FunctionsController as Functions;

use Illuminate\Http\Request;

class TecdocController extends Controller
{
	//////////.1
	public static function GetManufs()
	{
		$query = ManufacturerTecdoc::select('MANUFACTURERS.MFA_ID','MANUFACTURERS.MFA_BRAND','MANUFACTURERS.MFA_MFC_CODE','MANUFACTURERS.MFA_PC_MFC','MANUFACTURERS.MFA_CV_MFC');
				if(config('tecdoc_config.CTYPE', "1") == 0)
				{
					$query->where('MFA_PC_MFC','>', 0);
				}
				if (config('tecdoc_config.CTYPE', "1") == 2)
				{
					$query->where('MFA_CV_MFC','>', 0);
				}
				if (config('tecdoc_config.CTYPE', "1") == 1)
				{
					$query->where('MFA_PC_MFC','>', 0);
					$query->where('MFA_CV_MFC','>', 0);
				}
				$query->orderBy('MFA_BRAND', 'ASC');
				$resDB = $query->get()->toArray();
		return $resDB;
	}
	//////////.2
	public static function GetManufByCode($BName)
	{
		$UBrand = strtoupper($BName);
		if ($UBrand == "RENAULT TRUCKS")
		{
			
		}
		else
		{
			if (0 < strpos($UBrand, "-TRUCKS"))
			{
				$UBrand = str_replace("-TRUCKS", "", $UBrand);
			}
			else
			{
				if (0 < strpos($UBrand, "TRUCKS"))
				{
					$UBrand = str_replace("TRUCKS", "", $UBrand);
				}
			}
		}
		$arUBrand = explode(" ", $UBrand);
		if (1 < count($arUBrand))
		{
			$resDB = ManufacturerTecdoc::select('MANUFACTURERS.MFA_ID','MANUFACTURERS.MFA_BRAND','MANUFACTURERS.MFA_MFC_CODE')
					->where('MFA_BRAND', 'LIKE', '%' . implode("%", $arUBrand) . '%')
					->orderBy('MANUFACTURERS.MFA_BRAND', 'ASC')
					->get()->toArray();
		}
		else
		{
			$resDB = ManufacturerTecdoc::select('MANUFACTURERS.MFA_ID','MANUFACTURERS.MFA_BRAND','MANUFACTURERS.MFA_MFC_CODE')
					->orderBy('MANUFACTURERS.MFA_BRAND', 'ASC')
					->where('MFA_BRAND', '=', $arUBrand)
					->get()->toArray();
		}
        return $resDB;
    }
	///////////.2.5
	public static function GetManufacturerByID($id)
	{
		$resDB = ManufacturerTecdoc::select('MANUFACTURERS.MFA_ID','MANUFACTURERS.MFA_BRAND','MANUFACTURERS.MFA_MFC_CODE')
				->orderBy('MANUFACTURERS.MFA_BRAND', 'ASC')
				->where('MFA_ID', '=', $id)
				->get()->toArray();
		return $resDB;
    }
	
    //////////.3
	public static function GetModels($MFA_ID, $arFilter = [], $Not, $YearFrom = 0, $CarsTrucks = 0, $ModYear = false)
	{
		$query = ModelTecdoc::select('MODELS.MOD_ID', 'MODELS.MOD_PCON_START', 'MODELS.MOD_PCON_END','TEX_TEXT AS MOD_CDS_TEXT','MANUFACTURERS.MFA_BRAND')
                ->join('COUNTRY_DESIGNATIONS', 'MODELS.MOD_CDS_ID', '=', 'CDS_ID')
                ->join('DES_TEXTS', 'TEX_ID', '=', 'CDS_TEX_ID')
                ->join('MANUFACTURERS', 'MANUFACTURERS.MFA_ID', '=', 'MODELS.MOD_MFA_ID')
                ->where('MOD_MFA_ID', '=', $MFA_ID)
                ->where('CDS_LNG_ID', '=', "4");
				if(intval(config('tecdoc_config.HIDE_USA')) == 1)
				{
					$query->whereRaw('TEX_TEXT NOT LIKE "%[USA]%"');
				}
				if(0 < $CarsTrucks)
				{
					if ($CarsTrucks == 1)
					{
						$query->where('MOD_PC','>','0');
					}
					else
					{
						$query->where('MOD_CV', '>','0');
					}
				}
				////////////////////////
				if (0 < count($arFilter))
				{
					if ($Not == 1)
					{
						$query->whereNotIn('MOD_ID', implode(",", $arFilter));
					}
					else
					{
						$query->whereIn('MOD_ID', implode(",", $arFilter));
					}
				}
				///////////////////////
				if (0 < $ModYear)
				{
					$query->whereRaw("MOD_PCON_START <= " . $ModYear . "99 AND (MOD_PCON_END >= " . $ModYear . "00 OR MOD_PCON_END IS NULL)");
				}
				else
				{
					if ($ModYear == -1)
					{
						$MOD_PCON = "";
					}
					else
					{
						if ($YearFrom <= 0)
						{
							$query->where('MODELS.MOD_PCON_START', '>', config('tecdoc_config.MODELS_FROM', "1970") . "00");
						}
						else
						{
							$query->where('MODELS.MOD_PCON_START', '>', $YearFrom . "00");
						}
					}
				}
				$query->orderBy('MOD_CDS_TEXT', 'ASC');
				$resDB = $query->get()->toArray();
        return $resDB;
    }
	//////////.4
	public static function GetModelByID($MFA_ID, $MOD_ID)
    {
		$resDB = ModelTecdoc::select('MOD_ID','TEX_TEXT AS MOD_CDS_TEXT','MOD_PCON_START','MOD_PCON_END')
				->join('COUNTRY_DESIGNATIONS', 'CDS_ID', '=', 'MOD_CDS_ID')
				->join('DES_TEXTS', 'TEX_ID', '=', 'CDS_TEX_ID')
				->where('MOD_MFA_ID', '=', $MFA_ID)
				->where('MOD_ID', '=', $MOD_ID)
				->where('CDS_LNG_ID', '=', config('tecdoc_config.LANG_ID', "16"))
				->get()->toArray();
		return $resDB;
    }
	//////////.5
    public static function GetTypes($MOD_ID)
    {
		//INNER JOIN LINK_LA_TYP ON LAT_TYP_ID = " . $TYP_ID . " AND LAT_GA_ID = LGS_GA_ID
		//->join('LINK_LA_TYP', function($join) use ($TYP_ID){$join->on('LAT_GA_ID','=','LGS_GA_ID')->where('LAT_TYP_ID','=',$TYP_ID);})
		$resDB = TypeTecdoc::select('TYP_ID','DES_TEXTS.TEX_TEXT AS TYP_CDS_TEXT','TYP_PCON_START','TYP_PCON_END','TYP_CCM','TYP_KW_FROM','TYP_HP_FROM','TYP_CYLINDERS',
				'ENGINES.ENG_CODE',
				'DES_TEXTS2.TEX_TEXT AS TYP_ENGINE_DES_TEXT',
				'DES_TEXTS3.TEX_TEXT AS TYP_FUEL_DES_TEXT',
				DB::raw('IFNULL(DES_TEXTS4.TEX_TEXT, DES_TEXTS5.TEX_TEXT) AS TYP_BODY_DES_TEXT'),
				'DES_TEXTS6.TEX_TEXT AS TYP_AXLE_DES_TEXT')
				
				->leftjoin('LINK_TYP_ENG','LINK_TYP_ENG.LTE_TYP_ID','=','TYPES.TYP_ID')
				->leftjoin('ENGINES','ENGINES.ENG_ID', '=', 'LINK_TYP_ENG.LTE_ENG_ID')
				->join('COUNTRY_DESIGNATIONS', function ($join) {$join->on('COUNTRY_DESIGNATIONS.CDS_ID', '=', 'TYP_CDS_ID')->where('COUNTRY_DESIGNATIONS.CDS_LNG_ID', '=', config('tecdoc_config.LANG_ID', "16"));})
				->join('DES_TEXTS','DES_TEXTS.TEX_ID','=','COUNTRY_DESIGNATIONS.CDS_TEX_ID')
				->leftjoin('DESIGNATIONS AS DESIGNATIONS3', function ($join) {$join->on('DESIGNATIONS3.DES_ID', '=', 'TYP_KV_BODY_DES_ID')->where('DESIGNATIONS3.DES_LNG_ID', '=', config('tecdoc_config.LANG_ID', "16"));})
				->leftjoin('DES_TEXTS AS DES_TEXTS4','DES_TEXTS4.TEX_ID','=','DESIGNATIONS3.DES_TEX_ID')
				->leftjoin('DESIGNATIONS AS DESIGNATIONS5', function ($join) {$join->on('DESIGNATIONS5.DES_ID', '=', 'TYP_KV_AXLE_DES_ID')->where('DESIGNATIONS5.DES_LNG_ID', '=', config('tecdoc_config.LANG_ID', "16"));})
				->leftjoin('DES_TEXTS AS DES_TEXTS6','DES_TEXTS6.TEX_ID','=','DESIGNATIONS5.DES_TEX_ID')
				->leftjoin('DESIGNATIONS', function ($join) {$join->on('DESIGNATIONS.DES_ID', '=', 'TYP_KV_ENGINE_DES_ID')->where('DESIGNATIONS.DES_LNG_ID', '=', config('tecdoc_config.LANG_ID', "16"));})
				->leftjoin('DES_TEXTS AS DES_TEXTS2','DES_TEXTS2.TEX_ID','=','DESIGNATIONS.DES_TEX_ID')				
				->leftjoin('DESIGNATIONS AS DESIGNATIONS2', function ($join) {$join->on('DESIGNATIONS2.DES_ID', '=', 'TYP_KV_FUEL_DES_ID')->where('DESIGNATIONS2.DES_LNG_ID', '=', config('tecdoc_config.LANG_ID', "16"));})
				->leftjoin('DES_TEXTS AS DES_TEXTS3','DES_TEXTS3.TEX_ID','=','DESIGNATIONS2.DES_TEX_ID')
				->leftjoin('DESIGNATIONS AS DESIGNATIONS4', function ($join) {$join->on('DESIGNATIONS4.DES_ID', '=', 'TYP_KV_MODEL_DES_ID')->where('DESIGNATIONS4.DES_LNG_ID', '=', config('tecdoc_config.LANG_ID', "16"));})
				->leftjoin('DES_TEXTS AS DES_TEXTS5','DES_TEXTS5.TEX_ID','=','DESIGNATIONS4.DES_TEX_ID')
				
				->where('TYP_MOD_ID', '=', $MOD_ID)
				->orderBy('TYP_CDS_TEXT', 'asc')
				->orderBy('TYPES.TYP_PCON_START', 'asc')
				->orderBy('TYPES.TYP_CCM', 'asc')
				->get()->toArray();
			return $resDB;
    }
	//////////.6
    public static function GetTypeByID($MOD_ID, $TYP_ID)
    {
		$resDB = TypeTecdoc::select('TYP_ID',
				'DES_TEXTS.TEX_TEXT AS TYP_CDS_TEXT',
				'TYP_PCON_START',
				'TYP_PCON_END',
				'TYP_CCM',
				'TYP_KW_FROM',
				'TYP_HP_FROM',
				'TYP_CYLINDERS',
				'TYP_VALVES',
				'ENGINES.ENG_CODE',
				'DES_TEXTS2.TEX_TEXT AS TYP_ENGINE_DES_TEXT',
				'DES_TEXTS3.TEX_TEXT AS TYP_FUEL_DES_TEXT',
				DB::raw('IFNULL(DES_TEXTS4.TEX_TEXT, DES_TEXTS5.TEX_TEXT) AS TYP_BODY_DES_TEXT'),
				'DES_TEXTS6.TEX_TEXT AS TYP_AXLE_DES_TEXT',
				DB::raw('IFNULL( DT_BODY_EN1.TEX_TEXT, DT_BODY_EN2.TEX_TEXT ) AS BODY_EN'),
				'DT_FUEL_EN.TEX_TEXT AS FUEL_EN',
				'DES_TEXTS6.TEX_TEXT AS TYP_AXLE_DES_TEXT')
				
				->join('COUNTRY_DESIGNATIONS', function ($join) {$join->on('COUNTRY_DESIGNATIONS.CDS_ID', '=', 'TYP_CDS_ID')->where('COUNTRY_DESIGNATIONS.CDS_LNG_ID', '=', config('tecdoc_config.LANG_ID', "16"));})
				->join('DES_TEXTS','DES_TEXTS.TEX_ID','=','COUNTRY_DESIGNATIONS.CDS_TEX_ID')

				->leftjoin('DESIGNATIONS', function ($join) {$join->on('DESIGNATIONS.DES_ID', '=', 'TYP_KV_ENGINE_DES_ID')->where('DESIGNATIONS.DES_LNG_ID', '=', config('tecdoc_config.LANG_ID', "16"));})
				->leftjoin('DES_TEXTS AS DES_TEXTS2','DES_TEXTS2.TEX_ID','=','DESIGNATIONS.DES_TEX_ID')	
				
				->leftjoin('DESIGNATIONS AS DESIGNATIONS2', function ($join) {$join->on('DESIGNATIONS2.DES_ID', '=', 'TYP_KV_FUEL_DES_ID')->where('DESIGNATIONS2.DES_LNG_ID', '=', config('tecdoc_config.LANG_ID', "16"));})
				->leftjoin('DES_TEXTS AS DES_TEXTS3','DES_TEXTS3.TEX_ID','=','DESIGNATIONS2.DES_TEX_ID')

				->leftjoin('LINK_TYP_ENG','LINK_TYP_ENG.LTE_TYP_ID','=','TYPES.TYP_ID')
				->leftjoin('ENGINES','ENGINES.ENG_ID', '=', 'LINK_TYP_ENG.LTE_ENG_ID')
				
				->leftjoin('DESIGNATIONS AS DESIGNATIONS3', function ($join) {$join->on('DESIGNATIONS3.DES_ID', '=', 'TYP_KV_BODY_DES_ID')->where('DESIGNATIONS3.DES_LNG_ID', '=', config('tecdoc_config.LANG_ID', "16"));})
				->leftjoin('DES_TEXTS AS DES_TEXTS4','DES_TEXTS4.TEX_ID','=','DESIGNATIONS3.DES_TEX_ID')
				
				->leftjoin('DESIGNATIONS AS DESIGNATIONS4', function ($join) {$join->on('DESIGNATIONS4.DES_ID', '=', 'TYP_KV_MODEL_DES_ID')->where('DESIGNATIONS4.DES_LNG_ID', '=', config('tecdoc_config.LANG_ID', "16"));})
				->leftjoin('DES_TEXTS AS DES_TEXTS5','DES_TEXTS5.TEX_ID','=','DESIGNATIONS4.DES_TEX_ID')

				->leftjoin('DESIGNATIONS AS DESIGNATIONS5', function ($join) {$join->on('DESIGNATIONS5.DES_ID', '=', 'TYP_KV_AXLE_DES_ID')->where('DESIGNATIONS5.DES_LNG_ID', '=', config('tecdoc_config.LANG_ID', "16"));})
				->leftjoin('DES_TEXTS AS DES_TEXTS6','DES_TEXTS6.TEX_ID','=','DESIGNATIONS5.DES_TEX_ID')
				//////
				->leftjoin('DESIGNATIONS AS DS_BODY_EN1', function ($join) {$join->on('DS_BODY_EN1.DES_ID', '=', 'TYP_KV_BODY_DES_ID')->where('DS_BODY_EN1.DES_LNG_ID', '=', 4);})
				->leftjoin('DES_TEXTS AS DT_BODY_EN1','DT_BODY_EN1.TEX_ID','=','DS_BODY_EN1.DES_TEX_ID')
				->leftjoin('DESIGNATIONS AS DS_BODY_EN2', function ($join) {$join->on('DS_BODY_EN2.DES_ID', '=', 'TYP_KV_MODEL_DES_ID')->where('DS_BODY_EN2.DES_LNG_ID', '=', 4);})
				->leftjoin('DES_TEXTS AS DT_BODY_EN2','DT_BODY_EN2.TEX_ID','=','DS_BODY_EN2.DES_TEX_ID')
				->leftjoin('DESIGNATIONS AS DS_FUEL_EN', function ($join) {$join->on('DS_FUEL_EN.DES_ID', '=', 'TYP_KV_FUEL_DES_ID')->where('DS_FUEL_EN.DES_LNG_ID', '=', 4);})
				->leftjoin('DES_TEXTS AS DT_FUEL_EN','DT_FUEL_EN.TEX_ID','=','DS_FUEL_EN.DES_TEX_ID')
				//////
				->where('TYP_MOD_ID', '=', $MOD_ID)
				->where('TYP_ID', '=', $TYP_ID)
				->orderBy('TYP_CDS_TEXT', 'asc')
				->orderBy('TYPES.TYP_PCON_START', 'asc')
				->orderBy('TYPES.TYP_CCM', 'asc')
				->get()->toArray();
				
		// dd($resDB);
		return $resDB;
	}
	
	//////////.7
	public static function GetSectionsRoot($Parent)
	{
		$resDB = SectionTecdoc::select('STR_ID','TEX_TEXT AS STR_DES_TEXT')
				->join('DESIGNATIONS','DES_ID','=','STR_DES_ID')
				->join('DES_TEXTS','TEX_ID','=','DES_TEX_ID')
				->where('STR_ID_PARENT', '<=>', $Parent)
				->where('DES_LNG_ID', '=', config('tecdoc_config.LANG_ID', "16"))
				->orderBy('STR_DES_TEXT', 'ASC')
				->get()->toArray();
        return $resDB;
    }
	
	//////////.8
    public static function GetSectionData($SID)
	{
		$resDB = SectionTecdoc::select('STR_ID','STR_ID_PARENT','STR_LEVEL','TEX_TEXT AS STR_DES_TEXT')
				->join('DESIGNATIONS','DES_ID','=','STR_DES_ID')
				->join('DES_TEXTS','TEX_ID','=','DES_TEX_ID')
				->where('STR_ID', '<=>', $SID)
				->where('DES_LNG_ID', '=', config('tecdoc_config.LANG_ID', "16"))
				->get()->toArray();
		return $resDB;
	}
	
	//////////.9
	public static function GetSections($TYP_ID, $PARENT, $ORDER = "STR_SORT")
	{
		$query = SectionTecdoc::select('STR_ID','TEX_TEXT AS STR_DES_TEXT','STR_LEVEL','STR_ID_PARENT AS PID',DB::raw('IF(EXISTS(SELECT * FROM SEARCH_TREE AS SEARCH_TREE2 WHERE SEARCH_TREE2.STR_ID_PARENT <=> SEARCH_TREE.STR_ID LIMIT 1), 1, 0) AS DESCENDANTS'))
				->join('DESIGNATIONS','DES_ID','=','STR_DES_ID')
				->join('DES_TEXTS','TEX_ID','=','DES_TEX_ID')
				->where('STR_ID_PARENT', '<=>', $PARENT)
				->where('STR_ID', '<>', '13771')// moto section off
				->where('DES_LNG_ID', '=', config('tecdoc_config.LANG_ID', "16"));
				if(0 < $TYP_ID)
				{
					$query->whereRaw('EXISTS(SELECT * FROM LINK_GA_STR INNER JOIN LINK_LA_TYP ON LAT_TYP_ID = ' . $TYP_ID . ' AND LAT_GA_ID = LGS_GA_ID INNER JOIN LINK_ART ON LA_ID = LAT_LA_ID WHERE LGS_STR_ID = STR_ID LIMIT 1)');
				}
				$query->orderBy($ORDER, 'ASC');
				$resDB = $query->get()->toArray();
		return $resDB;
	}
	
	//////////.10
    public static function GetSectionParts($TYP_ID, $SID)
	{
		//INNER JOIN LINK_LA_TYP ON LAT_TYP_ID = " . $TYP_ID . " AND LAT_GA_ID = LGS_GA_ID
		//->join('LINK_LA_TYP', function($join) use ($TYP_ID){$join->on('LAT_GA_ID','=','LGS_GA_ID')->where('LAT_TYP_ID','=',$TYP_ID);})
		$resDB = LinkGaTecdoc::select('ART_ID AS aid','ART_ARTICLE_NR AS article','SUP_BRAND AS brand','ART_COUNTRY_SPECIFICS.ACS_KV_STATUS AS STATUS','DES_TEXTS.TEX_TEXT AS td_name')
				->join('LINK_LA_TYP', function($join) use ($TYP_ID){$join->on('LAT_GA_ID','=','LGS_GA_ID')->where('LAT_TYP_ID','=',$TYP_ID);})
				->join('LINK_ART','LINK_ART.LA_ID','=','LINK_LA_TYP.LAT_LA_ID')
				->join('ART_COUNTRY_SPECIFICS','ART_COUNTRY_SPECIFICS.ACS_ART_ID','=','LA_ART_ID')
				->join('ARTICLES','ART_ID','=','LA_ART_ID')
				->join('DESIGNATIONS','DESIGNATIONS.DES_ID','=','ART_COMPLETE_DES_ID')
				->join('DES_TEXTS','DES_TEXTS.TEX_ID','=','DESIGNATIONS.DES_TEX_ID')
				->join('SUPPLIERS','SUP_ID','=','ART_SUP_ID')
				->where('LGS_STR_ID', '=', $SID)
				->where('LINK_LA_TYP.LAT_TYP_ID', '=', $TYP_ID)
				->whereIn('ART_COUNTRY_SPECIFICS.ACS_KV_STATUS', config('tecdoc_config.COUNTRY_SPECIFICS', ["0","1","7","11"]))
				->where('DES_LNG_ID', '=', config('tecdoc_config.LANG_ID', "16"))
				->orderBy('aid','ASC')
				->get()->toArray();
		return $resDB;
    }
	
	public static function GetOrigsByIDs($arARTIDs, $ManufID = 0, $OnlyCurrentBra = true)
	{
		$query = LookupTecdoc::select('ART_LOOKUP.ARL_DISPLAY_NR AS ORIGINAL_ARTICLE','BRANDS.BRA_BRAND AS ORIGINAL_BRAND','BRANDS.BRA_MFC_CODE AS ORIGINAL_BRAND_CODE','ARL_ART_ID AS aid')
				->leftJoin('BRANDS','BRANDS.BRA_ID','=','ART_LOOKUP.ARL_BRA_ID')
				->whereIn('ARL_ART_ID', $arARTIDs)
				->where('ARL_KIND', '=', 3);
				if($OnlyCurrentBra && $ManufID)
				{
					$query->where('ARL_BRA_ID', $ManufID);
				}
		$resDB = $query->distinct()->get()->toArray();
		return $resDB;
	}
	
	public static function SearchNumber($Number)
	{
		$resDB = [];
		$resDB = LookupTecdoc::select('ART_LOOKUP.ARL_SEARCH_NUMBER AS article','ART_LOOKUP.ARL_KIND AS kind','ART_LOOKUP.ARL_ART_ID AS aid','ART_COUNTRY_SPECIFICS.ACS_KV_STATUS AS STATUS',
				'DES_TEXTS.TEX_TEXT AS td_name','ART_LOOKUP.ARL_BRA_ID AS BRA_ID',
				DB::raw('IF (ART_LOOKUP.ARL_KIND IN ("3", "4"), BRANDS.BRA_BRAND, SUPPLIERS.SUP_BRAND) AS brand'))
				->leftjoin('BRANDS','BRANDS.BRA_ID', '=', 'ART_LOOKUP.ARL_BRA_ID')
				->join('ARTICLES','ARTICLES.ART_ID','=','ART_LOOKUP.ARL_ART_ID')
				->join('SUPPLIERS','SUPPLIERS.SUP_ID','=','ARTICLES.ART_SUP_ID')
				->join('DESIGNATIONS','DESIGNATIONS.DES_ID','=','ARTICLES.ART_COMPLETE_DES_ID')
				->join('DES_TEXTS','DES_TEXTS.TEX_ID','=','DESIGNATIONS.DES_TEX_ID')
				->join('ART_COUNTRY_SPECIFICS','ART_COUNTRY_SPECIFICS.ACS_ART_ID','=','ART_LOOKUP.ARL_ART_ID')
				->whereIn('ART_LOOKUP.ARL_KIND', ["1","2","3","4"])
				->where('ARL_SEARCH_NUMBER', '=', $Number)
				->whereIn('ART_COUNTRY_SPECIFICS.ACS_KV_STATUS', config('tecdoc_config.COUNTRY_SPECIFICS', ["0","1","7","11"]))
				->where('DESIGNATIONS.DES_LNG_ID', '=', config('tecdoc_config.LANG_ID', "16"))
				->orderBy('ARL_KIND', 'DESC')
				->get();
				if($resDB)
				{
					$resDB = $resDB->toArray();
				}
		return $resDB;
	}

    public static function SearchBrandNumber($Brand, $Number)
	{
		$resDB = [];
		if ($Brand == "" || $Number == "")
		{
			return false;
		}
		if (config('tecdoc_config.HIDE_TRADE', "true"))
		{
			$NumberTypes = "((1, 1), (1, 3),(2, 1), (2, 3),(3, 1), (3, 3),";
		}
		else
		{
			$NumberTypes = "((1, 1), (1, 2), (1, 3),(2, 1), (2, 2), (2, 3),(3, 1), (3, 2), (3, 3),";
		}
		//INNER JOIN LINK_LA_TYP ON LAT_TYP_ID = " . $TYP_ID . " AND LAT_GA_ID = LGS_GA_ID
		//->join('LINK_LA_TYP', function($join) use ($TYP_ID){$join->on('LAT_GA_ID','=','LGS_GA_ID')->where('LAT_TYP_ID','=',$TYP_ID);})
		$resDB = LookupTecdoc::select('ARTICLES.ART_ID AS aid',
				DB::raw('IF( ART_LOOKUP2.ARL_KIND = 3, BRANDS2.BRA_BRAND, SUPPLIERS2.SUP_BRAND ) AS brand'),
				DB::raw('IF( ART_LOOKUP2.ARL_KIND = 3, BRANDS2.BRA_MFC_CODE, SUPPLIERS2.SUP_BRAND ) AS BRAND_CODE'),
				DB::raw('IF( ART_LOOKUP2.ARL_KIND IN ( 2, 3 ), ART_LOOKUP2.ARL_DISPLAY_NR, ARTICLES2.ART_ARTICLE_NR ) AS article'),
				'ART_LOOKUP2.ARL_KIND AS kind',
				'ART_COUNTRY_SPECIFICS.ACS_KV_STATUS AS STATUS',
				'DES_TEXTS.TEX_TEXT AS td_name')
				->join('ART_COUNTRY_SPECIFICS','ART_COUNTRY_SPECIFICS.ACS_ART_ID','=','ART_LOOKUP.ARL_ART_ID')
				->leftjoin('BRANDS','BRANDS.BRA_ID','=','ART_LOOKUP.ARL_BRA_ID')
				->join('ARTICLES','ARTICLES.ART_ID','=','ART_LOOKUP.ARL_ART_ID')
				->join('SUPPLIERS','SUPPLIERS.SUP_ID','=','ARTICLES.ART_SUP_ID')
				->join('ART_LOOKUP AS ART_LOOKUP2','ART_LOOKUP2.ARL_ART_ID','=','ART_LOOKUP.ARL_ART_ID')
				->leftjoin('BRANDS AS BRANDS2','BRANDS2.BRA_ID','=','ART_LOOKUP2.ARL_BRA_ID')
				->join('ARTICLES AS ARTICLES2','ARTICLES2.ART_ID','=','ART_LOOKUP2.ARL_ART_ID')
				->join('SUPPLIERS AS SUPPLIERS2','SUPPLIERS2.SUP_ID','=','ARTICLES2.ART_SUP_ID')
				->join('DESIGNATIONS','DESIGNATIONS.DES_ID','=','ARTICLES.ART_COMPLETE_DES_ID')
				->join('DES_TEXTS','DES_TEXTS.TEX_ID','=','DESIGNATIONS.DES_TEX_ID')
				->where('ART_LOOKUP.ARL_SEARCH_NUMBER', '=', $Number)
				->whereIn('ART_COUNTRY_SPECIFICS.ACS_KV_STATUS', config('tecdoc_config.COUNTRY_SPECIFICS', ["0","1","7","11"]))
				->where('DESIGNATIONS.DES_LNG_ID', '=', config('tecdoc_config.LANG_ID', "16"))
				->whereRaw('(ART_LOOKUP.ARL_KIND IN ( 3, 4 ) AND BRANDS.BRA_BRAND = "' . $Brand . '" OR ART_LOOKUP.ARL_KIND IN ( 1, 2 ) AND SUPPLIERS.SUP_BRAND = "' . $Brand . '")')
				->whereRaw('( ART_LOOKUP.ARL_KIND, ART_LOOKUP2.ARL_KIND ) IN (( 1, 1 ),( 1, 2 ),( 1, 3 ),( 2, 1 ),( 2, 2 ),( 2, 3 ),( 3, 1 ),( 3, 2 ),( 3, 3 ),( 4, 1 ))')
				->orderBy('kind', 'DESC')
				->orderBy('brand', 'ASC')
				->orderBy('article', 'ASC')
				->distinct()
				->get();
				if($resDB)
				{
					$resDB = $resDB->toArray();
				}
		return $resDB;
	}
	
	public static function GetProperties($ART_ID)
	{
		$resDB = CriteriaTecdoc::select('ACR_ART_ID AS aid',
				'ACR_CRI_ID AS CRID',
				'DES_TEXTS.TEX_TEXT AS name',
				'TEX_EN.TEX_TEXT AS EN',
				DB::raw('IFNULL(DES_TEXTS2.TEX_TEXT, ACR_VALUE) AS VALUE'))
				->leftjoin('DESIGNATIONS AS DESIGNATIONS2','DESIGNATIONS2.DES_ID','=','ACR_KV_DES_ID')
				->leftjoin('DES_TEXTS AS DES_TEXTS2','DES_TEXTS2.TEX_ID','=','DESIGNATIONS2.DES_TEX_ID')
				->leftjoin('CRITERIA','CRI_ID','=','ACR_CRI_ID')
				->leftjoin('DESIGNATIONS','DESIGNATIONS.DES_ID','=','CRI_DES_ID')
				->leftjoin('DES_TEXTS','DES_TEXTS.TEX_ID','=','DESIGNATIONS.DES_TEX_ID')
				//en
				->join('DESIGNATIONS AS DES_EN','DES_EN.DES_ID','=','CRI_DES_ID')
				->join('DES_TEXTS AS TEX_EN','TEX_EN.TEX_ID','=','DES_EN.DES_TEX_ID')
				->where('DES_EN.DES_LNG_ID', '=', '4')
				//en
				->whereRaw('(DESIGNATIONS.DES_LNG_ID IS NULL OR DESIGNATIONS.DES_LNG_ID = "' . config('tecdoc_config.LANG_ID', "16") . '" )')
				->whereRaw('(DESIGNATIONS2.DES_LNG_ID IS NULL OR DESIGNATIONS2.DES_LNG_ID = "' . config('tecdoc_config.LANG_ID', "16") . '" )')
				->where('ACR_ART_ID', '=', $ART_ID)
				->distinct()
				->get()->toArray();
		return $resDB;
    }
	
	// public static function GetPropertiesUnion($arARTIDs, $AID_included = true)
	public static function GetPropertiesUnion($arARTIDs)
	{
		$resDB = CriteriaTecdoc::select('ACR_ART_ID AS aid','ACR_CRI_ID AS CRID','DES_TEXTS.TEX_TEXT AS name','ACR_SORT','TEX_EN.TEX_TEXT AS EN', DB::raw('IFNULL(DES_TEXTS2.TEX_TEXT, ACR_VALUE) AS VALUE'))
				->leftjoin('DESIGNATIONS AS DESIGNATIONS2','DESIGNATIONS2.DES_ID','=','ACR_KV_DES_ID')
				->leftjoin('DES_TEXTS AS DES_TEXTS2','DES_TEXTS2.TEX_ID','=','DESIGNATIONS2.DES_TEX_ID')
				->leftjoin('CRITERIA','CRI_ID','=','ACR_CRI_ID')
				->leftjoin('DESIGNATIONS','DESIGNATIONS.DES_ID','=','CRI_DES_ID')
				->leftjoin('DES_TEXTS','DES_TEXTS.TEX_ID','=','DESIGNATIONS.DES_TEX_ID')
				->join('DESIGNATIONS AS DES_EN','DES_EN.DES_ID','=','CRI_DES_ID')
				->join('DES_TEXTS AS TEX_EN','TEX_EN.TEX_ID','=','DES_EN.DES_TEX_ID')
				->where('DES_EN.DES_LNG_ID', '=', '4')
				->where('ACR_DISPLAY', '=', '1')
				->whereIn('ACR_ART_ID', $arARTIDs)
				->whereRaw('(DESIGNATIONS.DES_LNG_ID IS NULL OR DESIGNATIONS.DES_LNG_ID = "' . config('tecdoc_config.LANG_ID', "16") . '" )')
				->whereRaw('(DESIGNATIONS2.DES_LNG_ID IS NULL OR DESIGNATIONS2.DES_LNG_ID = "' . config('tecdoc_config.LANG_ID', "16") . '" )')// AND ACR_DISPLAY = 1')
				->orderBy('ACR_SORT', 'ASC')
				->distinct()
				->get()->toArray();
		return $resDB;
	}
	
	public static function ImagesAvialable($arARTIDs)
	{
		$arImgArts = [];
		$ARTs = $arARTIDs;
		$resDB = LinkGraTecdoc::select('LGA_ART_ID')
				->join('GRAPHICS','GRA_ID','=','LGA_GRA_ID')
				->join('DOC_TYPES','DOC_TYPE','=','GRA_DOC_TYPE')
				->whereIn('LGA_ART_ID', $ARTs)
				->whereNotIn('GRA_DOC_TYPE', ["1","2"])
				->get();
				if($resDB)
				{
					$resDB = $resDB->toArray();
					foreach ($resDB as $arDB)
					{
						$arImgArts[] = $arDB["LGA_ART_ID"];
					}
				}

		return $arImgArts;
	}

    public static function GetImagesUnion($arARTIDs)
	{
		if (is_array($arARTIDs) && 0 < count($arARTIDs))
		{
			$arARTIDs = array_unique($arARTIDs);
			$i = 0;
			foreach ($arARTIDs as $ART_ID)
			{
				$q = LinkGraTecdoc::select('LGA_ART_ID AS aid', DB::raw('CONCAT("http://boschautoparts.pp.ua/images/", GRA_TAB_NR, "/", GRA_GRD_ID, ".", IF(LOWER(DOC_EXTENSION)="jp2", "jpg", LOWER(DOC_EXTENSION))) AS PATH'))
						->join('GRAPHICS','GRA_ID','=','LGA_GRA_ID')
						->join('DOC_TYPES','DOC_TYPE','=','GRA_DOC_TYPE')
						->where('LGA_ART_ID', '=', $ART_ID)
						->whereRaw('(GRA_LNG_ID = ' . config('tecdoc_config.LANG_ID', "16") . ' OR GRA_LNG_ID = 255)')
						->whereNotIn('GRA_DOC_TYPE', ["1","2"]);
						if($i < 1)
						{
							$resDB = $q;
						}
						else
						{
							$resDB->union($q);
						}
						$i++;
			}
			$resDB = $resDB->get()->toArray();
			return $resDB;
		}
		else
		{
			return false;
		}
	}
	
    public static function GetArtsLogoUnion($arARTIDs)
	{
		$AIDs = implode(",", $arARTIDs);
		$resDB = ArticleTecdoc::select('ART_ID AS aid',DB::raw('CONCAT("http://boschautoparts.pp.ua/images/logos/", SUP_BRAND, ".png") AS PATH'))
				->join('SUPPLIERS','SUP_ID','=','ART_SUP_ID')
				->whereIn('ART_ID', [$AIDs])
				->get()->toArray();
		return $resDB;
	}
	
	static public function GetPartByPKEY($bkey, $akey)
	{
		$resDB = LookupTecdoc::select('ART_LOOKUP.ARL_SEARCH_NUMBER AS article',
				'ART_LOOKUP.ARL_KIND AS kind',
				'ARTICLES.ART_ID AS aid',
				'DES_TEXTS.TEX_TEXT AS td_name',
				DB::raw('IF (ART_LOOKUP.ARL_KIND IN (3, 4), BRANDS.BRA_BRAND, SUPPLIERS.SUP_BRAND) AS brand'))
		->leftjoin('BRANDS','BRANDS.BRA_ID','=','ART_LOOKUP.ARL_BRA_ID')
		->leftjoin('ARTICLES','ARTICLES.ART_ID','=','ART_LOOKUP.ARL_ART_ID')
		->leftjoin('SUPPLIERS','SUPPLIERS.SUP_ID','=','ARTICLES.ART_SUP_ID')
		->leftjoin('DESIGNATIONS','DESIGNATIONS.DES_ID','=','ARTICLES.ART_COMPLETE_DES_ID')
		->leftjoin('DES_TEXTS','DES_TEXTS.TEX_ID','=','DESIGNATIONS.DES_TEX_ID')
		->where('DESIGNATIONS.DES_LNG_ID', '=', config('tecdoc_config.LANG_ID', "16"))
		->whereIn('ARL_KIND', ["1","2","3","4"])
		->where('ART_LOOKUP.ARL_SEARCH_NUMBER', '=', $akey)
		->orderBy('ARL_KIND', 'DESC')
		->distinct()->get()->toArray();
		foreach ($resDB as $arDB)
		{
			$CurBKEY = Functions::SingleKey($arDB["brand"], true);
			if (!($CurBKEY == $bkey))
			{
				continue;
			}
		return $arDB;
		}
		return [];
	}
	
	public static function GetSuperseded($arARTIDs)
	{
		if (is_array($arARTIDs) && 0 < count($arARTIDs))
		{
			$arARTIDs = array_unique($arARTIDs);
			$i = 0;
			foreach ($arARTIDs as $aid)
			{
				$q = SupersededTecdoc::select('SUA_ART_ID AS aid','SUA_NUMBER AS NEW_ARTICLE')
						->where('SUA_ART_ID','=', $aid);
						if($i < 1)
						{
							$resDB = $q;
						}
						else
						{
							$resDB->union($q);
						}
						$i++;
			}
			$resDB = $resDB->get()->toArray();
		return $resDB;
		}
	}
	
	public static function GetAppCriteriaUnion($arARTIDs, $TYP_ID)
	{
		// " . "LEFT JOIN DESIGNATIONS ON DESIGNATIONS.DES_ID = CRI_SHORT_DES_ID " . "AND DESIGNATIONS.DES_LNG_ID = " . $LNG_ID . "
		// " . "LEFT JOIN DESIGNATIONS DESIGNATIONS2 ON DESIGNATIONS2.DES_ID = LAC_KV_DES_ID " . "AND DESIGNATIONS2.DES_LNG_ID = " . $LNG_ID . "
		$resDB = LinkLaTecdoc::select('LA_ART_ID AS aid','DES_TEXTS.TEX_TEXT AS CRITERIA',DB::raw('IFNULL(DES_TEXTS2.TEX_TEXT, LAC_VALUE) AS VALUE'))
				->join('LINK_ART','LA_ID','=','LAT_LA_ID')
				->leftjoin('LA_CRITERIA','LAC_LA_ID','=','LA_ID')
				->leftjoin('CRITERIA','CRI_ID','=','LAC_CRI_ID')
				->leftjoin('DESIGNATIONS','DESIGNATIONS.DES_ID','=','CRI_SHORT_DES_ID')
				->leftjoin('DES_TEXTS','DES_TEXTS.TEX_ID','=','DESIGNATIONS.DES_TEX_ID')
				->leftjoin('DESIGNATIONS AS DESIGNATIONS2','DESIGNATIONS2.DES_ID','=','LAC_KV_DES_ID')
				->leftjoin('DES_TEXTS AS DES_TEXTS2','DES_TEXTS2.TEX_ID','=','DESIGNATIONS2.DES_TEX_ID')
				->where('DESIGNATIONS.DES_LNG_ID', '=', config('tecdoc_config.LANG_ID', "16"))
				->where('DESIGNATIONS2.DES_LNG_ID', '=', config('tecdoc_config.LANG_ID', "16"))
				->where('LAT_TYP_ID', '=', $TYP_ID)
				->whereIn('LA_ART_ID', [$arARTIDs])
				->get()->toArray();
        return $resDB;
	}
	
	public static function LookupAnalog($ART_ID)
	{
		$resDB = LookupTecdoc::select('ARL_DISPLAY_NR AS article','ART_LOOKUP.ARL_KIND AS type','DES_TEXTS.TEX_TEXT AS name',
						DB::raw('IF (ART_LOOKUP.ARL_KIND = 2, SUPPLIERS.SUP_BRAND, BRANDS.BRA_BRAND) AS brand'))
				->leftjoin('BRANDS','BRA_ID','=','ARL_BRA_ID')
				->join('ARTICLES','ARTICLES.ART_ID','=','ART_LOOKUP.ARL_ART_ID')
				->join('SUPPLIERS','SUPPLIERS.SUP_ID','=','ARTICLES.ART_SUP_ID')
				->join('DESIGNATIONS','DESIGNATIONS.DES_ID','=','ARTICLES.ART_COMPLETE_DES_ID')
				->join('DES_TEXTS','DES_TEXTS.TEX_ID','=','DESIGNATIONS.DES_TEX_ID')
				->where('ARL_ART_ID', '=', $ART_ID)
				->where('DESIGNATIONS.DES_LNG_ID', '=', config('tecdoc_config.LANG_ID', "16"))
				->whereIn('ARL_KIND', ["2","3","4"])
				->orderBy('ARL_KIND', 'ASC')
				->orderBy('brand', 'ASC')
				->orderBy('ARL_DISPLAY_NR', 'ASC')
				->distinct()
				->get()->toArray();
		return $resDB;
	}
	
	public static function GetCOUID($brand)
	{
		$resDB = AddressTecdoc::select('COU_ISO2 AS ISO','DES_TEXTS.TEX_TEXT AS country')
				->join('COUNTRIES','COUNTRIES.COU_ID','=','SUPPLIER_ADDRESSES.SAD_COU_ID_POSTAL')
				->join('DESIGNATIONS','DESIGNATIONS.DES_ID','=','COU_DES_ID')
				->join('SUPPLIERS','SUPPLIERS.SUP_ID','=','SUPPLIER_ADDRESSES.SAD_SUP_ID')
				->join('DES_TEXTS','DES_TEXTS.TEX_ID','=','DES_TEX_ID')
				->where('SUPPLIERS.SUP_BRAND', '=', $brand)
				->where('SAD_COU_ID', '=', 0)
				->where('DESIGNATIONS.DES_LNG_ID', '=', config('tecdoc_config.LANG_ID', "16"))
				->get()->toArray();
		return $resDB;
	}
	
	public static function GetAppBrands($ART_ID)
	{
		$resDB = LinkArtTecdoc::select('MFA_BRAND','MFA_MFC_CODE')
				->join('LINK_LA_TYP','LAT_LA_ID','=','LA_ID')
				->join('TYPES','TYP_ID','=','LAT_TYP_ID')
				->join('MODELS','MOD_ID','=','TYP_MOD_ID')
				->join('MANUFACTURERS','MFA_ID','=','MOD_MFA_ID')
				->where('LA_ART_ID', '=', $ART_ID)
				->orderBy('MFA_BRAND', 'ASC')
				->distinct()
				->get()->toArray();
		return $resDB;
	}
	
	public static function GetApplicability($ART_ID, $BRAND_CODE = "")
	{
		// DES_TEXTS.TEX_TEXT NOT LIKE 'ORA-%'
		$query = LinkArtTecdoc::select('TYPES.TYP_ID','MODELS.MOD_ID','MANUFACTURERS.MFA_BRAND',
				'DES_TEXTS7.TEX_TEXT AS MOD_CDS_TEXT','DES_TEXTS.TEX_TEXT AS TYP_CDS_TEXT','TYPES.TYP_PCON_START','TYPES.TYP_PCON_END',
				'TYPES.TYP_CCM','TYPES.TYP_KW_FROM','TYPES.TYP_HP_FROM','TYPES.TYP_CYLINDERS','ENGINES.ENG_CODE','DES_TEXTS3.TEX_TEXT AS TYP_FUEL_DES_TEXT',
				DB::raw('IFNULL(DES_TEXTS4.TEX_TEXT, DES_TEXTS5.TEX_TEXT) AS TYP_BODY_DES_TEXT'))
				->join('LINK_LA_TYP','LINK_LA_TYP.LAT_LA_ID','=','LINK_ART.LA_ID')
				->join('TYPES','TYPES.TYP_ID','=','LAT_TYP_ID')
				->join('COUNTRY_DESIGNATIONS','COUNTRY_DESIGNATIONS.CDS_ID','=','TYP_CDS_ID')
				->join('DES_TEXTS','DES_TEXTS.TEX_ID','=','COUNTRY_DESIGNATIONS.CDS_TEX_ID')
				->join('MODELS','MODELS.MOD_ID','=','TYP_MOD_ID')
				->join('MANUFACTURERS','MANUFACTURERS.MFA_ID','=','MOD_MFA_ID')
				->join('COUNTRY_DESIGNATIONS AS COUNTRY_DESIGNATIONS2','COUNTRY_DESIGNATIONS2.CDS_ID','=','MOD_CDS_ID')
				->join('DES_TEXTS AS DES_TEXTS7','DES_TEXTS7.TEX_ID','=','COUNTRY_DESIGNATIONS2.CDS_TEX_ID')
				->leftjoin('DESIGNATIONS','DESIGNATIONS.DES_ID','=','TYP_KV_ENGINE_DES_ID')
				->leftjoin('DESIGNATIONS AS DESIGNATIONS2','DESIGNATIONS2.DES_ID','=','TYP_KV_FUEL_DES_ID')
				->leftjoin('DES_TEXTS AS DES_TEXTS3','DES_TEXTS3.TEX_ID','=','DESIGNATIONS2.DES_TEX_ID')
				->leftjoin('LINK_TYP_ENG','LINK_TYP_ENG.LTE_TYP_ID','=','TYP_ID')
				->leftjoin('ENGINES','ENGINES.ENG_ID','=','LTE_ENG_ID')
				->leftjoin('DESIGNATIONS AS DESIGNATIONS3','DESIGNATIONS3.DES_ID','=','TYP_KV_BODY_DES_ID')
				->leftjoin('DES_TEXTS AS DES_TEXTS4','DES_TEXTS4.TEX_ID','=','DESIGNATIONS3.DES_TEX_ID')
				->leftjoin('DESIGNATIONS AS DESIGNATIONS4','DESIGNATIONS4.DES_ID','=','TYP_KV_MODEL_DES_ID')
				->leftjoin('DES_TEXTS AS DES_TEXTS5','DES_TEXTS5.TEX_ID','=','DESIGNATIONS4.DES_TEX_ID')
				->where('COUNTRY_DESIGNATIONS.CDS_LNG_ID','=', config('tecdoc_config.LANG_ID', "16"))
				->where('COUNTRY_DESIGNATIONS2.CDS_LNG_ID','=', config('tecdoc_config.LANG_ID', "16"))
				->whereRaw('(DESIGNATIONS.DES_LNG_ID IS NULL OR DESIGNATIONS.DES_LNG_ID = ' . config('tecdoc_config.LANG_ID', "16") . ')')
				->whereRaw('(DESIGNATIONS2.DES_LNG_ID IS NULL OR DESIGNATIONS2.DES_LNG_ID = ' . config('tecdoc_config.LANG_ID', "16") . ')')
				->whereRaw('(DESIGNATIONS3.DES_LNG_ID IS NULL OR DESIGNATIONS3.DES_LNG_ID = ' . config('tecdoc_config.LANG_ID', "16") . ')')
				->whereRaw('(DESIGNATIONS4.DES_LNG_ID IS NULL OR DESIGNATIONS4.DES_LNG_ID = ' . config('tecdoc_config.LANG_ID', "16") . ')')
				->where('LINK_ART.LA_ART_ID','=', $ART_ID);
				if ($BRAND_CODE != "")
				{
					$query->where('MFA_MFC_CODE','=', $BRAND_CODE);
				}
				$query->orderBy('MANUFACTURERS.MFA_BRAND', 'ASC');
				$query->orderBy('MOD_CDS_TEXT', 'ASC');
				$query->orderBy('TYP_CDS_TEXT', 'ASC');
				$query->orderBy('TYPES.TYP_PCON_START', 'ASC');
				$query->orderBy('TYPES.TYP_CCM', 'ASC');
				$resDB = $query->get()->toArray();
		return $resDB;
	}
	
	public static function LookupProductAnalog($ART_ID, $arTYPE = array())
	{
		$query = LookupTecdoc::select('ARL_KIND AS type','ARL_DISPLAY_NR AS article',DB::raw('IF (ART_LOOKUP.ARL_KIND = 2, SUPPLIERS.SUP_BRAND, BRANDS.BRA_BRAND) AS brand'))
				->leftjoin('BRANDS','BRA_ID','=','ARL_BRA_ID')
				->join('ARTICLES','ARTICLES.ART_ID','=','ART_LOOKUP.ARL_ART_ID')
				->join('SUPPLIERS','SUPPLIERS.SUP_ID','=','ARTICLES.ART_SUP_ID')
				->where('ARL_ART_ID','=', $ART_ID);
				if (0 < count($arTYPE))
				{
					$query->whereIn('ARL_KIND', $arTYPE);
				}
				$query->orderBy('ARL_KIND', 'ASC');
				$query->orderBy('BRA_BRAND', 'ASC');
				$query->orderBy('ARL_DISPLAY_NR', 'ASC');
				$resDB = $query->get()->toArray();
		return $resDB;
	}
	
	public static function GetTags($ART_ID)
	{
		$resDB = LinkArtTecdoc::select('LGS_STR_ID')
				->leftjoin('LINK_GA_STR','LINK_GA_STR.LGS_GA_ID','=','LA_GA_ID')
				->where('LA_ART_ID','=', $ART_ID)
				->distinct()
				->get()->toArray();
		return $resDB;
	}
	
	public static function GetTextByID($ART_ID)
	{
		$resDB = DesignationTecdoc::select('DES_TEXTS.TEX_TEXT AS TEXT')
				->leftjoin('DES_TEXTS','DESIGNATIONS.DES_TEX_ID','=','DES_TEXTS.TEX_ID')
				->where('DESIGNATIONS.DES_ID','=', $ART_ID)
				->where('DESIGNATIONS.DES_LNG_ID','=', config('tecdoc_config.LANG_ID', "16"))
				->get()->toArray();
		return $resDB;
	}
	
	public static function GetPDFs($ART_ID, $LIMIT = 0)
	{
		//if (0 < intval($LIMIT))
		//{
		//  $strLIMIT = "LIMIT " . intval($LIMIT);
		//}
		//$SQL = "SELECT CONCAT('pdf/', GRA_ID, LPAD(GRA_LNG_ID, 3, '0'), '.pdf') AS PATH " . "FROM LINK_GRA_ART " . "INNER JOIN GRAPHICS ON GRA_ID = LGA_GRA_ID " . "WHERE " . "LGA_ART_ID = " . $ART_ID . " AND " . "(GRA_LNG_ID = " . $LNG_ID . " OR GRA_LNG_ID = 255) AND " . "GRA_DOC_TYPE = 2 " . "ORDER BY LGA_ART_ID, GRA_ID, GRA_LNG_ID " . $strLIMIT . ";";
        //$resDB = new TDSQLQuery();
        //$resDB->QuerySelect($SQL);
        //return $resDB;
    }
}

//1 - Неоригинальный номер
//2 - Торговый номер (номер пользователя)
//3 - Оригинальный номер
//4 - номер замен (кроссы с неоригиналов на неоригиналы)
//5 - штрих-код (номер EAN)
