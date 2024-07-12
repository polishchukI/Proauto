<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Model;

class ClientAutoServicePart extends Model
{
	protected $table = 'client_auto_service_parts';
	
    protected $primaryKey = 'id';
	
    protected $guarded = ['id'];
	
	public function clientauto()
    {
        return $this->belongsTo('App\Models\Client\ClientAuto', 'vin', 'vin');
    }
    
	public function product()
    {
        return $this->belongsTo('App\Models\Product\Product', 'product_id', 'id');
    }

    public function stocks()//stocks by fifo table
    {
        return $this->hasMany('App\Models\Product\ProductStock', 'product_id', 'id');
    }

    public function prices()
    {
        return $this->hasMany('App\Models\Product\ProductPrice','product_id','id');
    }
     
    // public function last_out_price()
    // {
    //     return $this->prices()->where('price_type','=','out')->latest()->price;
    // }

    // public function last_in_price()
    // {
    //     return $this->prices()->where('price_type','=','in')->latest()->first();
    // }
}
