<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class ProductToProviderOrder extends Model
{
    protected $table = 'product_to_provider_orders';
	
    protected $primaryKey = 'id';
	
    protected $guarded = ['id'];
	
    public function product()
    {
        return $this->belongsTo('App\Models\Product\Product');
    }
	
    public function order_to_suppliers()
    {
        return $this->belongsTo('App\Models\Inventory\DocumentOrderToSupplier');
    }
}
