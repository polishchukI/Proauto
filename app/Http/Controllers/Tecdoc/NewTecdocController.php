<?php

namespace App\Http\Controllers\Tecdoc;

use DB;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Catalog\CatalogManufacturer;
use App\Models\Catalog\CatalogArticleCross;
use App\Models\Catalog\CatalogArticleAttribute;
use App\Models\Catalog\CatalogArticleImage;
use App\Models\Catalog\CatalogArticleLink;
use App\Models\Catalog\CatalogArticleLi;
use App\Models\Catalog\CatalogArticleRn;
use App\Models\Catalog\CatalogArticleOe;
use App\Models\Catalog\CatalogArticle;
use App\Models\Catalog\CatalogAxle;
use App\Models\Catalog\CatalogAxleTree;
use App\Models\Catalog\CatalogCommercialVehicle;
use App\Models\Catalog\CatalogCommercialVehicleTree;
use App\Models\Catalog\CatalogEngine;
use App\Models\Catalog\CatalogEngineTree;

use App\Models\Catalog\CatalogModel;
use App\Models\Catalog\CatalogMotorbike;
use App\Models\Catalog\CatalogMotorbikeTree;
use App\Models\Catalog\CatalogPassangerCar;
use App\Models\Catalog\CatalogPassangerCarTree;
use App\Models\Catalog\CatalogSupplier;

class NewTecdocController extends Controller
{
	//1.АВТОМОБИЛИ
	//1.1 Марки
	public static function getBrands($group)
    {
        $DBResult = [];
        $query = CatalogManufacturer::select('manufacturers.id as manufacturer_id','manufacturers.description as manufacturer_name')->where('canbedisplayed','=', 'True');
		switch ($group)
		{
            case 'passenger':
				$query->where('ispassengercar','=', 'True')->orderBy('matchcode');
                break;
            case 'commercial':
				$query->where('iscommercialvehicle','=', 'True')->orderBy('matchcode');
                break;
            case 'motorbike':
				$query->where('ismotorbike','=', 'True')->where('haslink','=', 'True')->orderBy('description');
                break;
            case 'engine':
				$query->where('isengine','=', 'True')->orderBy('matchcode');
                break;
            case 'axle':
				$query->where('isaxle','=', 'True')->orderBy('matchcode');
                break;
        }
        
        $DBResult = $query->get()->toArray();
        
        return $DBResult;		
    }
	
    //1.2 ID производилеля по названию
    public static function getManufacturerByCode($group, $code)
	{

		$order = $group == 'motorbike' ? 'description' : 'matchcode';

        $query = CatalogManufacturer::select('manufacturers.id as manufacturer_id','manufacturers.description as manufacturer_name','matchcode')->where('description','=', $code)->where('canbedisplayed','=', 'True');
		switch ($group)
		{
            case 'passenger':
				$query->where('ispassengercar','=', 'True')->orderBy('matchcode');
                break;
            case 'commercial':
				$query->where('iscommercialvehicle','=', 'True')->orderBy('matchcode');
                break;
            case 'motorbike':
				$query->where('ismotorbike','=', 'True')->where('haslink','=', 'True')->orderBy('description');
                break;
            case 'engine':
				$query->where('isengine','=', 'True')->orderBy('matchcode');
                break;
            case 'axle':
				$query->where('isaxle','=', 'True')->orderBy('matchcode');
                break;
        }
		$DBResult = $query->get()->toArray();
		
		return $DBResult;		
	}

    public static function getModels($group, $manufacturer_id, $pattern = null)
    {
		$query = CatalogModel::select('id as model_id', 'description as model_name', 'constructioninterval')->where('canbedisplayed','=', 'True')->where('manufacturerid','=', (int)$manufacturer_id);
		switch ($group)
		{
            case 'passenger':
				$query->where('ispassengercar','=', 'True')->orderBy('description');
                break;
            case 'commercial':
				$query->where('iscommercialvehicle','=', 'True')->orderBy('description');
                break;
            case 'motorbike':
				$query->where('ismotorbike','=', 'True')->where('haslink','=', 'True')->orderBy('description');
                break;
            case 'engine':
				$query->where('isengine','=', 'True')->orderBy('description');
                break;
            case 'axle':
				$query->where('isaxle','=', 'True')->orderBy('description');
                break;
        }
		if ($pattern != null)
		{
			$query->where('description','like', $pattern);
		}
		$DBResult = $query->get()->toArray();
		
		return $DBResult;
    }

