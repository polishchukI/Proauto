<?php

namespace App\Models\OrderControl;

use Illuminate\Database\Eloquent\Model;

class ProductToProviderOrderControl extends Model
{
    protected $table = 'product_to_provider_order_control';
	
    protected $primaryKey = 'id';
	
    protected $guarded = ['id'];
	
    public function product()
    {
        return $this->belongsTo('App\Models\Product\Product','product_id','id');
    }

    public function to_provider_order()
    {
        return $this->belongsTo('App\Models\Inventory\ToProviderOrder', 'to_provider_order_id','id');
    }

    public function provider()
    {
        return $this->belongsTo('App\Models\Inventory\Provider', 'provider_id','id');
    }
}
