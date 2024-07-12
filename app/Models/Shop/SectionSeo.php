<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Model;

class SectionSeo extends Model
{	
    protected $table = 'sectionseo';
	
	public $incrementing = false;
	
	public $timestamps = false;
	
	protected $primaryKey = 'id';
	
	protected $guarded = [];
}