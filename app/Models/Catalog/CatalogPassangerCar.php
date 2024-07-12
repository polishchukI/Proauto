<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;

class CatalogPassangerCar extends Model
{
	protected $connection = 'catalog';
	
	protected $table = 'passanger_cars';
}
