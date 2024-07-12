<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;

class CatalogManufacturer extends Model
{
	protected $connection = 'catalog';
	
	protected $table = 'manufacturers';
}
