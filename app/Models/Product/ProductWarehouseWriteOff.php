<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class ProductWarehouseWriteOff extends Model
{
    protected $table = 'product_warehouse_write_offs';
	
    protected $primaryKey = 'id';
	
    protected $guarded = ['id'];

    public function warehouse_write_off()
    {
        return $this->belongsTo('App\Models\Inventory\WarehouseWriteOff');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product\Product');
    }
}
