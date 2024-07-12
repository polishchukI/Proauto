<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class ReturnFromTheClient extends Model
{
    protected $guarded = ['id'];

    protected $table = 'returns_from_the_client';
	
    public function client()
	{
        return $this->belongsTo('App\Models\Client\Client', 'client_id', 'id');
    }

    public function transactions()
	{
        return $this->hasMany('App\Models\Inventory\Transaction','return_from_the_client_id','id');
    }
    
	public function products()
	{
        return $this->hasMany('App\Models\Product\ProductReturnFromTheClient');
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
