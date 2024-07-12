<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class ProductMinimalStocks extends Model
{	
	protected $table = 'product_minimal_stocks';
	
    protected $primaryKey = 'id';
	
	public $timestamps = false;
	
    protected $guarded = ['id'];
	
    public function product()
    {
        return $this->belongsTo('App\Models\Product\Product', 'product_id', 'id');
    }

    public function warehouse()
    {
        return $this->belongsTo('App\Models\Inventory\Warehouse', 'warehouse_id', 'id');
    }
}
