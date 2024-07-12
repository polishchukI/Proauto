<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;

class CatalogArticleLink extends Model
{
	protected $connection = 'catalog';
	
	protected $table = 'article_links';
}
