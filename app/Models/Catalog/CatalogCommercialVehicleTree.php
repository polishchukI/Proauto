<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;

class CatalogCommercialVehicleTree extends Model
{
	protected $connection = 'catalog';
	
	protected $table = 'commercial_vehicle_trees';

	public function children()
    {
        return $this->hasMany(CatalogCommercialVehicleTree::class, 'parentid');
    }
}
