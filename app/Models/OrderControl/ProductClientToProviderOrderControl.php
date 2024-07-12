<?php

namespace App\Models\OrderControl;

use Illuminate\Database\Eloquent\Model;

class ProductClientToProviderOrderControl extends Model
{
    protected $table = 'product_client_to_provider_order_control';
	
    protected $primaryKey = 'id';
	
    protected $guarded = ['id'];
	
    public function product()
    {
        return $this->belongsTo('App\Models\Product\Product','product_id','id');
    }
}
