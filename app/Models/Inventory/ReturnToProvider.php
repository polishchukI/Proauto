<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class ReturnToProvider extends Model
{

    protected $guarded = ['id'];

    protected $table = 'returns_to_provider';
	
    public function provider()
	{
        return $this->belongsTo('App\Models\Inventory\Provider', 'provider_id', 'id');
    }

    public function transactions()
	{
        return $this->hasMany('App\Models\Inventory\Transaction','return_to_provider_id','id');
    }
    
	public function products()
	{
        return $this->hasMany('App\Models\Product\ProductReturnToProvider');
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
