<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class ProductRepairOrder extends Model
{
    protected $table = 'product_repair_orders';
	
    protected $primaryKey = 'id';
	
    protected $guarded = ['id'];

    public function product()
    {
        return $this->belongsTo('App\Models\Product\Product');
    }
}
