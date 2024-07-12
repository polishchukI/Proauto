<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;

class CatalogSupplier extends Model
{
	protected $connection = 'catalog';
	
	protected $table = 'suppliers';
}
