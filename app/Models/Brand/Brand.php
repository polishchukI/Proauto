<?php

namespace App\Models\Brand;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
	protected $table = 'brands';
	
	protected $primaryKey = 'id';
	
    protected $guarded = ['id'];
}
