<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;

class CatalogGroup extends Model
{
	protected $table = 'catalog_groups';
	
    protected $primaryKey = 'id';
	
    protected $guarded = ['id'];
	
	public $timestamps = false;
}
