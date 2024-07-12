<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class InventorySetting extends Model
{
    protected $table = 'inventory_settings';
    
    protected $primaryKey = 'id';
    
    protected $guarded = ['id'];

    public $timestamps = false;
    
}
