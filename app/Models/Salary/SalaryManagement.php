<?php

namespace App\Models\Salary;

use Illuminate\Database\Eloquent\Model;

class SalaryManagement extends Model
{
    protected $table = 'salary_management';
	
    protected $primaryKey = 'id';
	
    protected $guarded = ['id'];
}
