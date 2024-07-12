<?php

namespace App\Models\Service;

use Illuminate\Database\Eloquent\Model;

class ServicesReceipt extends Model
{
    protected $table = 'services_receipts';
	
    protected $primaryKey = 'id';
	
    protected $guarded = ['id'];

    public function provider()
    {
        return $this->belongsTo('App\Models\Inventory\Provider', 'provider_id','id');		
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
    
    public function transactions()
	{
        return $this->hasMany('App\Models\Inventory\Transaction','services_receipt_id','id');
    }

    public function services()
    {
        return $this->hasMany('App\Models\Service\ServicesReceiptItem');
    }
}
