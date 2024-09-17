<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Transaction extends Model
{
    protected $guarded = ['id'];

    public function method()
    {
        return $this->belongsTo('App\Models\Inventory\PaymentMethod', 'payment_method_id');
    }

    public function provider()
    {
        return $this->belongsTo('App\Models\Inventory\Provider');
    }

    public function sale()
    {
        return $this->belongsTo('App\Models\Inventory\Sale');
    }
    
    public function client_order_correction()
    {
        return $this->belongsTo('App\Models\Inventory\ClientOrderCorrection');
    }

    public function client()
    {
        return $this->belongsTo('App\Models\Client\Client');
    }

    public function transfer()
    {
        return $this->belongsTo('App\Models\Inventory\Transfer');
    }

    public function scopeFindByPaymentMethodId($query, $id)
    {
        return $query->where('payment_method_id', $id);
    }

    public function scopeThisMonth($query)
    {
        return $query->whereMonth('created_at', Carbon::now()->month);
    }
}
