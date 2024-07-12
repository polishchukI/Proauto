<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Provider extends Model
{
    use SoftDeletes;
	
	protected $table = 'providers';

    protected $guarded = ['id'];

    public function transactions()
    {
        return $this->hasMany('App\Models\Inventory\Transaction');
    }

    //product receipts
    public function receipts()
    {
        return $this->hasMany('App\Models\Inventory\Receipt', 'provider_id','id');		
    }

    public function service_receipts()
    {
        return $this->hasMany('App\Models\Service\ServicesReceipt', 'provider_id','id');
    }

    public function returns_to_provider()
    {
        return $this->hasMany('App\Models\Inventory\ReturnToProvider', 'provider_id','id');		
    }
    public function to_provider_orders()
    {
        return $this->hasMany('App\Models\Inventory\ToProviderOrder', 'provider_id','id');		
    }
	
    public function columns()
    {
        return $this->hasMany('App\Models\Inventory\ProviderPriceColumn', 'provider_id','id');		
    }
	
	public function settlements()
	{
		return $this->hasMany('App\Models\Settlement');
	}
	
	public function supplierprices()
	{
		return $this->hasMany('App\Models\Inventory\ProviderPrice', 'provider_code','provider_code');
	}
	
}
