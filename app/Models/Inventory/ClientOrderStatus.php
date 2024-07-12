<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class ClientOrderStatus extends Model
{
    public function client_order() 
    {
        return $this->belongsTo('App\Models\Inventory\ClientOrder', 'order_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

}
