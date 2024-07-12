<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;

class CatalogArticleAttribute extends Model
{
	protected $connection = 'catalog';
	
	protected $table = 'article_attributes';
}
