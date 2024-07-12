<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;

class CatalogAxleTree extends Model
{
	protected $connection = 'catalog';
	
	protected $table = 'axle_trees';

	public function children()
    {
        return $this->hasMany(CatalogCommercialVehicleTree::class, 'parentid');
    }
}
