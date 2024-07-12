<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;

class CatalogArticleLi extends Model
{
	protected $connection = 'catalog';
	
	protected $table = 'article_li';
}
