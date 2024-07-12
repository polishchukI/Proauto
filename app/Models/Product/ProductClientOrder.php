<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class ProductClientOrder extends Model
{
    protected $table = 'product_client_orders';
	
    protected $primaryKey = 'id';
	
    protected $guarded = ['id'];
	
    public function product()
    {
        return $this->belongsTo('App\Models\Product\Product','product_id','id');
    }

    public function stock()
    {
        return $this->belongsTo('App\Models\Product\ProductStock','product_id','product_id');
    }
	
    public function client_orders()
    {
        return $this->belongsTo('App\Models\Inventory\ClientOrder', 'client_order_id','id');
    }
}
