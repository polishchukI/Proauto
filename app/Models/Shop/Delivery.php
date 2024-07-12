<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
	protected $table = 'delivery';
	
	protected $primaryKey = 'id';

    protected $fillable = ['name', 'description', 'sortorder', 'price', 'free_level'];
}
