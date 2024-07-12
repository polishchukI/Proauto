<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;

class CatalogEngine extends Model
{
	protected $connection = 'catalog';
	
	protected $table = 'engines';
}
