<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;

class CatalogArticleCross extends Model
{
	protected $connection = 'catalog';
	
	protected $table = 'article_cross';
}
