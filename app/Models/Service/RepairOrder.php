<?php

namespace App\Models\Service;

use Illuminate\Database\Eloquent\Model;

class RepairOrder extends Model
{
    protected $table = 'repair_orders';
	
    protected $primaryKey = 'id';
	
    protected $guarded = ['id'];

    public function client()
	{
        return $this->belongsTo('App\Models\Client\Client', 'client_id', 'id');
    }
    
	public function transactions()
	{
        return $this->hasMany('App\Models\Inventory\Transaction','repair_order_id','id');
    }
    
	public function products()
	{
        return $this->hasMany('App\Models\Product\ProductRepairOrder');
    }
    
    public function services()
	{
        return $this->hasMany('App\Models\Service\ServiceRepairOrder');
    }    
 
	public function user()
	{
        return $this->belongsTo('App\User');
    }
    
    public function curency()
    {
        return $this->belongsTo('App\Models\Inventory\Currency', 'currency_id','id');
    }

    public function warehouse()
    {
        return $this->belongsTo('App\Models\Inventory\Warehouse', 'warehouse_id','id');
    }

    public function client_auto()
	{
        return $this->belongsTo('App\Models\Client\ClientAuto','client_auto_id','id');
    }
    
    public function stocks()//stocks by fifo table
    {
        return $this->hasMany('App\Models\Product\ProductStock');
    }
}
