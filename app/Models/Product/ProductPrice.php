<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class ProductPrice extends Model
{
	protected $table = 'product_prices';
	
	public $timestamps = false;
	
    protected $guarded = ['id'];
	
	// public function pricesetting()
    // {
        // return $this->belongsTo('App\Models\Inventory\PriceSetting');
    // } 
	
    public function products()
    {
        return $this->belongsTo('App\Models\Product\Product','product_id','id');
    }
}
