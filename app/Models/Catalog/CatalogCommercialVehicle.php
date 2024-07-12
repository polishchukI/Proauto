<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;

class CatalogCommercialVehicle extends Model
{
	protected $connection = 'catalog';
	
	protected $table = 'commercial_vehicles';
}
