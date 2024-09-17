<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class ProductGroup extends Model
{
	protected $table = 'product_groups';
	
    protected $primaryKey = 'id';
    
	public $timestamps = false;

    protected $guarded = ['id'];

    public function children()
    {
        return $this->hasMany(ProductGroup::class, 'parent_id');
    }
    
    public function products()
	{
        return $this->hasMany('App\Models\Product\Product','product_group_id','id');
    }
}
