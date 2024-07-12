<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;

class CatalogMotorbike extends Model
{
	protected $connection = 'catalog';
	
	protected $table = 'motorbikes';
}
