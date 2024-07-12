<?php

namespace App\Http\Controllers\Catalog;

use Illuminate\Support\Str;

use App\Http\Requests;

use App\Models\Catalog\CatalogGroup;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Tecdoc\NewTecdocController;
use App\Http\Controllers\FunctionsController as Functions;

use Illuminate\Http\Request;

//////////seo
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
//////////seo

class ManufacturersController extends Controller
{
	//admin
	static function GetManufacturersPage(Request $request)
	{
		$group = $request->group;
		$catalog_m = NewTecdocController::getBrands($group);
		
		foreach ($catalog_m as $item)
		{
			$manufacturers[] = [
					"manufacturer_id" => $item["manufacturer_id"],
					"group" => $group,
					"manufacturer_name" => $item["manufacturer_name"],
					"url" => '/catalog/' . $group . '/' . Str::lower($item["manufacturer_name"])];
		}
		return view('inventory.admin_catalog.manufacturers',compact('manufacturers'));
	}
	
	//client
	static function GetShopManufacturers(Request $request)
	{
		$SEO = "";
		$group = $request->group;
		$catalog_m = NewTecdocController::getBrands($group);
		foreach ($catalog_m as $item)
		{
			$manufacturers[] = [
					"manufacturer_id" => $item["manufacturer_id"],
					"group" => $group,
					"manufacturer_name" => $item["manufacturer_name"],
					"image_url" => '/images/brands/' . Str::lower($item["manufacturer_name"] . '.png'),
					"url" => '/catalog/' . $group . '/' . Str::lower($item["manufacturer_name"])];
					$SEO .= implode([$item["manufacturer_name"] . ", "]);
		}
		
		////////////////////////////////
		TwitterCard::setTitle('Каталог запчастей - Выберите марку автомобиля');
		SEOMeta::setTitle('Каталог запчастей - Выберите марку автомобиля');
		SEOMeta::setDescription('Каталог запчастей - Выберите марку автомобиля');
		OpenGraph::setTitle('Каталог запчастей - Выберите марку автомобиля');
        OpenGraph::setDescription('Каталог запчастей - Выберите марку автомобиля');
		SEOMeta::setKeywords($SEO);
		////////////////////////////////
		
		// dd(compact('manufacturers'));
		return view('shop.catalog.manufacturers',compact('manufacturers'));
	}
}
