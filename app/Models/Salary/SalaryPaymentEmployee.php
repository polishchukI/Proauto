<?php

namespace App\Models\Salary;

use Illuminate\Database\Eloquent\Model;

class SalaryPaymentEmployee extends Model
{
    protected $table = 'salary_payment_employees';
	
    protected $primaryKey = 'id';
	
    protected $guarded = ['id'];
    	
    public function curency()
    {
        return $this->belongsTo('App\Models\Inventory\Currency', 'currency_id','id');
    }

	public function employee()
    {
        return $this->belongsTo('App\Models\Employee');
    }
}
