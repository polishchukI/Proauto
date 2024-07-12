<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class ProductAdminCart extends Model
{
    protected $table = 'product_admin_carts';
	
    protected $primaryKey = 'id';
	
    protected $guarded = ['id'];

    public function cart()
    {
        return $this->belongsTo('App\Models\Inventory\AdminCart');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product\Product');
    }}
