<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    protected $table = 'order_statuses';
	
    protected $primaryKey = 'id';
	
    protected $guarded = ['id'];
}
