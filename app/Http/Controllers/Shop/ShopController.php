<?php

namespace App\Http\Controllers\Shop;

use App\Models\Blog\Post;
use App\Models\Inventory\ProviderPrice;
use App\Models\Shop\Askprice;
use App\Models\Shop\ShopMessageSubject;
use App\Models\Product\Product;
use App\Models\Product\ProductRating;
use App\Models\Product\ProductStock;
use App\Models\OnlineOrder\OnlineOrder;
use App\Models\OnlineOrder\OnlineOrderProduct;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FunctionsController as Functions;
use App\Http\Controllers\Shop\BlogController;
use App\Http\Controllers\Shop\TestimonialsController;
use App\Http\Controllers\Catalog\CatalogController;
//////////seo
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
//////////seo

use App\Rules\Recaptcha;
use Illuminate\Support\Facades\Validator;

class ShopController extends Controller
{
    public function ShowHomePage(Request $request)
    {
		////////////////////////////////
		SEOMeta::setTitle('Интернет магазин запчстей для иномарок');
		SEOMeta::setDescription('Интернет магазин запчастей для иномарок | Каталог запчастей | Доставка | Гарантия | Качество | Горловка');
		
		OpenGraph::setTitle('Интернет магазин запчстей для иномарок');
		OpenGraph::setDescription('Интернет магазин запчастей для иномарок | Каталог запчастей | Доставка | Гарантия | Качество | Горловка');
        OpenGraph::addProperty('type', 'website');
        OpenGraph::addProperty('latitude', '-48.333611');
        OpenGraph::addProperty('longitude', '-141.9075');
        OpenGraph::addProperty('street-address', 'Ostapenko');
        OpenGraph::addProperty('locality', 'Horlivka');
        OpenGraph::addProperty('region', 'DN');
        OpenGraph::addProperty('postal-code', '84646');
        OpenGraph::addProperty('country-name', 'Ukraine');
		OpenGraph::addImage('https://proauto.shop/images/opengraph.png');
		
		TwitterCard::setTitle('Интернет магазин запчстей для иномарок');
		TwitterCard::setSite($request->url());
		////////////////////////////////
		
		$specialoffers = $this->GetSpecialOffers();
		$bestsellers = $this->GetBestsellers();
		$toprated = $this->GetTopRated();
		$featured = $this->GetFeaturedProducts();
		$newarrivals = $this->GetNewArrivals();
		$posts = BlogController::ShowPostsCarousel();
		$groups = CatalogController::GetGroups();
		
		return view('shop.index', compact('bestsellers', 'featured', 'toprated', 'posts', 'newarrivals','groups','specialoffers'));
    }

    public function ShowContactPage(Request $request)
    {
		$subjects = ShopMessageSubject::all()->toArray();
		////////////////////////////////
		SEOMeta::setTitle('Интернет магазин запчастей для иномарок | Связаться с нами');
		SEOMeta::setDescription('Интернет магазин запчастей для иномарок | Связаться с нами');
		
		OpenGraph::setTitle('Интернет магазин запчастей для иномарок | Связаться с нами');
        OpenGraph::setDescription('Интернет магазин запчастей для иномарок | Связаться с нами');
        OpenGraph::addProperty('type', 'website');
        OpenGraph::addProperty('latitude', '-48.333611');
        OpenGraph::addProperty('longitude', '-141.9075');
        OpenGraph::addProperty('street-address', 'Ostapenko');
        OpenGraph::addProperty('locality', 'Horlivka');
        OpenGraph::addProperty('region', 'DN');
        OpenGraph::addProperty('postal-code', '84646');
        OpenGraph::addProperty('country-name', 'Ukraine');
		OpenGraph::addImage('https://proauto.shop/images/opengraph.png');
		
		TwitterCard::setTitle('Интернет магазин запчастей для иномарок | Связаться с нами');
		TwitterCard::setSite($request->url());
		////////////////////////////////
        return view('shop.pages.contact', compact('subjects'));
    }