    //1.3 Модификации авто
	public static function getModifications($group, $model_id)
    {
		// dd(compact('group','model_id'));
		switch ($group)
		{
            case 'passenger':
				$query = CatalogPassangerCar::select('id as modification_id', 'attributes.attributegroup as attributegroup', 'attributes.attributetype as attributetype', 'attributes.displaytitle as displaytitle', 'attributes.displayvalue as displayvalue')
					->leftjoin('passanger_car_attributes as attributes','passanger_cars.id','=','attributes.passangercarid')
					->where('ispassengercar','=', 'True');
                break;
            case 'commercial':
				$query = CatalogCommercialVehicle::select('id as modification_id', 'attributes.attributegroup as attributegroup', 'attributes.attributetype as attributetype', 'attributes.displaytitle as displaytitle', 'attributes.displayvalue as displayvalue')
					->leftjoin('commercial_vehicle_attributes as attributes','commercial_vehicles.id','=','attributes.commercialvehicleid')
					->where('iscommercialvehicle','=', 'True');
                break;
            case 'motorbike':
				$query = CatalogMotorbike::select('motorbikes.id AS modification_id','motorbikes.constructioninterval','motorbikes.description','motorbikes.modelid')
					->where('ismotorbike','=', 'True');
                break;
            case 'engine':
				$query = CatalogEngine::select('id as modification_id', 'attributes.attributegroup as attributegroup', 'attributes.attributetype as attributetype', 'attributes.displaytitle as displaytitle', 'attributes.displayvalue as displayvalue')
					->leftjoin('engine_attributes as attributes','engines.id','=','attributes.engineid')
					->where('isengine','=', 'True');
                break;
            case 'axle':
				$query = CatalogAxle::select('id as modification_id', 'attributes.attributegroup as attributegroup', 'attributes.attributetype as attributetype', 'attributes.displaytitle as displaytitle', 'attributes.displayvalue as displayvalue')
					->leftjoin('axle_attributes as attributes','axles.id','=','attributes.axleid')
					->where('isaxle','=', 'True');
                break;
        }
		$query->where('canbedisplayed','=', 'True')->where('modelid','=', (int)$model_id);
		
		// $DBResult = $query->toSql();
        // dd(compact('DBResult'));
		$DBResult = $query->get()->toArray();
		return $DBResult;
    }

    //1.4 Engine by modification
    public static function getEngineByModificationId($group, $model_id)
    {
        $query = CatalogEngine::select('engines.description AS displayvalue');
		switch ($group)
		{
            case 'passenger':
				$query->where('ispassengercar','=', 'True');
                break;
            case 'commercial':
				$query->addSelect('commercial_vehicle_engines.id as modification_id');
				$query->addSelect(DB::raw('"Engine" AS attributegroup,"EngineCode" AS attributetype,"Engine code" AS displaytitle'));
				$query->leftjoin('commercial_vehicle_engines','commercial_vehicle_engines.engineid','=','engines.id');
				$query->leftjoin('commercial_vehicles', 'commercial_vehicles.id', '=', 'commercial_vehicle_engines.id');
                $query->where('commercial_vehicles.modelid','=', (int)$model_id);
                break;
            case 'motorbike':
				$query->addSelect('commercial_vehicle_engines.id as modification_id');
				$query->addSelect(DB::raw('"Engine" AS attributegroup,"EngineCode" AS attributetype,"Engine code" AS displaytitle'));
				$query->leftjoin('commercial_vehicle_engines','commercial_vehicle_engines.engineid','=','engines.id');
				$query->leftjoin('commercial_vehicles', 'commercial_vehicles.id', '=', 'commercial_vehicle_engines.id');
                $query->where('commercial_vehicles.modelid','=', (int)$model_id);
                break;
            case 'engine':
				$query->where('isengine','=', 'True');
                break;
            case 'axle':
				$query->where('isaxle','=', 'True');
                break;
        }
        // $DBResult = $query->toSql();
        // dd(compact('DBResult'));
		$DBResult = $query->get()->toArray();
		
		return $DBResult;
	}

