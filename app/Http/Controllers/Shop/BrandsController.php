<?php
// "id" => 1
// "brand" => "1A FIRST AUTOMOTIVE"
// "brand_text" => "<p>1A FIRST AUTOMOTIVE</p>"
// "off_site" => "site"
// "catalog_url" => "catalog"
// "lng_id" => 16
// "iso" => "uk"
// "country" => "Ukraine"
// "slug" => "1a-first-automotive"
// "logo" => null
namespace App\Http\Controllers\Shop;

use DB;
use App\Models\Brand\Brand;
use App\Models\Brand\BrandRating;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FunctionsController as Functions;

//////////seo
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
//////////seo

class BrandsController extends Controller
{
    public function ShowBrandsPage(Request $request)
    {
		$brands = [];
		$brandsSQL = Brand::where('isactive','=','True')
			->where('isprovider','=','True')
			->where('isshowable','=','True')
			->orderBy('brand','DESC')
			->get()
			->toArray();
		
		foreach($brandsSQL as $brand)
		{
			$brands[] = ["id"=>$brand["id"],
					"brand"=>$brand["brand"],
					"brand_text"=>$brand["brand_text"],
					"off_site"=>$brand["off_site"],
					"catalog_url"=>$brand["catalog_url"],
					// "lng_id"=>$brand["lng_id"],
					"iso"=>$brand["iso"],
					"country"=>$brand["country"],
					"slug"=>$brand["slug"],
					"logo"=>'/images/logomedia/' . Functions::SingleKey($brand["brand"], true) . '.webp'];
		}
		
		return view('shop.pages.brands', compact('brands'));
	}
	
	function ShowBrandPage(Request $request)
	{
		$brandslug = $request->slug;
		$brandInfo = Brand::where("slug",$brandslug)->first()->toArray();
		
		$brandInfo["off_site"] = 'http://' . $brandInfo["off_site"];
		$brandInfo["catalog_url"] = 'http://' . $brandInfo["catalog_url"];
		
		$brandInfo["main_image"] = $brandInfo["logo"] = '/images/logomedia/' . Functions::SingleKey($brandInfo["brand"], true) . '.webp';
		$brandInfo["flag_media"] = '/images/flags/worldwide.png';
		if(array_key_exists("iso", $brandInfo) && $brandInfo["iso"]!="")
		{
			$brandInfo["flag_media"] = '/images/flags/' . $brandInfo["iso"] . '.png';
		}
		//star rating
		$rate = BrandRating::where('brand_id',$brandInfo["id"])->avg('rating');
		if($rate)
		{
			$brandInfo["rating"] = $rate;
			$brandInfo["rating_left"] = 5 - $rate;
			$brandInfo["reviewscount"] = BrandRating::where('brand_id',$brandInfo["id"])->count('client_id');
		}
		else
		{
			$brandInfo["rating"] = intval(0);
			$brandInfo["rating_left"] = intval(5);
			$brandInfo["reviewscount"] = intval(0);
		}
		$reviews_sql = BrandRating::where('brand_id',$brandInfo["id"])
				->select('brands_ratings.client_id',
						'brands_ratings.rating as rating',
						DB::raw('(5 - brands_ratings.rating) as rating_left'),
						'brands_ratings.review as review',
						'brands_ratings.created_at as date','clients.firstname as firstname','clients.lastname as lastname','clients.avatar as avatar')
				->leftjoin('clients', 'clients.id', '=', 'brands_ratings.client_id')->get();
		if($reviews_sql)
		{
			$brandInfo["reviews"] = $reviews_sql->toArray();
		}
		
		// dd(compact('brandInfo'));
		return view('shop.pages.brandinfo', compact('brandInfo'));
	}
	
	public function ratebrand(Request $request)
	{
		request()->validate([
				'brand_id' => 'required',
				'review-stars' => 'required',
				]);
				
		$rate = new BrandRating;
		$rate->brand_id = $request["brand_id"];
		$rate->review = $request["review-text"];
        $rate->rating = $request["review-stars"];
        $rate->client_id = (int)$request->user('clients')->id;
        $rate->email = $request->user('clients')->email;
		$rate->save();
		
				
		return redirect()->back();
	}
	
}
