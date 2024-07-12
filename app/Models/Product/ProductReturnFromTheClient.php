<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class ProductReturnFromTheClient extends Model
{
    protected $guarded = ['id'];

    protected $table = 'product_returns_from_the_client';
    
    public function product()
    {
        return $this->belongsTo('App\Models\Product\Product');
    }
    
    public function sale()
    {
        return $this->belongsTo('App\Models\Inventory\ReturnFromTheClient');
    }
}