	public function ShowAboutPage(Request $request)
	{
		////////////////////////////////
		SEOMeta::setTitle('Интернет магазин запчастей для иномарок | О нас');
		SEOMeta::setDescription('Интернет магазин запчастей для иномарок | О нас');
		
		OpenGraph::setTitle('Интернет магазин запчастей для иномарок | О нас');
        OpenGraph::setDescription('Интернет магазин запчастей для иномарок | О нас');
        OpenGraph::addProperty('type', 'website');
		
		OpenGraph::addImage('https://proauto.shop/images/opengraph.png');
		
		TwitterCard::setTitle('Интернет магазин запчастей для иномарок | О нас');
		TwitterCard::setSite($request->url());
		
		$testimonials = TestimonialsController::ShowTestimonials();

        return view('shop.pages.about', compact('testimonials'));
    }
	
	public function ShowComparePage(Request $request)
	{
		////////////////////////////////
		SEOMeta::setTitle('Интернет магазин запчастей для иномарок | Сравнение');
		SEOMeta::setDescription('Интернет магазин запчастей для иномарок | Сравнение');
		
		OpenGraph::setTitle('Интернет магазин запчастей для иномарок | Сравнение');
        OpenGraph::setDescription('Интернет магазин запчастей для иномарок | Сравнение');
        OpenGraph::addProperty('type', 'website');
		OpenGraph::addImage('https://proauto.shop/images/opengraph.png');
		
		TwitterCard::setTitle('Интернет магазин запчастей для иномарок | Сравнение');
		TwitterCard::setSite($request->url());
		////////////////////////////////
        return view('shop.pages.compare');
	}
	
	public function ShowTrackOrderPage(Request $request)
	{
		////////////////////////////////
		SEOMeta::setTitle('Интернет магазин запчастей для иномарок | Отследить заказ');
		SEOMeta::setDescription('Интернет магазин запчастей для иномарок | Отследить заказ');
		
		OpenGraph::setTitle('Интернет магазин запчастей для иномарок | Отследить заказ');
        OpenGraph::setDescription('Интернет магазин запчастей для иномарок | Отследить заказ');
        OpenGraph::addProperty('type', 'website');
        OpenGraph::addProperty('latitude', '-48.333611');
        OpenGraph::addProperty('longitude', '-141.9075');
        OpenGraph::addProperty('street-address', 'Ostapenko');
        OpenGraph::addProperty('locality', 'Horlivka');
        OpenGraph::addProperty('region', 'DN');
        OpenGraph::addProperty('postal-code', '84646');
        OpenGraph::addProperty('country-name', 'Ukraine');
		OpenGraph::addImage('https://proauto.shop/images/opengraph.png');
		
		TwitterCard::setTitle('Интернет магазин запчастей для иномарок | Отследить заказ');
		TwitterCard::setSite($request->url());
		////////////////////////////////
        return view('shop.pages.track-order');
	}
	
    public function ShowPrivacyPage(Request $request)
    {
		////////////////////////////////
		SEOMeta::setTitle('Интернет магазин запчстей для иномарок');
		SEOMeta::setDescription('Интернет магазин запчастей для иномарок | Политика приватности');
		
		OpenGraph::setTitle('Интернет магазин запчастей для иномарок');
        OpenGraph::setDescription('Интернет магазин запчастей для иномарок | Политика приватности');
        OpenGraph::addProperty('type', 'website');
        OpenGraph::addProperty('latitude', '-48.333611');
        OpenGraph::addProperty('longitude', '-141.9075');
        OpenGraph::addProperty('street-address', 'Ostapenko');
        OpenGraph::addProperty('locality', 'Horlivka');
        OpenGraph::addProperty('region', 'DN');
        OpenGraph::addProperty('postal-code', '84646');
        OpenGraph::addProperty('country-name', 'Ukraine');
		OpenGraph::addImage('https://proauto.shop/images/opengraph.png');
		
		TwitterCard::setTitle('Интернет магазин запчастей для иномарок | Политика приватности');
		TwitterCard::setSite($request->url());
		////////////////////////////////
        return view('shop.pages.privacy');
    }
	
