<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;

class CatalogArticleOe extends Model
{
	protected $connection = 'catalog';
	
	protected $table = 'article_oe';
}
