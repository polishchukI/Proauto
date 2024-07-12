<?php

namespace App\Models\Brand;

use Illuminate\Database\Eloquent\Model;

class BrandRename extends Model
{
    protected $table = 'brand_renames';

	protected $primaryKey = 'id';
	
    protected $guarded = ['id'];
	
	public $timestamps = false;

    public function user()
	{
        return $this->belongsTo('App\User');
    }
}