	public function ShowServicesPage(Request $request)
	{
		////////////////////////////////
		SEOMeta::setTitle('Интернет магазин запчастей для иномарок | Услуги');
		SEOMeta::setDescription('Интернет магазин запчастей для иномарок | Услуги');
		
		OpenGraph::setTitle('Интернет магазин запчастей для иномарок | Услуги');
        OpenGraph::setDescription('Интернет магазин запчастей для иномарок | Услуги');
        OpenGraph::addProperty('type', 'website');
        OpenGraph::addProperty('latitude', '-48.333611');
        OpenGraph::addProperty('longitude', '-141.9075');
        OpenGraph::addProperty('street-address', 'Ostapenko');
        OpenGraph::addProperty('locality', 'Horlivka');
        OpenGraph::addProperty('region', 'DN');
        OpenGraph::addProperty('postal-code', '84646');
        OpenGraph::addProperty('country-name', 'Ukraine');
		OpenGraph::addImage('https://proauto.shop/images/opengraph.png');
		
		TwitterCard::setTitle('Интернет магазин запчастей для иномарок | Услуги');
		TwitterCard::setSite($request->url());
		////////////////////////////////
        return view('shop.pages.services');
	}
	
	public function ShowDeliveryInfoPage(Request $request)
	{
		////////////////////////////////
		SEOMeta::setTitle('Интернет магазин запчастей для иномарок | Цены на услуги');
		SEOMeta::setDescription('Интернет магазин запчастей для иномарок | Цены на услуги');
		
		OpenGraph::setTitle('Интернет магазин запчастей для иномарок | Цены на услуги');
        OpenGraph::setDescription('Интернет магазин запчастей для иномарок | Цены на услуги');
        OpenGraph::addProperty('type', 'website');
        OpenGraph::addProperty('latitude', '-48.333611');
        OpenGraph::addProperty('longitude', '-141.9075');
        OpenGraph::addProperty('street-address', 'Ostapenko');
        OpenGraph::addProperty('locality', 'Horlivka');
        OpenGraph::addProperty('region', 'DN');
        OpenGraph::addProperty('postal-code', '84646');
        OpenGraph::addProperty('country-name', 'Ukraine');
		OpenGraph::addImage('https://proauto.shop/images/opengraph.png');
		
		TwitterCard::setTitle('Интернет магазин запчастей для иномарок | Цены на услуги');
		TwitterCard::setSite($request->url());
		////////////////////////////////
        return view('shop.pages.delivery-info');
	}
	
	public function ShowReturnsPage(Request $request)
	{
		////////////////////////////////
		SEOMeta::setTitle('Интернет магазин запчастей для иномарок | Информация о возвратах');
		SEOMeta::setDescription('Интернет магазин запчастей для иномарок | Информация о возвратах');
		
		OpenGraph::setTitle('Интернет магазин запчастей для иномарок | Информация о возвратах');
        OpenGraph::setDescription('Интернет магазин запчастей для иномарок | Информация о возвратах');
        OpenGraph::addProperty('type', 'website');
        OpenGraph::addProperty('latitude', '-48.333611');
        OpenGraph::addProperty('longitude', '-141.9075');
        OpenGraph::addProperty('street-address', 'Ostapenko');
        OpenGraph::addProperty('locality', 'Horlivka');
        OpenGraph::addProperty('region', 'DN');
        OpenGraph::addProperty('postal-code', '84646');
        OpenGraph::addProperty('country-name', 'Ukraine');
		OpenGraph::addImage('https://proauto.shop/images/opengraph.png');
		
		TwitterCard::setTitle('Интернет магазин запчастей для иномарок | Информация о возвратах');
		TwitterCard::setSite($request->url());
		////////////////////////////////
        return view('shop.pages.returns');
	}
		
	public function ShowPricesPage(Request $request)
	{
		////////////////////////////////
		SEOMeta::setTitle('Интернет магазин запчастей для иномарок | Цены на услуги');
		SEOMeta::setDescription('Интернет магазин запчастей для иномарок | Цены на услуги');
		
		OpenGraph::setTitle('Интернет магазин запчастей для иномарок | Цены на услуги');
        OpenGraph::setDescription('Интернет магазин запчастей для иномарок | Цены на услуги');
        OpenGraph::addProperty('type', 'website');
        OpenGraph::addProperty('latitude', '-48.333611');
        OpenGraph::addProperty('longitude', '-141.9075');
        OpenGraph::addProperty('street-address', 'Ostapenko');
        OpenGraph::addProperty('locality', 'Horlivka');
        OpenGraph::addProperty('region', 'DN');
        OpenGraph::addProperty('postal-code', '84646');
        OpenGraph::addProperty('country-name', 'Ukraine');
		OpenGraph::addImage('https://proauto.shop/images/opengraph.png');
		
		TwitterCard::setTitle('Интернет магазин запчастей для иномарок | Цены на услуги');
		TwitterCard::setSite($request->url());
		////////////////////////////////
        return view('shop.pages.prices');
	}
	
