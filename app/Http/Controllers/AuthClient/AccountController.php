<?php

namespace App\Http\Controllers\AuthClient;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

// use App\Models\Client\Pricetype;
use App\Models\Client\Profile;
use App\Models\Client\ClientAddress;
use App\Models\Client\ClientPhone;
use App\Models\OnlineOrder\OnlineOrder;

use Illuminate\Support\Facades\Storage;

//////////seo
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
//////////seo

class AccountController extends Controller
{
	public function index(Request $request)
	{
		$user_currency = currency()->getUserCurrency();

        $client_id = (int)$request->user('clients')->id;
		$client = Profile::where('id', $client_id)->first()->toArray();
		
		$orders = [];
		$orders_c = OnlineOrder::where('client_id',$client_id)->orderBy('created_at','DESC')->take(5)->get();
		if($orders_c)
		{
			foreach ($orders_c as $order)
			{
				$orders[] = ['id'=>$order["id"],
						'invoice'=>$order["invoice_prefix"] .'#' . $order["invoice"],
						'date'=>date('Y-m-d', strtotime($order["created_at"])),
						'status'=>$order["order_status_id"],
						'total'=>$order["total"]];
			}
		}
		$deafult_address = [];
		$address = ClientAddress::where('client_id', $client_id)->where('default',1)->first();
		if($address)
		{
			$deafult_address = $address->toArray();
		}
		
		////////////////////////////////
		SEOMeta::setTitle('Аккаунт посетителя - Панель пользователя');
		SEOMeta::setDescription('Аккаунт посетителя - Панель пользователя');
		
		OpenGraph::setTitle('Аккаунт посетителя - Панель пользователя');
        OpenGraph::setDescription('Аккаунт посетителя - Панель пользователя');
        OpenGraph::addProperty('type', 'website');
		OpenGraph::addImage('https://proauto.shop/images/opengraph.png');
		
		TwitterCard::setTitle('Аккаунт посетителя - Панель пользователя');
		TwitterCard::setSite($request->url());
		////////////////////////////////
		
		return view('shop.account.dashboard', compact('orders', 'deafult_address'));
    }
	
	public function ShowLoginPage(Request $request)
    {
		////////////////////////////////
		SEOMeta::setTitle('Интернет магазин запчастей для иномарок | Регистрация/Вход');
		SEOMeta::setDescription('Интернет магазин запчастей для иномарок | Регистрация/Вход');
		
		OpenGraph::setTitle('Интернет магазин запчастей для иномарок | Регистрация/Вход');
        OpenGraph::setDescription('Интернет магазин запчастей для иномарок | Регистрация/Вход');
        OpenGraph::addProperty('type', 'website');
		OpenGraph::addImage('https://proauto.shop/images/opengraph.png');
		
		TwitterCard::setTitle('Интернет магазин запчастей для иномарок | Регистрация/Вход');
		TwitterCard::setSite($request->url());
		////////////////////////////////
        return view('shop.account.login');
    }
	
	public function ShowRegisterPage(Request $request)
    {
		////////////////////////////////
		SEOMeta::setTitle('Интернет магазин запчастей для иномарок | Регистрация/Вход');
		SEOMeta::setDescription('Интернет магазин запчастей для иномарок | Регистрация/Вход');
		
		OpenGraph::setTitle('Интернет магазин запчастей для иномарок | Регистрация/Вход');
        OpenGraph::setDescription('Интернет магазин запчастей для иномарок | Регистрация/Вход');
        OpenGraph::addProperty('type', 'website');
		OpenGraph::addImage('https://proauto.shop/images/opengraph.png');
		
		TwitterCard::setTitle('Интернет магазин запчастей для иномарок | Регистрация/Вход');
		TwitterCard::setSite($request->url());
		////////////////////////////////
        return view('shop.account.register');
    }
}