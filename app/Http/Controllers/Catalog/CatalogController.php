<?php

namespace App\Http\Controllers\Catalog;

use Illuminate\Support\Str;

use Illuminate\Http\Request;

use App\Models\Catalog\CatalogGroup;
use App\Models\Catalog\CatalogManufacturer;
use App\Models\Catalog\CatalogModel;
use App\Http\Controllers\Shop\ShopController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FunctionsController as Functions;

//////////seo
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
//////////seo

class CatalogController extends Controller
{
	//adminside
	static function GetCatalogPage()
	{
		$cataloggroups = CatalogController::GetGroups();
		return view('inventory.admin_catalog.catalog', compact('cataloggroups'));
	}
	
	static function GetGroups()
	{
		$SEO = "";
		$GroupsArray = CatalogGroup::where('isactive','=','True')->get();
		foreach ($GroupsArray as $item)
		{
			$cataloggroups[] = [
					"group" => $item->name,
					"group_name" => $item->description,
					"image_url" => '/images/groups/' . Str::lower($item->name).'.jpg',
					"url" => '/catalog/' . Str::lower($item->name)];
					$SEO .= implode([$item->description . ", "]);
		}
		
		////////////////////////////////
		TwitterCard::setTitle('Каталог запчастей - Выберите тип транспорта');
		SEOMeta::setTitle('Каталог запчастей - Выберите тип транспорта');
		SEOMeta::setDescription('Каталог запчастей - Выберите тип транспорта');
		OpenGraph::setTitle('Каталог запчастей - Выберите тип транспорта');
        OpenGraph::setDescription('Каталог запчастей - Выберите тип транспорта');
		SEOMeta::setKeywords($SEO);
		////////////////////////////////
		
		return $cataloggroups;
	}
	
	//clientside
	static function GetShopCatalogPage()
	{
		$featured  = ShopController::GetFeaturedProducts();
		
		$cataloggroups = CatalogController::GetGroups();

		return view('shop.catalog.catalog', compact('cataloggroups','featured'));
	}
	
}