	static function GetFeaturedProducts()
	{
		$user_currency = currency()->getUserCurrency();
		
		$featured = [];
		$ResFeatured = ProviderPrice::take(100)->get()->random(10)->toArray();
		foreach($ResFeatured as $item)
		{
			$featured[$item["bkey"] . $item["akey"]] = Functions::FormatPrice($item);
			$featured[$item["bkey"] . $item["akey"]]["aid"] = "";
			$ArtMedia = "/images/artmedia/" . $item["bkey"] . "/" . $item["akey"] . ".jpg";
			$ArtLogo = "/images/logomedia/" . $item["bkey"] . ".webp";
			$ArtMediaPath = $_SERVER["DOCUMENT_ROOT"] . $ArtMedia;
			$ArtLogoPath = $_SERVER["DOCUMENT_ROOT"] . $ArtLogo;
			if (file_exists($ArtMediaPath))
			{
				$featured[$item["bkey"] . $item["akey"]]["img_src"] = $ArtMedia;
			}
			elseif(file_exists($ArtLogoPath))
			{
				$featured[$item["bkey"] . $item["akey"]]["img_src"] = $ArtLogo;
			}
			else
			{
				$featured[$item["bkey"] . $item["akey"]]["img_src"] = "/images/no_image.webp";
			}

		}
		foreach ($featured as $item)
		{
			//rating initial values
			$rate = ProductRating::where('pkey',$item["bkey"] . $item["akey"])->avg('rating');
			if($rate)
			{
				$featured[$item["bkey"] . $item["akey"]]["rating"] = $rate;
				$featured[$item["bkey"] . $item["akey"]]["rating_left"] = 5 - $rate;
				$featured[$item["bkey"] . $item["akey"]]["reviewscount"] = ProductRating::where('pkey',$item["bkey"] . $item["akey"])->count('client_id');
			}
			else
			{
				$featured[$item["bkey"] . $item["akey"]]["rating"] = intval(0);
				$featured[$item["bkey"] . $item["akey"]]["rating_left"] = intval(5);
				$featured[$item["bkey"] . $item["akey"]]["reviewscount"] = intval(0);
			}
		}
		return $featured;
	}
	
	static function GetSpecialOffers()
	{
		$specialoffers = [];
		$user_currency = currency()->getUserCurrency();		
		$resStocks = ProductStock::take(100)->where('price_out','>',0)->get()->random(3)->toArray();
		
		foreach($resStocks as $stock_item)
		{
			$item = Product::where('id','=',$stock_item["product_id"])->first()->toArray();
			$item["currency"] = $stock_item["currency"];
			$item["price"] = $stock_item["price_out"];
			$item["provider_product_name"] = $item["name"];
			$item["options"] = ";;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;";
			$item["available"] = 0;
			
			$specialoffers[$item["bkey"] . $item["akey"]] = Functions::FormatPrice($item);
			$ArtMedia = "/images/artmedia/" . $item["bkey"] . "/" . $item["akey"] . ".jpg";
			$ArtLogo = "/images/logomedia/" . $item["bkey"] . ".webp";
			$ArtMediaPath = $_SERVER["DOCUMENT_ROOT"] . $ArtMedia;
			$ArtLogoPath = $_SERVER["DOCUMENT_ROOT"] . $ArtLogo;
			if (file_exists($ArtMediaPath))
			{
				$specialoffers[$item["bkey"] . $item["akey"]]["img_src"] = $ArtMedia;
			}
			elseif(file_exists($ArtLogoPath))
			{
				$specialoffers[$item["bkey"] . $item["akey"]]["img_src"] = $ArtLogo;
			}
			else
			{
				$specialoffers[$item["bkey"] . $item["akey"]]["img_src"] = "/images/no_image.webp";
			}
			
		}
		foreach ($specialoffers as $item)
		{
			//rating initial values
			$rate = ProductRating::where('pkey',$item["bkey"] . $item["akey"])->avg('rating');
			if($rate)
			{
				$specialoffers[$item["bkey"] . $item["akey"]]["rating"] = $rate;
				$specialoffers[$item["bkey"] . $item["akey"]]["rating_left"] = 5 - $rate;
				$specialoffers[$item["bkey"] . $item["akey"]]["reviewscount"] = ProductRating::where('pkey',$item["bkey"] . $item["akey"])->count('client_id');
			}
			else
			{
				$specialoffers[$item["bkey"] . $item["akey"]]["rating"] = intval(0);
				$specialoffers[$item["bkey"] . $item["akey"]]["rating_left"] = intval(5);
				$specialoffers[$item["bkey"] . $item["akey"]]["reviewscount"] = intval(0);
			}
		}
		
		// dd($specialoffers);
		return $specialoffers;
	}
	
