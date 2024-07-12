<?php

namespace App\Http\Controllers\AuthClient;

use App\Models\Client\ClientAuto;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FunctionsController as Functions;
use App\Http\Controllers\Catalog\CatalogController;

use Illuminate\Http\Request;

//////////seo
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
//////////seo

class GarageController extends Controller
{
	public function index(Request $request)
	{
		$client_id = (int)$request->user('clients')->id;
		$garage = ClientAuto::where('client_id',$client_id)->get()->toArray();

		$groups = CatalogController::GetGroups();

		////////////////////////////////			
		SEOMeta::setTitle('Аккаунт посетителя - Гараж');
		SEOMeta::setDescription('Аккаунт посетителя - Гараж');
		OpenGraph::setTitle('Аккаунт посетителя - Гараж');
		OpenGraph::setDescription('Аккаунт посетителя - Гараж');
		////////////////////////////////
        
		return view('shop.account.garage', compact('groups','garage'));
    }
	
}
