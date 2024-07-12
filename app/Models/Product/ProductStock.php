<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class ProductStock extends Model
{
    protected $table = 'product_stocks';
	
    protected $primaryKey = 'id';
	
    protected $guarded = ['id'];
}
