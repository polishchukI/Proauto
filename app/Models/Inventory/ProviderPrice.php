<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class ProviderPrice extends Model
{
	protected $table = 'provider_prices';
	
	public $timestamps = false;
	
	public $incrementing = false;
	
    protected $guarded = [];
	
	// public function product()
    // {
    //     return $this->belongsTo('App\Models\Product\Product', 'pkey', 'pkey');
    // }
}
