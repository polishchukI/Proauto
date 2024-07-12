<?php

namespace App\Http\Controllers\Catalog;

use Illuminate\Http\Request;
use App\Models\Product\ProductCross;
use App\Models\Product\ProductRating;
use App\Models\Inventory\ProviderPrice;

use App\Http\Controllers\Tecdoc\NewTecdocController;

use App\Http\Controllers\Controller;

use App\Http\Controllers\FunctionsController as Functions;

class QuickviewController extends Controller
{
    static function askprice(Request $request)
	{
		$ResultArray = [
                "brand" => $request->brand,
                "article" => $request->article];
		
		return view('shop.modal.askprice', compact('ResultArray'));
	}
	
	static function quickview(Request $request)
	{
		$ResultArray = [
            "brand" => $request->brand,
            "article" => $request->article];

        $uaid = $request->uaid;
		if($uaid)
		{
			$aid = Functions::GetBackUrID($uaid);
		}

		$ResultArray["bkey"] = Functions::SingleKey($ResultArray["brand"], true);
		$ResultArray["akey"] = Functions::SingleKey($ResultArray["article"]);
		$noimage = '/images/no_image.webp';
		$logoimage = '/images/logomedia/' . $ResultArray["bkey"] . '.webp';
		$partimage = '/images/artmedia/' . $ResultArray["bkey"] . '/' . $ResultArray["akey"] . '.jpg';
		
		$ResultArray["images"] = [];
		if (file_exists($_SERVER["DOCUMENT_ROOT"] . $partimage))
		{
			$ResultArray["images"][] = $partimage;
		}
		
		if (file_exists($_SERVER["DOCUMENT_ROOT"] . $logoimage))
		{
			$ResultArray["images"][] = $logoimage;
		}
		else
		{
			$ResultArray["images"][] = $noimage;
		}
		
		$ResultArray["name"] = $ResultArray["brand"] . ' - ' . $ResultArray["article"];
		
		// $ResultArray["link"] = Functions::GetProductURL($brand, $article);
		$arGPart = NewTecdocController::GetPartByPKEY($ResultArray["bkey"], $ResultArray["akey"]);
		if (isset($arGPart["aid"]))
		{
			$ResultArray["aid"] = $arGPart["aid"];
			$ResultArray["td_name"] = $arGPart["td_name"];
			if ($ResultArray["td_name"])
			{
				$ResultArray["name"] = $arGPart["td_name"];
			}
		}
		$ResultArray["properties"] = [];
		if (isset($ResultArray["aid"]))
		{
			$Properties = NewTecdocController::GetProperties($ResultArray["aid"]);
			foreach ($Properties as $Prop)
			{
				$ResultArray["properties"][] = ["name"=>$Prop["name"],"VALUE"=>$Prop["VALUE"]];
			}
		}
		$rate = ProductRating::where('pkey',$ResultArray["bkey"] . $ResultArray["akey"])->avg('rating');
		if($rate)
		{
			$ResultArray["rating"] = $rate;
			$ResultArray["rating_left"] = 5 - $rate;
			$ResultArray["reviewscount"] = ProductRating::where('pkey',$ResultArray["bkey"] . $ResultArray["akey"])->count('client_id');
		}
		else
		{
			$ResultArray["rating"] = intval(0);
			$ResultArray["rating_left"] = intval(5);
			$ResultArray["reviewscount"] = intval(0);
		}
		return view('shop.modal.quickview', compact('ResultArray'));
	}
    static function pricesview(Request $request)
	{
		$ResultArray = [
            "brand" => $request->brand,
            "bkey" => Functions::SingleKey($request->brand,true),
            "article" => $request->article,
            "akey" => Functions::SingleKey($request->article),
            "pkey" => Functions::SingleKey($request->brand,true) . Functions::SingleKey($request->article),
            "prices" => [],
        ];

		$prices = ProviderPrice::where('pkey', $ResultArray["pkey"])->get();
		if($prices)
		{
			$prices = $prices->toArray();
			foreach($prices as $price)
			{
				$price = Functions::FormatPrice($price);
				$ResultArray["prices"][] = $price;
			}
		}

		return view('shop.modal.pricesview', compact('ResultArray'));
	}

    static function analogview(Request $request)
	{
		$ResultArray = [
            "aid" => $request->aid,
            "brand" => $request->brand,
            "bkey" => Functions::SingleKey($request->brand,true),
            "article" => $request->article,
            "akey" => Functions::SingleKey($request->article),
            "pkey" => Functions::SingleKey($request->brand,true) . Functions::SingleKey($request->article),
            "prices" => [],
            "analogs" => [],
        ];

        if(isset($ResultArray["aid"]))
		{
			$text = NewTecdocController::GetTextByID($ResultArray["aid"]);
			$dataSQL = NewTecdocController::LookupAnalog($ResultArray["aid"]);
			foreach ($dataSQL as $dataItem)
			{
				$ResultArray["analogs"][] = ["article"=>$dataItem["article"],
						"brand"=>$dataItem["brand"],
						"name"=>$dataItem["name"],
						"type"=>Functions::ArticleKind($dataItem["type"]),
						"link"=>Functions::GetSearchURL($dataItem["brand"], Functions::SingleKey($dataItem["article"]))];
			}
		}
		else
		{
			$tecdocPart = NewTecdocController::GetPartByPKEY($ResultArray["bkey"], $ResultArray["akey"]);
			if(isset($tecdocPart["td_name"]))
			{
				$ResultArray["name"] = $tecdocPart["td_name"];
			}
			if(isset($tecdocPart["aid"]))
			{
				$dataSQL = NewTecdocController::LookupAnalog($tecdocPart['aid']);
				
				foreach ($dataSQL as $dataItem)
				{
					$ResultArray["analogs"][] = ["article"=>$dataItem["article"],
							"brand"=>$dataItem["brand"],
							"name"=>$dataItem["name"],
							"type"=>Functions::ArticleKind($dataItem["type"]),
							"link"=>Functions::GetSearchURL($dataItem["brand"], Functions::SingleKey($dataItem["article"]))];
				}
			}
		}
		if(!isset($ResultArray["name"]))
		{
			$ResultArray["name"] = $ResultArray["brand"] . ' - ' . $ResultArray["article"];
		}
		return view('shop.modal.analogview', compact('ResultArray'));
		
	}
}
