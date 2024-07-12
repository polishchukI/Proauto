<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
	protected $table = 'currencies';
	
    protected $primaryKey = 'id';
	
    protected $guarded = ['id'];
}
