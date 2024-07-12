<?php

namespace App\Models\OnlineOrder;

use Illuminate\Database\Eloquent\Model;

class OnlineOrderProduct extends Model
{
    protected $table = 'online_order_products';

    protected $primaryKey = 'id';

    protected $guarded = ['id'];
	
	public $timestamps = false;

   public function orders()
   {
     return $this->belongsTo('App\Models\OnlineOrder\OnlineOrder', 'order_id','id');
   }
   
   public function product()
   {
     return $this->belongsTo('App\Models\Product\Product', 'pkey', 'pkey');
   }
}
