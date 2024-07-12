<?php

namespace App\Models\Brand;

use Illuminate\Database\Eloquent\Model;

class BrandRating extends Model
{
    protected $table = 'brands_ratings';
	
	protected $guarded = 'id';
	
	protected $primaryKey = 'id';
	
	public $timestamps = true;
}