<?php

namespace App\Models\OnlineOrder;

use Illuminate\Database\Eloquent\Model;

class OnlineOrder extends Model
{
    protected $table = 'online_orders';

    protected $primaryKey = 'id';

    protected $guarded = ['id'];
	
	public $timestamps = false;
	
    public function client()
	{
        return $this->belongsTo('App\Models\Client\Client');
    }

    public function products()
	{
        return $this->hasMany('App\Models\OnlineOrder\OnlineOrderProduct', 'online_order_id','id');
    }

	public function scopeLastWeek(Builder $query): Builder
    {
        return $query->whereBetween('created_at', [now()->subWeek(), now()])
                     ->latest();
    }
	
    public function scopeLastMonth(Builder $query): Builder
    {
        return $query->whereBetween('created_at', [now()->subMonth(), now()])
                     ->latest();
    }

    public function scopeLastYear(Builder $query): Builder
    {
        return $query->whereBetween('created_at', [now()->subYear(), now()])
                     ->latest();
    }
	//////////////////
    public function onlineorderhistory()
    {
        return $this->hasMany(OnlineOrderHistory::class, 'order_id');
    }

    public function lasthistory()
    {
        return $this->belongsTo(OnlineOrderHistory::class, 'order_status_id');
    }
	
	public function orderproduct()
	{
		return $this->hasMany('App\Models\OnlineOrder\OnlineOrderProduct', 'order_id');
	}
}
