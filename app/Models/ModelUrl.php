<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelUrl extends Model
{
	protected $table = 'model_urls';
	
	protected $guarded = [];
	
	public $incrementing = false;
	
	public $timestamps = false;
}
