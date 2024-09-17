<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class ReceivedProduct extends Model
{
    protected $table = 'received_products';
	
    protected $primaryKey = 'id';
	
    protected $guarded = ['id'];

    public function receipt()
    {
        return $this->belongsTo('App\Models\Inventory\Receipt');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product\Product');
    }
}
