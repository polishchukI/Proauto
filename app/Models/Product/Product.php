<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
	
    protected $table = 'products';	

    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo('App\Models\Product\ProductCategory', 'product_category_id','id');
    }

    public function group()
    {
        return $this->belongsTo('App\Models\Product\ProductGroup', 'product_group_id','id');
    }
    
    public function crosses()
    {
        return $this->hasMany('App\Models\Product\ProductCross','pkey','pkey');
    }
    
    public function solds()
    {
        return $this->hasMany('App\Models\Product\SoldProduct','product_id','id');
    }

    public function admincarts()
	{
		return $this->belongsToMany('App\Models\Inventory\AdminCart', 'admincart_id','id');
	}

    public function stocks()//stocks my
    {
        return $this->hasMany('App\Models\Product\ProductStock');
    }

    public function receiveds()
    {
        return $this->hasMany('App\Models\Product\ReceivedProduct');
    }
	
	public function provider_prices()
    {
        return $this->hasMany('App\Models\Inventory\ProviderPrice', 'pkey', 'pkey');
    }

    public function prices()
    {
        return $this->hasMany('App\Models\Product\ProductPrice','product_id','id');
    }
     
    public function last_out_price()
    {
        return $this->prices()->where('price_type','=','out')->latest()->first('price');
    }

    public function last_in_price()
    {
        return $this->prices()->where('price_type','=','in')->latest()->first('price');
    }

    public function minimal_stocks()
    {
        return $this->hasMany('App\Models\Product\ProductMinimalStocks', 'product_id', 'id');
    }

    public function product_price_group()
    {
        return $this->belongsTo('App\Models\Product\ProductPriceGroup', 'product_price_group_id','id');
    }

    //special cats
    public function tyre()
    {
        return $this->hasOne('App\Models\Special\Tyre', 'pkey', 'pkey');
    }
    
    public function battery()
    {
        return $this->hasOne('App\Models\Special\Battery', 'pkey', 'pkey');
    }

}