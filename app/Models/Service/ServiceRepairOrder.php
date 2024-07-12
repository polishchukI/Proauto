<?php

namespace App\Models\Service;

use Illuminate\Database\Eloquent\Model;

class ServiceRepairOrder extends Model
{
    protected $table = 'service_repair_orders';
	
    protected $primaryKey = 'id';
	
    protected $guarded = ['id'];

    public function service()
    {
        return $this->BelongsTo('App\Models\Service\Service');
    }

    public function employee()
	{
        return $this->belongsTo('App\Models\Employee', 'employee_id','id');
    }
}
