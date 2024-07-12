<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class ProductClientToProviderOrder extends Model
{
    protected $table = 'product_client_to_provider_orders';
	
    protected $primaryKey = 'id';
	
    protected $guarded = ['id'];
	
    public function product()
    {
        return $this->belongsTo('App\Models\Product\Product','product_id','id');
    }
}
