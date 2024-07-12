<?php

namespace App\Models\OrderControl;

use Illuminate\Database\Eloquent\Model;

class ProductClientOrderControl extends Model
{
    protected $table = 'product_client_order_control';
	
    protected $primaryKey = 'id';
	
    protected $guarded = ['id'];
	
    public function product()
    {
        return $this->belongsTo('App\Models\Product\Product','product_id','id');
    }
	
    public function client_order()
    {
        return $this->belongsTo('App\Models\Inventory\ClientOrder', 'client_order_id','id');
    }

    public function client()
    {
        return $this->belongsTo('App\Models\Client\Client', 'client_id','id');
    }
}
