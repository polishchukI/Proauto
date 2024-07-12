<?php

namespace App\Http\Controllers\Shop;

use Session;

use App\Models\Client\ClientAddress;
use App\Models\Client\Client;
use App\Models\Inventory\OrderStatus;
use App\Models\Inventory\PaymentMethod;
use App\Models\OnlineOrder\OnlineOrder;
use App\Models\OnlineOrder\OnlineOrderProduct;
use App\Models\OnlineOrder\OnlineOrderHistory;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\TelegramBotController;
use App\Http\Controllers\Shop\CartController;
use App\Http\Controllers\FunctionsController as Functions;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {		
		$billingaddresses = [];
		$shippingaddresses = [];
		$client_id = (int)$request->user('clients')->id;
		$client = Client::where('id', $client_id)->first();
		if($client)
		{
			$client = $client->toArray();
			$billingaddresses = ClientAddress::where('client_id', $client_id)->where('billing', '=', 1)->orWhere('default', 1)->get()->toArray();
			$shippingaddresses = ClientAddress::where('client_id', $client_id)->where('shipping', '=', 1)->orWhere('default', 1)->get()->toArray();
		}
		
		$cart = $this->GetCheckoutCartContent($request);
		$cartCount = CartController::GetCartCount($cart);
		$cartSumCount = CartController::GetCartSum($cart);
		$cartTax = CartController::GetCartTax($cart);
		$cartShipping = CartController::GetShipping($cart);
		$clientBalance = $this->GetclientBalance($client);
		$cartTotal = CartController::GetTotal($cart);
		
		$paymentmethods = [];
		$paymentmethods = PaymentMethod::select('id', 'name', 'description')->where('status',1)->get()->toArray();

        return view('shop.pages.checkout', compact('cart','cartCount','cartSumCount','clientBalance','cartTax','cartShipping','cartTotal','billingaddresses','shippingaddresses','paymentmethods'));
    }
	
	public function GetclientBalance($client)
	{
		// if($client)
		// {
		// 	$clientBalance = (int)$client->balance;
		// }
		// else
		// {
			$clientBalance = 0;
		// }
		
		return $clientBalance;
	}
		
    public function placeorder(Request $request)
    {	
		//client
		$client_id								= (int)$request->user('clients')->id;
		$client									= Client::where('id', $client_id)->first();
		
		//////////
		$cart									= $session_cart = $this->GetCheckoutCartContent();
		$cartCount								= CartController::GetCartCount($cart);
		$cartSumCount							= CartController::GetCartSum($cart);
		$cartTax								= CartController::GetCartTax($cart);
		$cartShipping							= CartController::GetShipping($cart);
		$clientBalance							= $this->GetclientBalance($client);
		$cartTotal								= CartController::GetTotal($cart);
		
		/////////////////////////////////////////////////////////////
		//order info
		$order									= new OnlineOrder;
		$invoice								= date("Y-m-d") . '-' . $client_id;
		$order->client_id						= $client_id;
		$order->client_product_discount			= $client->client_product_discount;
		$order->firstname						= $client->firstname;
		$order->lastname						= $client->lastname;
		$order->email							= $client->email;
        $order->phone							= $client->telephone;
		$order->comment							= $request->checkout_comment;
		
		//Billing address
		$order->billing_address_id				= $request->checkout_address;
		
		//Shipping address
		if($request->checkout_different_address!=="on")
		{
			$order->shipping_address_id = $request->shipping_address;
		}
		else
		{
			$order->shipping_address_id = $request->checkout_address;
		}
			
		$order->created_at = date("Y-m-d");
		$order->count = $cartCount;
		$order->subtotal = $cartSumCount;
		$order->invoice = $invoice;
		$order->order_status_id = 1;
		$order->delivery_id = 1;
		$order->tax = $cartTax;
		$order->shipping = $cartShipping;
		$order->total = $cartTotal + $clientBalance;
		$order->currency = currency()->getUserCurrency();
		$order->save();
		
		//get data
		$order_id = $order->id;
		
		foreach ($session_cart as $item)
		{
            OnlineOrderProduct::create([
							'client_id'			=> $client_id,
							'online_order_id'				=> $order_id,
							'akey'					=> $item["akey"],
							'bkey'					=> $item["bkey"],
							'pkey'					=> $item["bkey"] . $item["akey"],
							'product_id'			=> $item["uid"],
							'article'				=> $item["article"],
							'brand'					=> $item["brand"],
							'name'					=> $item["name"],
							'model'					=> $item["bkey"] . '_' . $item["akey"],
							'quantity'				=> $item["quantity"],
							'provider_price'		=> $item["price"],
							'provider_currency'		=> $item["currency"],
							'order_currency'		=> currency()->getUserCurrency(),
							'price'					=> currency($item["price"], $item["currency"], currency()->getUserCurrency(), false),
							'total'					=> currency(($item["price"] * $item["quantity"]), $item["currency"], currency()->getUserCurrency(), false),
							'tax'					=> 0,
							'reward'				=> 0,
							'code'					=> $item["provider_code"],
							'provider'				=> $item["provider_code"],
							'stock'					=> $item["stock"],
							'options'				=> $item["options"],
							'day'					=> $item["day"]
							]);
        }
		$request->session()->forget('cart');
		$request->session()->forget('cartCount');
		$request->session()->forget('cartSumCount');
		
		$billingaddress = ClientAddress::where('id', '=', $order->billing_address_id)->where('client_id', $client_id)->first()->toArray();
		$shippingaddress = ClientAddress::where('id', '=', $order->shipping_address_id)->where('client_id', $client_id)->first()->toArray();
		
		//client telegram notification
		// if(isset($client->chat_id) && isset($client->telegram_notifications) && ($client->telegram_notifications == 1))
		// {
			// $chat_id				= $client->chat_id;
			// $text					= 'Hello ' . $client->firstname . ' ! Your order has been accepted. We contact you ASAP!';
			// $TelegramBotController	= new TelegramBotController;
			// $TelegramBotController->sendMessage($chat_id, $text);
		// }
		
		OnlineOrderHistory::create(['order_id' => $order_id, 'client_id' => $client_id, 'status_id' => '1']);
		
		return view('shop.pages.checkoutsuccessful', compact('cart','order','cartCount','cartSumCount','clientBalance','cartTax','cartShipping','cartTotal','billingaddress','shippingaddress'));
    }
	
    public static function GetCheckoutCartContent()
    {		
		$cart = CartController::GetCartContent();

        return $cart;
    }
}
