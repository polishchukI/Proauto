<?php

namespace App\Http\Controllers\AuthClient;

use App\Models\Client\ClientAddress;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

//////////seo
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
//////////seo

class AddressesController extends Controller
{

	public function index(Request $request)
	{
        $client_id = (int)$request->user('clients')->id;
		$addresses = [];
		$query = ClientAddress::where('client_id',$client_id)->get();
		if($query)
		{
			$addresses = $query->toArray();
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
		return view('shop.account.addresses', compact('addresses'));
    }
	
    public function create(Request $request)
    {
		$address = [];
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
		return view('shop.account.address', compact('address'));
    }
	
    public function store(Request $request)
    {
		$client_id = (int)$request->user('clients')->id;
		$address = new ClientAddress;
		$address->client_id = $client_id;
		$address->country = $request->country;
		$address->street = $request->street;
		$address->address = $request->address;
		$address->shipping = $request->shipping;
		$address->billing = $request->billing;
		$address->city = $request->city;
        $address->state = $request->state;
		$address->zipcode = $request->postcode;
		$address->name = $request->country . ', ' . $request->state . ', ' . $request->postcode . ', ' . $request->city . ', ' . $request->street . ', ' . $request->address;
		$address->save();

		return redirect('account/addresses')->with('flash_message', 'ClientAddress created!');
    }
	
    public function edit(Request $request)
    {
		$edit = true;
		$id = (int)$request->id;
		$cid = (int)$request->user('clients')->id;
		
		$address = ClientAddress::where('id','=', $id)->where('client_id','=', $cid)->first()->toArray();
		
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
		return view('shop.account.address', compact('address','edit'));
    }
	
    public function update(Request $request)
    {
		$requestData = $request->all();
	
		$id = (int)$request->id;
		$cid = (int)$request->user('clients')->id;

		$address = ClientAddress::where('id','=', $id)->where('client_id','=', $cid)->first();
		if(isset($request->default) && $request->default == "on")
		{
			$requestData['default'] = 1;
		}
		else
		{
			$requestData['default'] = 0;
		}
		if(isset($request->billing) && $request->billing == "on")
		{
			$requestData['billing'] = 1;
		}
		else
		{
			$requestData['billing'] = 0;
		}
		
		if(isset($request->shipping) && $request->shipping == "on")
		{
			$requestData['shipping'] = 1;
		}
		else
		{
			$requestData['shipping'] = 0;
		}
		
		$address->update($requestData);
		
		return redirect('account/addresses')->with('flash_message', 'Client Address updated!');
    }
	
    public function delete(Request $request)
    {
		$id = (int)$request->id;
		$cid = (int)$request->user('clients')->id;

		ClientAddress::where('id','=', $id)->where('client_id','=', $cid)->delete();
		
		return redirect('account/addresses')->with('flash_message', 'ClientAddress deleted!');
    }
}
