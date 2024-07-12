<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class SoldProduct extends Model
{
    protected $guarded = ['id'];
    
    public function product()
    {
        return $this->belongsTo('App\Models\Product\Product');
    }
    
    public function sale()
    {
        return $this->belongsTo('App\Models\Inventory\Sale');
    }
}
