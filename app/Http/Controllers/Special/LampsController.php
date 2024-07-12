<?php

namespace App\Http\Controllers\Special;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

//////////seo
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
//////////seo

class LampsController extends Controller
{
	public function ShowLampsList(Request $request)
	{
		$SEO = 'Подбор ламп для автомобиля';
		////////////////////////////////
		SEOMeta::setTitle($SEO);
		SEOMeta::setDescription('Интернет магазин запчастей для иномарок | ' . $SEO . ' | Доставка | Гарантия | Качество | Горловка');
		
		OpenGraph::setTitle('Интернет магазин запчстей для иномарок | ' . $SEO);
		OpenGraph::setDescription('Интернет магазин запчастей для иномарок | ' . $SEO . ' | Доставка | Гарантия | Качество | Горловка');
        OpenGraph::addProperty('type', 'website');
        OpenGraph::addProperty('latitude', '-48.333611');
        OpenGraph::addProperty('longitude', '-141.9075');
        OpenGraph::addProperty('street-address', 'Ostapenko');
        OpenGraph::addProperty('locality', 'Horlivka');
        OpenGraph::addProperty('region', 'DN');
        OpenGraph::addProperty('postal-code', '84646');
        OpenGraph::addProperty('country-name', 'Ukraine');
		OpenGraph::addImage('https://proauto.shop/images/opengraph.png');
		
		TwitterCard::setTitle('Интернет магазин запчстей для иномарок | ' . $SEO);
		TwitterCard::setSite($request->url());
		TwitterCard::setUrl($request->url());
		////////////////////////////////
		return view('shop.special.lamps');
    }
}