    //1.4 Марка по ID
    public static function getManufacturerById($group, $manufacturer_id)
    {
        $query = CatalogManufacturer::select('manufacturers.id as manufacturer_id','manufacturers.description as manufacturer_name')->where('canbedisplayed','=', 'True')->where('manufacturers.id','=',(int)$manufacturer_id);
		switch ($group)
		{
            case 'passenger':
				$query->where('ispassengercar','=', 'True');
                break;
            case 'commercial':
				$query->where('iscommercialvehicle','=', 'True');
                break;
            case 'motorbike':
				$query->where('ismotorbike','=', 'True')->where('haslink','=', 'True');
                break;
            case 'engine':
				$query->where('isengine','=', 'True');
                break;
            case 'axle':
				$query->where('isaxle','=', 'True');
                break;
        }
		$DBResult = $query->get()->toArray();
		
		return $DBResult;
	}

    //1.5 Модель по ID
    public static function getModelById($group, $model_id)
    {
		$query = CatalogModel::select('id as model_id', 'description as name', 'constructioninterval', 'manufacturerid')->where('id','=', (int)$model_id)->where('canbedisplayed','=', 'True');
		switch ($group)
		{
            case 'passenger':
				$query->where('ispassengercar','=', 'True');
                break;
            case 'commercial':
				$query->where('iscommercialvehicle','=', 'True');
                break;
            case 'motorbike':
				$query->where('ismotorbike','=', 'True')->where('haslink','=', 'True');
                break;
            case 'engine':
				$query->where('isengine','=', 'True');
                break;
            case 'axle':
				$query->where('isaxle','=', 'True');
                break;
        }
        $DBResult = $query->get()->toArray();
		return $DBResult;	
    }
    
	//1.5.1 ID Модели Названию
    public static function getModelIdByName($group, $model_name)
    {
		$order = $group == 'motorbike' ? 'description' : 'matchcode';

        $query = CatalogModel::select('id as model_id')->where('description','=', $model_name)->where('canbedisplayed','=', 'True');
		switch ($group)
		{
            case 'passenger':
				$query->where('ispassengercar','=', 'True');
                break;
            case 'commercial':
				$query->where('iscommercialvehicle','=', 'True');
                break;
            case 'motorbike':
				$query->where('ismotorbike','=', 'True')->where('haslink','=', 'True');
                break;
            case 'engine':
				$query->where('isengine','=', 'True');
                break;
            case 'axle':
				$query->where('isaxle','=', 'True');
                break;
        }
		$DBResult = $query->get()->toArray();
		$model_id = $DBResult["model_id"];
		
		return $model_id;	
    }
	
