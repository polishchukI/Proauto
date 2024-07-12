<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class ProductCross extends Model
{
    protected $table = 'product_crosses';

	protected $primaryKey = [];

	public $incrementing = false;
	
	public $timestamps = false;

    protected $guarded = [];
    
    public function product()
    {
        return $this->belongsTo('App\Models\Product\Product','pkey','pkey');
    }
}
