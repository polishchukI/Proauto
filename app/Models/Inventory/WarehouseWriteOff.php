<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class WarehouseWriteOff extends Model
{

    protected $table = 'warehouse_write_offs';
	
    protected $primaryKey = 'id';
	
    protected $guarded = ['id'];
        
	public function products()
	{
        return $this->hasMany('App\Models\Product\ProductWarehouseWriteOff');
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

    public function stocks()//stocks by fifo table
    {
        return $this->hasMany('App\Models\Product\ProductStock');
    }
}
