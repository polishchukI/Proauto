<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Model;

class ShopMessageSubject extends Model
{
	protected $table = 'shop_message_subjects';
	
    protected $primaryKey = 'id';
	
    protected $guarded = ['id'];
}