    //1.6 Модификация по ID
    public static function getModificationById($group, $model_id)
    {
        switch ($group)
		{
            case 'passenger':
			$query = CatalogPassangerCar::select('id as modification_id', 'fulldescription as fulldescription','description as description','modelid as modelid',
				'attributes.attributegroup as attributegroup', 'attributes.attributetype as attributetype', 'attributes.displaytitle as displaytitle', 'attributes.displayvalue as displayvalue')
				->leftjoin('passanger_car_attributes as attributes','passanger_cars.id','=','attributes.passangercarid')
				->where('ispassengercar','=', 'True');
                break;
            case 'commercial':
			$query = CatalogCommercialVehicle::select('id as modification_id', 'fulldescription as fulldescription','description as description','modelid as modelid',
					'attributes.attributegroup as attributegroup', 'attributes.attributetype as attributetype', 'attributes.displaytitle as displaytitle', 'attributes.displayvalue as displayvalue')
					->leftjoin('commercial_vehicle_attributes as attributes','commercial_vehicles.id','=','attributes.commercialvehicleid')
					->where('iscommercialvehicle','=', 'True');
                break;
            case 'motorbike':
                $query = CatalogMotorbike::select('id as modification_id', 'fulldescription as fulldescription','description as description','modelid as modelid',
					'attributes.attributegroup as attributegroup', 'attributes.attributetype as attributetype', 'attributes.displaytitle as displaytitle', 'attributes.displayvalue as displayvalue')
					->leftjoin('motorbike_attributes as attributes','motorbikes.id','=','attributes.motorbikeid')
					->where('ismotorbike','=', 'True');
            case 'engine':
                $query = CatalogEngine::select('id as modification_id', 'fulldescription as fulldescription','description as description','modelid as modelid',
					'attributes.attributegroup as attributegroup', 'attributes.attributetype as attributetype', 'attributes.displaytitle as displaytitle', 'attributes.displayvalue as displayvalue')
					->leftjoin('engine_attributes as attributes','engines.id','=','attributes.engineid')
					->where('isengine','=', 'True');
                break;
            case 'axle':
                $query = CatalogAxle::select('id as modification_id', 'fulldescription as fulldescription','description as description','modelid as modelid',
					'attributes.attributegroup as attributegroup', 'attributes.attributetype as attributetype', 'attributes.displaytitle as displaytitle', 'attributes.displayvalue as displayvalue')
					->leftjoin('axle_attributes as attributes','axles.id','=','attributes.axleid')
					->where('isaxle','=', 'True');
                break;
        }
		$query->where('canbedisplayed','=', 'True')->where('id','=', (int)$model_id);
        $DBResult = $query->get()->toArray();
		return $DBResult;	
    }

    //1.7 modification name by modification_id
	public static function getModificationNameById($group, $modification_id)
    {
        switch ($group)
		{
            case 'passenger':
				$query = CatalogPassangerCarTree::where('passangercarid','=', (int)$modification_id);
                break;
            case 'commercial':
				$query = CatalogCommercialVehicle::select('fulldescription as name')->where('id','=', (int)$modification_id);
                break;
            case 'motorbike':
				$query = CatalogMotorbikeTree::where('motorbikeid','=', (int)$modification_id);
                break;
            case 'engine':
				$query = CatalogEngineTree::where('engineid','=', (int)$modification_id);
                break;
            case 'axle':
				$query = CatalogAxleTree::where('axleid','=', (int)$modification_id);
                break;
        }
		$DBResult = $query->get()->first();
		return $DBResult;	
    }

    //2 Дерево категорий / разделы
	//2.1 Построение дерева категорий изделий для заданного типа автомобиля (от родительского)
    //Последовательно устанавливая следующие значения parent_id, можно получить ещё 4 уровня дерева
	//Если есть, то ее parentid ставим на вход метода
    public static function getSections($group, $modification_id, $parent = 0)
    {
        //dd(compact('group', 'modification_id', 'parent'));
        switch ($group)
		{
			// passangercarid
			// searchtreeid
			// id
			// parentid
			// description
            case 'passenger':
				$query = CatalogPassangerCarTree::select('id', 'description as text', 'parentid')
					->where('passangercarid','=', (int)$modification_id);
                break;
            case 'commercial':
				$query = CatalogCommercialVehicleTree::select('id', 'description as text', 'parentid')
					->where('commercialvehicleid','=', (int)$modification_id);
                break;
            case 'motorbike':
				$query = CatalogMotorbikeTree::select('id', 'description as text', 'parentid')
					->where('motorbikeid','=', (int)$modification_id);
                break;
            case 'engine':
				$query = CatalogEngineTree::select('id', 'description as text', 'parentid')
					->where('engineid','=', (int)$modification_id);
                break;
            case 'axle':
				$query = CatalogAxleTree::select('id', 'description as text', 'parentid')
					->where('axleid','=', (int)$modification_id);
                break;
        }
		$query->where('parentid', '=', (int)$parent)->orderBy('description', 'DESC');
		$DBResult = $query->get()->toArray();
		return $DBResult;	
    }

