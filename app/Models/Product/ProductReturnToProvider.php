<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class ProductReturnToProvider extends Model
{
    //product_return_to_providers
    protected $guarded = ['id'];

    protected $table = 'product_returns_to_provider';
    
    public function product()
    {
        return $this->belongsTo('App\Models\Product\Product');
    }
    
    public function sale()
    {
        return $this->belongsTo('App\Models\Inventory\ReturnToProvider');
    }
}
