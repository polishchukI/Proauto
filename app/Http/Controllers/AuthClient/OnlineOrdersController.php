<?php

namespace App\Http\Controllers\AuthClient;

use App\Models\Client\ClientAddress;
use App\Models\OnlineOrder\OnlineOrder;
use App\Models\OnlineOrder\OnlineOrderProduct;
use App\Models\Inventory\OrderStatus;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FunctionsController as Functions;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

//////////seo
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
//////////seo

class OnlineOrdersController extends Controller
{
	public function index(Request $request)
	{
		$user_currency = currency()->getUserCurrency();
		
        $client_id = (int)$request->user('clients')->id;

		$orders_q = OnlineOrder::select('online_orders.*','order_statuses.name as order_status')
				->where('client_id',$client_id)
				->leftjoin('order_statuses', 'online_orders.order_status_id', '=', 'order_statuses.id')
				->get();
		if($orders_q)
		{
			$orders_q = $orders_q->toArray();		
		}
		$orders = [];
		if($orders_q)
		{		
			foreach ($orders_q as $order)
			{
				$orders[] = ['id'=>$order["id"],
						'invoice' => date("Y-m-d") . '-' . $client_id . '-' . $order["id"],
						'date'=>date('Y-m-d', strtotime($order["created_at"])),
						'currency'=>$order["currency"],
						'status'=>$order["order_status"],
						'total'=>$order["total"]];
			}
		}
		////////////////////////////////
		$total = count($orders);
		$perPage = 15;
		$page = $request->page;
		$offSet = ($page * $perPage) - $perPage;  
		$itemsForCurrentPage = array_slice($orders, $offSet, $perPage, true); 
		$orders = new LengthAwarePaginator($itemsForCurrentPage, $total, $perPage, $page,['path'  => $request->url(),'query' => $request->query(),]);
		////////////////////////////////
		SEOMeta::setTitle('Учетная запись пользователя - Заказы');
		SEOMeta::setDescription('Учетная запись пользователя - Заказы');
		OpenGraph::setTitle('Учетная запись пользователя - Заказы');
        OpenGraph::setDescription('Учетная запись пользователя - Заказы');
		////////////////////////////////
		return view('shop.account.orders', compact('orders'));
    }
	
	public function ShowOrder(Request $request)
	{
		$user_currency = currency()->getUserCurrency();
		
		$order_id = $request->order_id;
		$client_id = (int)$request->user('clients')->id;
		$order = OnlineOrder::select('online_orders.*','order_statuses.name as order_status')
				->leftjoin('order_statuses', 'online_orders.order_status_id', '=', 'order_statuses.id')
				->where('online_orders.client_id', $client_id)
				->where('online_orders.id', $order_id)
				->first();
				
		$billingaddress = ClientAddress::where('id', '=', $order->billing_address_id)->where('client_id', $client_id)->first()->toArray();
		$shippingaddress = ClientAddress::where('id', '=', $order->shipping_address_id)->where('client_id', $client_id)->first()->toArray();

		$ordersproducts = [];
		$products = OnlineOrderProduct::where('online_order_id', $order_id)->get()->toArray();
		foreach($products as $item)
		{
				$price  = (int)$item["price"];
				$price_formated  = currency($price, $item["provider_currency"], $user_currency);
				$row_total = (int)$price_formated * (int)$item["quantity"];
				
				$ordersproducts[] = [
						"bkey"					=>	$item["bkey"],
						"akey"					=>	$item["akey"],
						"article"				=>	$item["article"],
						"name"					=>	$item["name"],
						"brand"					=>	$item["brand"],
						"quantity"				=>	$item["quantity"],
						"day"					=>	$item["day"],
						"url"					=>	Functions::GetSearchURL($item["brand"], $item["akey"]),
						"stock"					=>	$item["stock"],
						"quantity"				=>	$item["quantity"],
						"code"					=>	$item["code"],
						"currency"				=>	$user_currency,
						"price_formated"		=>	$price_formated,
						"row_total"				=>	$row_total,
				];

		}
		////////////////////////////////
		SEOMeta::setTitle('Учетная запись пользователя - Заказ' . $order_id . '');
		SEOMeta::setDescription('Учетная запись пользователя - Заказ' . $order_id . '');
		OpenGraph::setTitle('Учетная запись пользователя - Заказ' . $order_id . '');
        OpenGraph::setDescription('Учетная запись пользователя - Заказ' . $order_id . '');
		////////////////////////////////
		return view('shop.account.order', compact('order','ordersproducts','billingaddress','shippingaddress'));
	}
}
