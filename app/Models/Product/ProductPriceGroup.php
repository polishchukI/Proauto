<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class ProductPriceGroup extends Model
{
	protected $table = 'product_price_groups';
	
	public $timestamps = false;
	
    protected $guarded = ['id'];

    public function products()
	{
        return $this->hasMany('App\Models\Product\Product','id','product_price_group_id');
    }
}
