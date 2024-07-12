<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Model;

class ShopMessages extends Model
{
	protected $table = 'shop_messages';
	
    protected $primaryKey = 'id';
	
    protected $guarded = ['id'];
}
