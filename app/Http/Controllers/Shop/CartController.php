<?php

namespace App\Http\Controllers\Shop;

use Auth;
use Session;

use App\Models\Inventory\ProviderPrice;
use App\Models\Inventory\Pricetype;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Http\Controllers\Controller;

use App\Http\Controllers\FunctionsController as Functions;

class CartController extends Controller
{
	public static function AddToCart(Request $request)
	{
		$uid				= $request->info;
		$quantity			= $request->quantity;
		$user_currency		= currency()->getUserCurrency();
		$product			= ProviderPrice::where('uid', $uid)->first()->toArray();
		
		$cart = session()->get('cart');
		
		if(isset($product['provider_product_name']))
		{
			$product['name'] = $product['provider_product_name'];
		}
		else
		{
			$product['name'] = $product['bkey'] . ' - ' . $product['akey'];
		}

		if(isset($request->quantity))
		{
			$product['quantity'] = (int)$request->quantity;
		}
		else
		{
			$product['quantity'] = intval(1);
		}

		if(!$cart)
		{
			session()->put('cart.'.$uid, $product);
		}
				
		if(isset($cart[$uid]))
		{
			$product['quantity'] = $cart[$uid]['quantity'] + $product['quantity'];
			
			session()->put('cart.'.$uid, $product);
		}
		
		session()->put('cart.'.$uid, $product);
		$data = CartController::responseForCart($request);
		
		return response()->json($data);
		
    }
	
	public static function GetCart()
	{
		$cart = session()->get('cart');
		return $cart;
	}
	
	public static function responseForCart(Request $request)
	{
		$user_currency		= currency()->getUserCurrency();
		$currency_symbol	= currency()->find($user_currency)->symbol;
		
		$cart				= CartController::GetCart();
		$cartCount			= CartController::GetCartCount($cart);
		$cartSumCount		= CartController::GetCartSum($cart);
		
		$request->session()->put('cartCount', $cartCount);
		$request->session()->put('cartSumCount', $cartSumCount);
		
		$data = [];
		$data['cartCount']			= $cartCount;
		$data['cartSumCount']		= $cartSumCount;
		$data['currency_symbol']	= $currency_symbol;
	
		return $data;
    }

    public static function DeleteFromCart(Request $request)
    {
		$uid = $request->uid;
		$request->session()->forget('cart.'.$uid);
		
		$cart				= CartController::GetCart();
        $cartCount			= CartController::GetCartCount($cart);
		$cartSumCount		= CartController::GetCartSum($cart);
		
		$request->session()->put('cartCount', $cartCount);
		$request->session()->put('cartSumCount', $cartSumCount);

        return redirect()->back();
    }

	public static function ShowCartPage(Request $request)
	{
        $cart				= CartController::GetCartContent();
		$cartCount			= CartController::GetCartCount();
		$cartSumCount		= CartController::GetCartSum();
		$cartTax			= CartController::GetCartTax();
		$cartShipping		= CartController::GetShipping();
		$cartTotal			= CartController::GetTotal();
		$cartDiscount		= CartController::GetCartDiscount();
	
		return view('shop.pages.cart', compact('cart', 'cartCount','cartSumCount','cartTax','cartShipping','cartTotal','cartDiscount'));
    }

    public static function GetShipping()
	{
		$ship = 1;//shipping rate theoretical
		$cartShipping = 0;
		$cart = CartController::GetCart();
		$cartSumCount = CartController::GetCartSum($cart);
		
		$cartShipping = $cartSumCount * $ship / 100;
		
		return $cartShipping;
	}
	
    public static function GetTotal()
	{
		$cart = CartController::GetCart();
		$cartSumCount = CartController::GetCartSum();
		$cartTax = CartController::GetCartTax();
		$cartShipping = CartController::GetShipping();
		$cartDiscount = CartController::GetCartDiscount();
		
		//discounts
		$coupon = session()->get('coupon');
		$client_product_discount = session()->get('client_product_discount');
		//скидки только для розничных клиентов
		if($coupon && $client_product_discount == 0)
		{
			//фиксированная скидка не применяется, если сумма корзины меньше размера скидки
			if ($coupon['type'] == 'fixed' && $cartSumCount > $coupon['value'])
			{
				$cartTotal = ($cartSumCount - $coupon['value']) + $cartTax + $cartShipping;
			}
			elseif($coupon['type'] == 'percent')
			{
				$cartTotal = round(100 - $coupon['value'])/100 * $cartSumCount + $cartTax + $cartShipping;
			}
		}
		else
		{
			$cartTotal = ($cartSumCount + $cartDiscount) + $cartTax + $cartShipping;
		}
		//discounts
		
		return $cartTotal;
	}

