<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    protected $guarded = ['id'];

    protected $table = 'receipts';

    public function provider()
    {
        return $this->belongsTo('App\Models\Inventory\Provider', 'provider_id','id');		
    }

    public function transactions()
	{
        return $this->hasMany('App\Models\Inventory\Transaction','receipt_id','id');
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
        return $this->hasMany('App\Models\Product\ReceivedProduct');
    }
    
    public function stocks()//stocks by fifo table
    {
        return $this->hasMany('App\Models\Product\ProductStock');
    }
}
