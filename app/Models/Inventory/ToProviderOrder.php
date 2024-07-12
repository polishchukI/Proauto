<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class ToProviderOrder extends Model
{
    protected $table = 'to_provider_orders';
	
    protected $primaryKey = 'id';
	
    protected $guarded = ['id'];

    public function provider()
    {
        return $this->belongsTo('App\Models\Inventory\Provider','provider_id','id');
    }
	
    public function curency()
    {
        return $this->belongsTo('App\Models\Inventory\Currency', 'currency_id','id');
    }

    public function warehouse()
    {
        return $this->belongsTo('App\Models\Inventory\Warehouse', 'warehouse_id','id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function products()
    {
        return $this->hasMany('App\Models\Product\ProductToProviderOrder', 'to_provider_order_id','id');
    }

    public function client_ordered_products()
    {
        return $this->hasMany('App\Models\Product\ProductClientToProviderOrder', 'to_provider_order_id','id');
    }

    public function stocks()//stocks by fifo table
    {
        return $this->hasMany('App\Models\Product\ProductStock');
    }
}
