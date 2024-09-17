<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class ProductClientOrderCorrection extends Model
{
    protected $table = 'product_client_order_corrections';
	
    protected $primaryKey = 'id';
	
    protected $guarded = ['id'];

    public function client_order_correction()
    {
        return $this->belongsTo('App\Models\Inventory\ClientOrderCorrection');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product\Product');
    }
}
