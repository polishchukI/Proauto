<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class ClientOrder extends Model
{
    protected $table = 'client_orders';
	
    protected $primaryKey = 'id';
	
    protected $guarded = ['id'];
    
	public function client()
	{
        return $this->belongsTo('App\Models\Client\Client');
    }
	
    public function transactions()
	{
        return $this->hasMany('App\Models\Inventory\Transaction');
    }
	
    public function products()
	{
        return $this->hasMany('App\Models\Product\ProductClientOrder', 'client_order_id','id');
    }
	
    public function user()
	{
        return $this->belongsTo('App\User');
    }
	
	public function statuses()
	{
        return $this->hasMany('App\Models\Inventory\ClientOrderStatus', 'client_order_id','id');
    }

    public function warehouse()
    {
        return $this->belongsTo('App\Models\Inventory\Warehouse', 'warehouse_id','id');
    }
    
    public function stocks()//stocks by fifo table
    {
        return $this->hasMany('App\Models\Product\ProductStock');
    }
}
