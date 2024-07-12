<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;

class CatalogArticleImage extends Model
{
	protected $connection = 'catalog';
	
	protected $table = 'article_images';
}
