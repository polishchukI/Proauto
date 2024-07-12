<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;

class CatalogEngineTree extends Model
{
	protected $connection = 'catalog';
	
	protected $table = 'engine_trees';

	public function children()
    {
        return $this->hasMany(CatalogEngineTree::class, 'parentid');
    }
}