    //2.2 Название раздела по ID - используется в СЕО
	public static function getSectionName($group, $section_id, $modification_id)
    {
        switch ($group)
		{
            case 'passenger':
				$query = CatalogPassangerCarTree::where('passangercarid','=', (int)$modification_id);
                break;
            case 'commercial':
				$query = CatalogCommercialVehicleTree::where('commercialvehicleid','=', (int)$modification_id);
                break;
            case 'motorbike':
				$query = CatalogMotorbikeTree::where('motorbikeid','=', (int)$modification_id);
                break;
            case 'engine':
				$query = CatalogEngineTree::where('engineid','=', (int)$modification_id);
                break;
            case 'axle':
				$query = CatalogAxleTree::where('axleid','=', (int)$modification_id);
                break;
        }
		$query->where('id','=', (int)$section_id);
		$DBResult = $query->get()->first();
		return $DBResult;	
    }

    //2.3 Поиск запчастей раздела
	public static function getSectionParts($group, $modification, $section)
    {
        $DBResult = [];
        switch ($group)
		{
            case 'passenger':
                // $query = DB::connection("catalog")->select("select article_links.datasupplierarticlenumber as article,
                $query = DB::connection("catalog")->select("select article_links.*,
                suppliers.description as brand,
                passanger_car_prd.description as product_name
                FROM article_links 
                JOIN passanger_car_pds on article_links.supplierid = passanger_car_pds.supplierid
                JOIN suppliers on suppliers.id = article_links.supplierid
                JOIN passanger_car_prd on passanger_car_prd.id = article_links.productid
                WHERE article_links.productid = passanger_car_pds.productid
                AND article_links.linkageid = passanger_car_pds.passangercarid
                AND article_links.linkageid = ".(int)$modification."
                AND passanger_car_pds.nodeid = ".(int)$section."
                AND article_links.linkagetypeid = " . (int)2 . "
                ORDER BY suppliers.description, article_links.datasupplierarticlenumber");
                    break;
            case 'commercial':
                return DB::connection('catalog')->select("SELECT
					al.datasupplierarticlenumber article,
					s.description brand,
					prd.description product_name
                    FROM article_links al 
                    JOIN commercial_vehicle_pds pds on al.supplierid = pds.supplierid
                    JOIN suppliers s on s.id = al.supplierid
                    JOIN commercial_vehicle_prd prd on prd.id = al.productid
                    WHERE al.productid = pds.productid
                    AND al.linkageid = pds.commertialvehicleid
                    AND al.linkageid = " . (int)$modification . "
                    AND pds.nodeid = " . (int)$section . "
                    AND al.linkagetypeid = 16
                    ORDER BY s.description, al.datasupplierarticlenumber");
                break;
            case 'motorbike':
                return DB::connection('catalog')->select("SELECT
					al.datasupplierarticlenumber article,
					s.description brand,
					prd.description product_name
                    FROM article_links al 
                    JOIN motorbike_pds pds on al.supplierid = pds.supplierid
                    JOIN suppliers s on s.id = al.supplierid
                    JOIN motorbike_prd prd on prd.id = al.productid
                    WHERE al.productid = pds.productid
                    AND al.linkageid = pds.motorbikeid
                    AND al.linkageid = " . (int)$modification . "
                    AND pds.nodeid = " . (int)$section . "
                    AND al.linkagetypeid = 777
                    ORDER BY s.description, al.datasupplierarticlenumber");
                break;
            case 'engine':
                return DB::connection('catalog')->select("SELECT
					pds.engineid,
					al.datasupplierarticlenumber article,
					prd.description product_name,
					s.description brand
                    FROM article_links al 
                    JOIN engine_pds pds on al.supplierid = pds.supplierid
                    JOIN suppliers s on s.id = al.supplierid
                    JOIN engine_prd prd on prd.id = al.productid
                    WHERE al.productid = pds.productid
                    AND al.linkageid = pds.engineid
                    AND al.linkageid = " . (int)$modification . "
                    AND pds.nodeid = " . (int)$section . "
                    AND al.linkagetypeid = 14
                    ORDER BY s.description, al.datasupplierarticlenumber");
                break;
            case 'axle':
                return DB::connection('catalog')->select("SELECT
					pds.axleid,
					al.datasupplierarticlenumber article,
					prd.description product_name,
					s.description brand
                    FROM article_links al 
                    JOIN axle_pds pds on al.supplierid = pds.supplierid
                    JOIN suppliers s on s.id = al.supplierid
                    JOIN axle_prd prd on prd.id = al.productid
                    WHERE al.productid = pds.productid
                    AND al.linkageid = pds.axleid
                    AND al.linkageid = " . (int)$modification . "
                    AND pds.nodeid = " . (int)$section . "
                    AND al.linkagetypeid = 19
                    ORDER BY s.description, al.datasupplierarticlenumber");
                break;

        }
        if($query)
        {
            foreach($query as $item)
            {
                // dd(compact('query'));
                // +"supplierid": 4814
                // +"productid": 7
                // +"linkagetypeid": 2
                // +"linkageid": 19904
                // +"datasupplierarticlenumber": "L40096"
                // +"brand": "1A FIRST AUTOMOTIVE"
                // +"product_name": "Масляный фильтр"
                $DBResult[] = ["article" => $item->datasupplierarticlenumber, "brand"=>$item->brand,  "product_name" =>$item->product_name];
            }
        }
        // dd($DBResult);
        return $DBResult;
    }

    //3 Информация об изделии
	//3.1 Оригинальные номера
	public static function getOemNumbers($number, $brand_id)
    {
        // return DB::connection('catalog')->select("
        //     SELECT DISTINCT
		// 	a.OENbr
		// 	FROM
		// 		article_oe a 
        //     WHERE
		// 		a.datasupplierarticlenumber='" . $number . "'
		// 		AND a.manufacturerId='" . $brand_id . "'
        //     ORDER BY
		// 		a.OENbr
        // ");

        try
        {
            $query = CatalogArticleOe::select('manufacturers.description as brand','article_oe.OENbr as article')
                    ->join('manufacturers', 'manufacturers.id', '=', 'article_oe.manufacturerId')
                    ->where('article_oe.datasupplierarticlenumber','=', $number)
                    ->where('article_oe.supplierid','=', $brand_id)
                    ->distinct()
                    ->get();

        if($query)
        {
            $DBResult = $query->toArray();
        }
		}
		catch(\Exception $e)
		{
			$DBResult = [];
		}
        return $DBResult;
    }

    //3.2 Статус изделия
    public static function getArticleStatus($number, $brand_id)
    {
        return DB::connection('catalog')->select("SELECT
			NormalizedDescription,
			ArticleStateDisplayValue
			FROM
				articles
			WHERE
				DataSupplierArticleNumber='" . $number . "'
			AND
				supplierId='" . $brand_id . "'");
    }

    //3.3 Характеристики изделия
    static public function getArticleAttributes($number, $brand_id)
	{
        $DBResult = [];
        try
        {
            $query = CatalogArticleAttribute::select('article_attributes.description as name','article_attributes.displayvalue as value','article_attributes.displaytitle')
                ->leftjoin('article_oe', function ($join) {$join->on('article_oe.supplierid', '=', 'article_attributes.supplierid')->on('article_oe.datasupplierarticlenumber', '=', 'article_attributes.datasupplierarticlenumber');})
                ->where('article_oe.OENbr','=', $number)
                ->where('article_oe.manufacturerId','=', $brand_id)
                // ->groupBy('article_attributes.displaytitle')
                ->orderBy('article_attributes.displaytitle', 'ASC')
                ->distinct()
                ->get();

        if($query)
        {
            $DBResult = $query->toArray();
        }
		}
		catch(\Exception $e)
		{
			$DBResult = [];
		}
        return $DBResult;
	}

    //3.4 Файлы изделия
    public static function getArticleFiles($number, $brand_id)
    {
        return DB::connection('catalog')->select("SELECT
			Description,
			PictureName
			FROM article_images
			WHERE DataSupplierArticleNumber='" . $number . "'
			AND supplierId='" . $brand_id . "'
        ");
    }

    //3.5 Применимость изделия
	public static function getArticleVehicles($number, $brand_id)
    {
        $result = [];
        $rows = DB::connection('catalog')->select("SELECT
			linkageTypeId,
			linkageId
			FROM article_li
			WHERE DataSupplierArticleNumber='" . $number . "'
			AND supplierId='" . $brand_id . "'");
        foreach ($rows as &$row)
		{
            switch ($row)
			{
                case 'PassengerCar':
                    $result[$row['linkageTypeId']][] = DB::connection('catalog')
						->select("SELECT DISTINCT
						p.id,
						mm.description make,
						m.description model,
						p.constructioninterval,
						p.description
						FROM passanger_cars p 
                        JOIN models m ON m.id=p.modelid
                        JOIN manufacturers mm ON mm.id=m.manufacturerid
                        WHERE p.id=" . $row['linkageTypeId']);
                    break;
                case 'CatalogCommercialVehicle':
                    $result[$row['linkageTypeId']][] = DB::connection('catalog')
						->select("SELECT DISTINCT
						p.id,
						mm.description make,
						m.description model,
						p.constructioninterval,
						p.description
						FROM commercial_vehicles p 
                        JOIN models m ON m.id=p.modelid
                        JOIN manufacturers mm ON mm.id=m.manufacturerid
                        WHERE p.id=" . $row['linkageTypeId']);
                    break;
                case 'Motorbike':
                    $result[$row['linkageTypeId']][] = DB::connection('catalog')
						->select("SELECT DISTINCT
						p.id,
						mm.description make,
						m.description model,
						p.constructioninterval,
						p.description
						FROM motorbikes p 
                        JOIN models m ON m.id=p.modelid
                        JOIN manufacturers mm ON mm.id=m.manufacturerid
                        WHERE p.id=" . $row['linkageTypeId']);
                    break;
                case 'engine':
                    $result[$row['linkageTypeId']][] = DB::connection('catalog')
						->select("SELECT DISTINCT
						p.id,
						m.description make,
						'' model,
						p.constructioninterval,
						p.description
						FROM `engines` p 
                        JOIN manufacturers m ON m.id=p.manufacturerid
                        WHERE p.id=" . $row['linkageTypeId']);
                    break;
                case 'CatalogAxle':
                    $result[$row['linkageTypeId']][] = DB::connection('catalog')
						->select("SELECT DISTINCT
						p.id,
						mm.description make,
						m.description model,
						p.constructioninterval,
						p.description
						FROM axles p 
                        JOIN models m ON m.id=p.modelid
                        JOIN manufacturers mm ON mm.id=m.manufacturerid
                        WHERE p.id=" . $row['linkageTypeId']);
                    break;
            }
        }
        return $result;
    }

    //3.6 Замены изделия
    public static function getArticleReplace($number, $brand_id, $brand = "")
    {
		$DBResult = [];
        try
        {
            $query = CatalogArticleRn::select('article_rn.datasupplierarticlenumber AS article',
                'suppliers.description AS brand',
                'article_rn.supplierid AS brand_id',
                'article_rn.replacenbr AS replace_article',
                'replace_suppliers.description AS replace_brand',
                'article_rn.replacedupplierid AS replace_brand_id')
                ->join('suppliers AS replace_suppliers', 'replace_suppliers.id', '=', 'article_rn.replacedupplierid')
                ->join('suppliers', 'suppliers.id', '=', 'article_rn.supplierid')
                ->where('article_rn.datasupplierarticlenumber','=', $number)
                ->where('article_rn.supplierid','=', $brand_id)
                ->orWhere('suppliers.description','=', $brand)
                ->distinct()
                ->get();

        if($query)
        {
            $DBResult = $query->toArray();
        }
		}
		catch(\Exception $e)
		{
			$DBResult = [];
		}
        return $DBResult;
    }

    //3.7 Аналоги-заменители
    public static function getArticleCross($number, $brand_id)
    {
        return DB::connection('catalog')->select("SELECT DISTINCT
			s.description,
			c.PartsDataSupplierArticleNumber
			FROM article_oe a
            JOIN manufacturers m ON m.id=a.manufacturerId 
            JOIN article_cross c ON c.OENbr=a.OENbr
            JOIN suppliers s ON s.id=c.SupplierId
            WHERE a.datasupplierarticlenumber='" . $number . "'
			AND a.manufacturerId='" . $brand_id . "'
        ");
    }

    //3.8 Комплектующие (части) изделия
    public static function getArticleParts($number, $brand_id)
    {
        return DB::connection('catalog')->select("SELECT DISTINCT
			description Brand,
			Quantity,
			PartsDataSupplierArticleNumber
			FROM article_parts
            JOIN suppliers ON id=PartsSupplierId
            WHERE DataSupplierArticleNumber='" . $number . "'
			AND supplierId='" . $brand_id . "'
        ");
    }

    /*additional*/
	public static function SearchNumber($number)
	{
		$DBResult = [];
        try
        {
            $query = CatalogArticleCross::select('article_cross.PartsDataSupplierArticleNumber AS article', 'suppliers.description AS brand',
                'articles.NormalizedDescription AS name', 'suppliers.id AS supplier_id')
                ->leftjoin('manufacturers','article_cross.manufacturerId','=','manufacturers.id')
                ->leftjoin('suppliers','article_cross.SupplierId','=','suppliers.id')
                ->join('articles', function ($join) {$join->on('articles.DataSupplierArticleNumber', '=', 'article_cross.PartsDataSupplierArticleNumber')->on('articles.supplierId', '=', 'article_cross.SupplierId');})
                ->where('OENbr','=', $number)
                ->orWhere('article_cross.PartsDataSupplierArticleNumber','=', $number)
                ->orderBy('article_cross.PartsDataSupplierArticleNumber', 'asc')
                ->distinct()
                ->get();

        if($query)
        {
            $DBResult = $query->toArray();
        }
		}
		catch(\Exception $e)
		{
			$DBResult = [];
		}
        return $DBResult;
	}
	
    public static function getBrandByCode($code)
	{
        try
        {
            $query = CatalogManufacturer::where('matchcode','=', $code)->first();
            if($query)
            {
                $DBResult = $query->toArray();
                $DBResult['part_type'] = "manufacturer";
            }
            else
            {
                $query = CatalogSupplier::where('matchcode','=', $code)->first();
                if($query)
                {
                    $DBResult = $query->toArray();
                    $DBResult['part_type'] = "supplier";
                }
               
            }

        if($query)
        {
            $DBResult = $query->toArray();
        }
		}
		catch(\Exception $e)
		{
			$DBResult = [];
		}
        return $DBResult;
	}

    public static function getSupplierByCode($supplier)
	{
        $DBResult = [];
        try
        {
            $query = CatalogSupplier::where('matchcode','=', $supplier)->first();
            if($query)
            {
                $DBResult = $query->toArray();
            }
		}
		catch(\Exception $e)
		{
			$DBResult = [];
		}
        return $DBResult;
	}
    
    public static function getPartData($part_type, $number, $brand_id)
	{
        $DBResult = [];
        switch ($part_type)
		{
            case 'supplier':

                break;
            case 'manufacturer':

                break;
            }	
		return $DBResult;		
	}

    static public function getPartByPKEY($bkey, $akey)
	{
        $DBArray = [];

		return $DBArray;
	}

    
}