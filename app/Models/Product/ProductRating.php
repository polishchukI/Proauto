<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class ProductRating extends Model
{
	protected $table = 'product_ratings';
	
	protected $primaryKey = 'id';
	
	public $timestamps = true;
	
	protected $guarded = ['id'];
}