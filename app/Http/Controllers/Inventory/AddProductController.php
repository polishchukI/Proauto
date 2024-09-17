<?php

namespace App\Http\Controllers\Inventory;

use Illuminate\Http\Request;

use App\Models\Product\ProductPrice;
use App\Models\Product\ProductStock;

use App\Http\Controllers\Controller;

class AddProductController extends Controller
{
	//get_product_stocks
	public static function get_product_stocks($product_id, $warehouse_id = null)
	{
		$quantity = 0;

		$q = ProductStock::where('product_id','=', $product_id);
		if($warehouse_id != null)
		{
				$q = $q->where('warehouse_id','=', $warehouse_id);
		}
		$q = $q->sum('quantity');
		
		$quantity = $quantity + $q;
		
		return $quantity;
	}

	//get_product_price
	public static function get_product_price($product_id, $price_type, $document_currency, $date = null)
	{
		
		$price = 0;
		$q = ProductPrice::select('product_prices.price', 'product_prices.currency')
					->where('product_prices.product_id','=', $product_id)
					->where('price_type','=', $price_type)
					->orderby('date', 'desc');
					if($date != null)
					{
							$q = $q->where('date','<', $date);
					}
					$q = $q->first();
		if($q)
		{
			$q = $q->toArray();
			$price = currency($q['price'], $q['currency'], $document_currency, false);
		}
		// dd(compact('product_id', 'price_type', 'document_currency', 'price'));
		return $price;
	}
}
