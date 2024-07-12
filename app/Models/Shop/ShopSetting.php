<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Model;

class ShopSetting extends Model
{
    protected $table = 'shop_settings';
    
    public $timestamps = false;

    protected $fillable = [
        'name',
        'value',
        'comment',
    ];
}
