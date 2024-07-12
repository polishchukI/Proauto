<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class TransactionType extends Model
{
    protected $fillable = ['type', 'description'];
	
    public function transactions()
	{
        return $this->hasMany('App\Models\Inventory\Transaction');
    }
}
