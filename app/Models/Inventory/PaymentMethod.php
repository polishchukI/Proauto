<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentMethod extends Model
{
    use SoftDeletes;
	
    protected $fillable = ['name', 'description'];
	
    public function transactions()
	{
        return $this->hasMany('App\Models\Inventory\Transaction', 'payment_method_id', 'id');
    }
}
