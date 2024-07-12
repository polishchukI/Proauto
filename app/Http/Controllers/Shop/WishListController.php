<?php

namespace App\Http\Controllers\Shop;

use Session;

use App\Models\Inventory\ProviderPrice;
use App\Models\Inventory\Pricetype;
use App\Models\Product\ProductRating;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FunctionsController as Functions;

//////////seo
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
//////////seo

class WishListController extends Controller
{
	public function AddToWishList(Request $request)
	{
		$uid				= $request->wishlist;
		$user_currency		= currency()->getUserCurrency();
		$product			= ProviderPrice::where('uid', $uid)->first()->toArray();

		if(isset($product["provider_product_name"]))
		{
			$product["name"] = $product["provider_product_name"];
		}
		else
		{
			$product["name"] = $product["bkey"] . " - " . $product["akey"];
		}
		
		if(isset($request["quanity"]))
		{
			$product["quanity"] = $request["quanity"];
		}
		else
		{
			$product["quanity"] = 1;
		}
		$rate = ProductRating::where('pkey',$product["bkey"] . $product["akey"])->avg('rating');
		if($rate)
		{
			$product["RATING"] = $rate;
			$product["RATING_LEFT"] = 5 - $rate;
			$product["REVIEWSCOUNT"] = ProductRating::where('pkey',$product["bkey"] . $product["akey"])->count('client_id');
		}
		else
		{
			$product["RATING"] = intval(0);
			$product["RATING_LEFT"] = intval(5);
			$product["REVIEWSCOUNT"] = intval(0);
		}
		
		$wishlist = WishListController::GetWishListContent();
		$wishlistCount = WishListController::GetWishListCount($wishlist);

		session()->put('wishlist.'.$uid, $product);
		session()->put('wishlistCount', $wishlistCount);
		
	}
	
	public static function GetWishListCount($wishlist)
	{
		$wishlistCount = 0;
		$wishlist = WishListController::GetWishListContent();
		if(isset($wishlist))
		{
			$wishlistCount = count($wishlist);
		}		
		return $wishlistCount;
	}
	
	public function ShowWishListPage(Request $request)
	{
		$wishlist = WishListController::GetWishListContent();
		$wishlistCount = WishListController::GetWishListCount($wishlist);
		
		SEOMeta::setTitle('Список желаний');
		SEOMeta::setDescription('Список желаний');
		OpenGraph::setTitle('Список желаний');
        OpenGraph::setDescription('Список желаний');
		SEOMeta::setKeywords('Список желаний');		

		return view('shop.pages.wishlist', compact('wishlist', 'wishlistCount'));
	}
	
	public static function GetWishListContent()
    {
		$user_currency = currency()->getUserCurrency();

        $wishlist = [];
		$wishlist = session()->get('wishlist');
		
		if(isset($wishlist))
		{		
			foreach($wishlist as $item)
			{
				$wishlist[$item['uid']] = [
						'uid'					=> $item['uid'],
						'bkey'					=> $item['bkey'],
						'akey'					=> $item['akey'],
						'pkey'					=> $item['pkey'],
						'brand'					=> $item['brand'],
						'article'				=> $item['article'],
						'name'					=> $item['provider_product_name'],
						'provider_product_name'				=> $item['provider_product_name'],
						'type'					=> $item['type'],
						'available'				=> $item['available'],
						'quanity'				=> $item['quanity'],
						'day'					=> $item['day'],
						'provider'				=> $item['provider'],
						'stock'					=> $item['stock'],
						'options'				=> $item['options'],
						'code'					=> $item['code'],
						'price'					=> $item['price'],
						'src'					=> $item['src'],
						'currency'				=> $item['currency'],
						'date'					=> $item['date'],
						'client_currency'		=> $user_currency,
						'image'					=> '/uploads/artmedia/' . $item['bkey'] . '/' . $item['akey'] . '.jpg',
						'url'					=> Functions::GetSearchURL($item['brand'], $item['akey']),
						'client_price'		=> currency($item['price'], $item['currency'], $user_currency, false),
						'price_formated'		=> currency($item['price'], $item['currency'], $user_currency, false),
						'sum_formated'			=> currency(($item['price'] * $item['quanity']), $item['currency'], $user_currency, false)];
			}
		}
        return $wishlist;
    }
	
	public static function DeleteFromWishlist(Request $request)
    {
		$uid = $request->uid;
		$request->session()->forget('wishlist.'.$uid);
		
		$wishlist = WishListController::GetWishListContent();
		$wishlistCount = WishListController::GetWishListCount($wishlist);

		session()->put('wishlistCount', $wishlistCount);
        
		return redirect()->back();
	}
}
