<?php

namespace App\Models\Salary;

use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    protected $table = 'payrolls';
	
    protected $primaryKey = 'id';
	
    protected $guarded = ['id'];
    	
    public function curency()
    {
        return $this->belongsTo('App\Models\Inventory\Currency', 'currency_id','id');
    }

	public function user()
    {
        return $this->belongsTo('App\User');
    }

	public function employees()
    {
        return $this->hasMany('App\Models\Salary\PayrollEmployee');
    }
}
