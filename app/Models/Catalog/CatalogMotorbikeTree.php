<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;

class CatalogMotorbikeTree extends Model
{
	protected $connection = 'catalog';
	
	protected $table = 'motorbike_trees';

	public function children()
    {
        return $this->hasMany(CatalogMotorbikeTree::class, 'parentid');
    }
}
