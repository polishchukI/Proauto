<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class AdminCart extends Model
{
    protected $table = 'admin_carts';
	
    protected $primaryKey = 'id';
	
    protected $guarded = ['id'];
	
    public function warehouse()
	{
        return $this->belongsTo('App\Models\Inventory\Warehouse', 'warehouse_id','id');
    }

	public function products()
    {
        return $this->hasMany('App\Models\Product\ProductAdminCart','admincart_id');
    }
	
    public function client()
	{
        return $this->belongsTo('App\Models\Client\Client');
    }
	
    public function client_auto()
	{
        return $this->belongsTo('App\Models\Client\ClientAuto','client_auto_id','id');
    }
	
    public function user()
	{
        return $this->belongsTo('App\User');
    }
    
    public function stocks()//stocks by fifo table
    {
        return $this->hasMany('App\Models\Product\ProductStock');
    }

    // public function scopeUnfinalized($query)
    // {
    //     return $query->where('finalized_at','=', null);
    // }

    public function scopeActive(Builder $query): Builder
    {
        return $query->whereNull('finalized_at','=', null);
    }

}
