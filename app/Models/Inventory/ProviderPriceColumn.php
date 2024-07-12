<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class ProviderPriceColumn extends Model
{
	protected $table = 'provider_price_columns';
	
	public $timestamps = false;
	
	public $incrementing = false;
	
    protected $guarded = [];

    public function provider()
    {
        return $this->belongsTo('App\Models\Inventory\Provider', 'provider_id','id');		
    }
}