	static function RandomProductsWidget()
	{
		$user_currency = currency()->getUserCurrency();

		$randomproducts = [];
		$resPrices = ProviderPrice::take(1000)->get()->random(5)->toArray();
		
		foreach($resPrices as $item)
		{
			$randomproducts[$item["bkey"] . $item["akey"]] = Functions::FormatPrice($item);
			$ArtMedia = "/images/artmedia/" . $item["bkey"] . "/" . $item["akey"] . ".jpg";
			$ArtLogo = "/images/logomedia/" . $item["bkey"] . ".webp";
			$ArtMediaPath = $_SERVER["DOCUMENT_ROOT"] . $ArtMedia;
			$ArtLogoPath = $_SERVER["DOCUMENT_ROOT"] . $ArtLogo;
			if (file_exists($ArtMediaPath))
			{
				$randomproducts[$item["bkey"] . $item["akey"]]["img_src"] = $ArtMedia;
			}
			elseif(file_exists($ArtLogoPath))
			{
				$randomproducts[$item["bkey"] . $item["akey"]]["img_src"] = $ArtLogo;
			}
			else
			{
				$randomproducts[$item["bkey"] . $item["akey"]]["img_src"] = "/images/no_image.webp";
			}
			
		}
		foreach ($randomproducts as $item)
		{
			//rating initial values
			$rate = ProductRating::where('pkey',$item["bkey"] . $item["akey"])->avg('rating');
			if($rate)
			{
				$randomproducts[$item["bkey"] . $item["akey"]]["rating"] = $rate;
				$randomproducts[$item["bkey"] . $item["akey"]]["rating_left"] = 5 - $rate;
				$randomproducts[$item["bkey"] . $item["akey"]]["reviewscount"] = ProductRating::where('pkey',$item["bkey"] . $item["akey"])->count('client_id');
			}
			else
			{
				$randomproducts[$item["bkey"] . $item["akey"]]["rating"] = intval(0);
				$randomproducts[$item["bkey"] . $item["akey"]]["rating_left"] = intval(5);
				$randomproducts[$item["bkey"] . $item["akey"]]["reviewscount"] = intval(0);
			}
		}
		
		return $randomproducts;
	}
	
