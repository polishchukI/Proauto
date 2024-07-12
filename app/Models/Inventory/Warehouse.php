<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Warehouse extends Model
{
    use SoftDeletes;
	
    protected $table = 'warehouses';
	
    protected $primaryKey = 'id';
	
    protected $guarded = ['id'];
    
	public function sales()
    {
        return $this->hasMany('App\Models\Inventory\Sale');
    }
	
	public function reciepts()
    {
        return $this->hasMany('App\Models\Inventory\Reciept');
    }
}
