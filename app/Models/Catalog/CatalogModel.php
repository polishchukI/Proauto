<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;

class CatalogModel extends Model
{
	protected $connection = 'catalog';
	
	protected $table = 'models';
		
	public $timestamps = false;
}