	static function GetBestsellers()
	{
		//user_currency///////////////////////////////
		$user_currency = currency()->getUserCurrency();

		$bestsellers = [];
		$bs = OnlineOrderProduct::take(1000)->get()->toArray();
		foreach ($bs as $item)
		{
			$bestsellers[$item["bkey"] . $item["akey"]]["akey"] = $item["akey"];
			$bestsellers[$item["bkey"] . $item["akey"]]["bkey"] = $item["bkey"];
			$bestsellers[$item["bkey"] . $item["akey"]]["aid"] = "";
			$bestsellers[$item["bkey"] . $item["akey"]]["article"] = $item["article"];
			$bestsellers[$item["bkey"] . $item["akey"]]["brand"] = $item["brand"];
			$bestsellers[$item["bkey"] . $item["akey"]]["provider_price"] = $item["provider_price"];
			$bestsellers[$item["bkey"] . $item["akey"]]["provider_currency"] = $item["provider_currency"];
			$bestsellers[$item["bkey"] . $item["akey"]]["name"] = $item["name"];
			if (isset($bestsellers[$item["bkey"] . $item["akey"]]["count"]))
			{
				$bestsellers[$item["bkey"] . $item["akey"]]["count"]++;
			}
			else
			{
				$bestsellers[$item["bkey"] . $item["akey"]]["count"] = 1;
			}
			$bestsellers[$item["bkey"] . $item["akey"]]["price_formated"] = currency($item["provider_price"], $item["provider_currency"], $user_currency, false);
			$ArtMedia = "/images/artmedia/" . $item["bkey"] . "/" . $item["akey"] . ".jpg";
			$ArtLogo = "/images/logomedia/" . $item["bkey"] . ".webp";
			$ArtMediaPath = $_SERVER["DOCUMENT_ROOT"] . $ArtMedia;
			$ArtLogoPath = $_SERVER["DOCUMENT_ROOT"] . $ArtLogo;
			if (file_exists($ArtMediaPath))
			{
				$bestsellers[$item["bkey"] . $item["akey"]]["img_src"] = $ArtMedia;
			}
			elseif(file_exists($ArtLogoPath))
			{
				$bestsellers[$item["bkey"] . $item["akey"]]["img_src"] = $ArtLogo;
			}
			else
			{
				$bestsellers[$item["bkey"] . $item["akey"]]["img_src"] = "/images/no_image.webp";
			}
		}
		foreach ($bestsellers as $item)
		{
			//rating initial values
			$rate = ProductRating::where('pkey',$item["bkey"] . $item["akey"])->avg('rating');
			if($rate)
			{
				$bestsellers[$item["bkey"] . $item["akey"]]["rating"] = $rate;
				$bestsellers[$item["bkey"] . $item["akey"]]["rating_left"] = 5 - $rate;
				$bestsellers[$item["bkey"] . $item["akey"]]["reviewscount"] = ProductRating::where('pkey',$item["bkey"] . $item["akey"])->count('client_id');
			}
			else
			{
				$bestsellers[$item["bkey"] . $item["akey"]]["rating"] = intval(0);
				$bestsellers[$item["bkey"] . $item["akey"]]["rating_left"] = intval(5);
				$bestsellers[$item["bkey"] . $item["akey"]]["reviewscount"] = intval(0);
			}
		}
		
		usort($bestsellers, function ($a, $b)
		{
			if ($a["count"] == $b["count"])
			{
				return 0;
			}
			return ($a["count"] < $b["count"]) ? 1 : -1;
		});
		$bestsellers = array_slice($bestsellers, 0, 3);
		return $bestsellers;
	}
	
	
	static function GetTopRated()
	{
		$user_currency = currency()->getUserCurrency();

		$toprated = [];
		$tr = ProductRating::take(1000)->get()->toArray();
		foreach ($tr as $item)
		{
			$toprated[$item["bkey"] . $item["akey"]]["akey"] = $item["akey"];
			$toprated[$item["bkey"] . $item["akey"]]["bkey"] = $item["bkey"];
			$toprated[$item["bkey"] . $item["akey"]]["article"] = $item["article"];
			$toprated[$item["bkey"] . $item["akey"]]["brand"] = $item["brand"];
			$toprated[$item["bkey"] . $item["akey"]]["provider_price"] = $item["price"];
			$toprated[$item["bkey"] . $item["akey"]]["provider_currency"] = $item["currency"];
			$toprated[$item["bkey"] . $item["akey"]]["name"] = $item["name"];
			if (isset($toprated[$item["bkey"] . $item["akey"]]["count"]))
			{
				$toprated[$item["bkey"] . $item["akey"]]["count"]++;
			}
			else
			{
				$toprated[$item["bkey"] . $item["akey"]]["count"] = 1;
			}
			$toprated[$item["bkey"] . $item["akey"]]["price_formated"] = currency($item["price"], $item["currency"], $user_currency, false);
			$ArtMedia = "/images/artmedia/" . $item["bkey"] . "/" . $item["akey"] . ".jpg";
			$ArtLogo = "/images/logomedia/" . $item["bkey"] . ".webp";
			$ArtMediaPath = $_SERVER["DOCUMENT_ROOT"] . $ArtMedia;
			$ArtLogoPath = $_SERVER["DOCUMENT_ROOT"] . $ArtLogo;
			if (file_exists($ArtMediaPath))
			{
				$toprated[$item["bkey"] . $item["akey"]]["img_src"] = $ArtMedia;
			}
			elseif(file_exists($ArtLogoPath))
			{
				$toprated[$item["bkey"] . $item["akey"]]["img_src"] = $ArtLogo;
			}
			else
			{
				$toprated[$item["bkey"] . $item["akey"]]["img_src"] = "/images/no_image.webp";
			}
		}
		foreach ($toprated as $item)
		{
			//rating initial values
			$rate = ProductRating::where('pkey',$item["bkey"] . $item["akey"])->avg('rating');
			if($rate)
			{
				$toprated[$item["bkey"] . $item["akey"]]["rating"] = $rate;
				$toprated[$item["bkey"] . $item["akey"]]["rating_left"] = 5 - $rate;
				$toprated[$item["bkey"] . $item["akey"]]["reviewscount"] = ProductRating::where('pkey',$item["bkey"] . $item["akey"])->count('client_id');
			}
			else
			{
				$toprated[$item["bkey"] . $item["akey"]]["rating"] = intval(0);
				$toprated[$item["bkey"] . $item["akey"]]["rating_left"] = intval(5);
				$toprated[$item["bkey"] . $item["akey"]]["reviewscount"] = intval(0);
			}
		}
		
		usort($toprated, function ($a, $b)
		{
			if ($a["count"] == $b["count"])
			{
				return 0;
			}
			return ($a["count"] < $b["count"]) ? 1 : -1;
		});
		$toprated = array_slice($toprated, 0, 3);

		return $toprated;
	}
	
