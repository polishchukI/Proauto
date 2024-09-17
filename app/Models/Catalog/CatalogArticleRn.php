<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;

class CatalogArticleRn extends Model
{
	protected $connection = 'catalog';
	
	protected $table = 'article_rn';
}