    public static function GetCartTax()
	{
		$tax = 10;//tax rate
		$cartTax = 0;
		$cart = session()->get('cart');
		if(isset($cart))
		{
			$cartTax = array_sum(array_column($cart, 'sum_formated')) * $tax / 100;
		}
		return $cartTax;
	}

    public static function GetCartSum()
	{
		$fromated = [];
		$cartSumCount = 0;
		$cart = CartController::GetCart();
		$user_currency = currency()->getUserCurrency();
		if(isset($cart))
		{
			foreach($cart as $item)
			{
				$fromated[] = ['sum_formated' => currency($item['price'], $item['currency'], $user_currency, false) * $item['quantity']];
			}
			$cartSumCount = array_sum(array_column($fromated, 'sum_formated'));
		}
		// dd(compact('cartSumCount'));

		$cartSumCount = round($cartSumCount,2);//number format for header cart
		return $cartSumCount;
	}

    public static function GetCartCount()
	{
		$cartCount = 0;
		$cart = CartController::GetCart();
		if(isset($cart))
		{
			$cartCount = array_sum(array_column($cart, 'quantity'));
		}
		return $cartCount;
	}
	
	public static function GetCartDiscount()
	{
		$cartDiscount = 0;
		$cart = session()->get('cart');
		$client_product_discount = session()->get('client_product_discount');
		
		$PriceDiscount = intval($client_product_discount) ?? intval(0);
				
		$cartSumCount = CartController::GetCartSum($cart);
		$cartDiscount = $cartSumCount * $PriceDiscount/100;
		
		return $cartDiscount;
	}
	
	public static function ClearCart(Request $request)
	{
		$request->session()->forget('cart');
		$request->session()->forget('cartCount');
		$request->session()->forget('cartSumCount');
		$request->session()->forget('coupon');
		
		return redirect()->back();
	}

	public static function GetCartContent()
    {
		$cart = [];
		$session_cart		= session()->get('cart');
		$user_currency		= currency()->getUserCurrency();
		
		if(isset($session_cart))
		{
			foreach($session_cart as $item)
			{
					$cart[$item['uid']] = [
							'uid'							=> $item['uid'],
							'bkey'							=> $item['bkey'],
							'akey'							=> $item['akey'],
							'pkey'							=> $item['pkey'],
							'brand'							=> $item['brand'],
							'article'						=> $item['article'],
							'name'							=> $item['provider_product_name'],
							'provider_product_name'			=> $item['provider_product_name'],
							'type'							=> $item['type'],
							'available'						=> $item['available'],
							'quantity'						=> $item['quantity'],
							'day'							=> $item['day'],
							'provider'						=> $item['provider'],
							'stock'							=> $item['stock'],
							'options'						=> $item['options'],
							'provider_code'					=> $item['provider_code'],
							'price'							=> $item['price'],
							'src'							=> $item['src'],
							'currency'						=> $item['currency'],
							'date'							=> $item['date'],
							'customer_currency'				=> $user_currency,
							'image'							=> '/images/artmedia/' . $item['bkey'] . '/' . $item['akey'] . '.jpg' ?? '/images/logomedia/' . $item['bkey'] . '.webp',
							'url'							=> Functions::GetSearchURL($item['brand'], $item['akey']),
							'customer_price'				=> currency($item['price'], $item['currency'], $user_currency, false),
							'price_formated'				=> currency($item['price'], $item['currency'], $user_currency, false),
							'sum_formated'					=> currency(($item['price'] * $item['quantity']), $item['currency'], $user_currency, false)];
			}
		}
		
        return $cart;
    }
}