	static function GetNewArrivals()
	{
		$user_currency = currency()->getUserCurrency();
		
		$newarrivals = [];
		//$arrivals = ProviderPrice::where('provider', "default")->take(1000)->get();
		$arrivals = ProviderPrice::take(1000)->get();
		$arrivals = ($arrivals->count() < 12)?[] : $arrivals->random(12)->toArray();

		foreach($arrivals as $item)
		{
			$newarrivals[$item["bkey"] . $item["akey"]] = Functions::FormatPrice($item);
			
			$newarrivals[$item["bkey"] . $item["akey"]]["aid"] = "";
			$newarrivals[$item["bkey"] . $item["akey"]]["price_formated"] = currency($item["price"], $item["currency"], $user_currency, false);
			$ArtMedia = "/images/artmedia/" . $item["bkey"] . "/" . $item["akey"] . ".jpg";
			$ArtLogo = "/images/brands/" . $item["bkey"] . ".png";
			$ArtMediaPath = $_SERVER["DOCUMENT_ROOT"] . $ArtMedia;
			$ArtLogoPath = $_SERVER["DOCUMENT_ROOT"] . $ArtLogo;
			if (file_exists($ArtMediaPath))
			{
				$newarrivals[$item["bkey"] . $item["akey"]]["img_src"] = $ArtMedia;
			}
			elseif(file_exists($ArtLogoPath))
			{
				$newarrivals[$item["bkey"] . $item["akey"]]["img_src"] = $ArtLogo;
			}
			else
			{
				$newarrivals[$item["bkey"] . $item["akey"]]["img_src"] = "/images/no_image.webp";
			}			
		}

		foreach ($newarrivals as $item)
		{
			//rating initial values
			$rate = ProductRating::where('pkey',$item["bkey"] . $item["akey"])->avg('rating');
			if($rate)
			{
				$newarrivals[$item["bkey"] . $item["akey"]]["rating"] = $rate;
				$newarrivals[$item["bkey"] . $item["akey"]]["rating_left"] = 5 - $rate;
				$newarrivals[$item["bkey"] . $item["akey"]]["reviewscount"] = ProductRating::where('pkey',$item["bkey"] . $item["akey"])->count('client_id');
			}
			else
			{
				$newarrivals[$item["bkey"] . $item["akey"]]["rating"] = intval(0);
				$newarrivals[$item["bkey"] . $item["akey"]]["rating_left"] = intval(5);
				$newarrivals[$item["bkey"] . $item["akey"]]["reviewscount"] = intval(0);
			}
		}
		return $newarrivals;
	}
}