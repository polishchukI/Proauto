<?php

namespace App\Models\OnlineOrder;

use Illuminate\Database\Eloquent\Model;

class OnlineOrderHistory extends Model
{
	protected $table = 'online_order_histories';
	
    protected $primaryKey = 'id';
	
    protected $fillable = ['order_id', 'client_id', 'status_id'];

    public function order() 
    {
        return $this->belongsTo(OnlineOrder::class, 'order_id');
    }

    public function client()
    {
        return $this->belongsTo('App\Models\Client\Client', 'client_id');
    }

    public function orderstatus() 
    {
        return $this->belongsTo('App\Models\Inventory\OrderStatus', 'status_id');
    }
}
