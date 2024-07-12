<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;

class CatalogPassangerCarTree extends Model
{
	protected $connection = 'catalog';
	
	protected $table = 'passanger_car_trees';

	public function children()
    {
        return $this->hasMany(CatalogPassangerCarTree::class, 'parentid');
    }
}
