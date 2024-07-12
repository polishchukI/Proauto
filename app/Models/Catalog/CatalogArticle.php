<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;

class CatalogArticle extends Model
{
	protected $connection = 'catalog';
	
	protected $table = 'articles';
}
