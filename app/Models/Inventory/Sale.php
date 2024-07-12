<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = 'sales';
	
    protected $primaryKey = 'id';
	
    protected $guarded = ['id'];
	
    public function client()
	{
        return $this->belongsTo('App\Models\Client\Client', 'client_id', 'id');
    }
    
	public function transactions()
	{
        return $this->hasMany('App\Models\Inventory\Transaction','sale_id','id');
    }
    
	public function products()
	{
        return $this->hasMany('App\Models\Product\SoldProduct');
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
