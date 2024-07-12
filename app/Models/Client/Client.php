<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{
	
	protected $table = 'clients';
	
	protected $primaryKey = 'id';
	
	public $timestamps = false;
	
    protected $guarded = ['id'];

    public function client_orders()
    {
        return $this->hasMany('App\Models\Inventory\ClientOrder', 'client_id', 'id');
    }
    
    public function online_client_orders()
    {
        return $this->hasMany('App\Models\OnlineOrder\OnlineOrder', 'client_id', 'id');
    }
    
    public function client_carts()
    {
        return $this->hasMany('App\Models\Inventory\Admincart', 'client_id', 'id');
    }
    
    public function sales()
    {
        return $this->hasMany('App\Models\Inventory\Sale', 'client_id', 'id');
    }
	
    public function phones()
    {
        return $this->hasMany('App\Models\Client\ClientPhone', 'client_id', 'id');
    }
	
    public function addresses()
    {
        return $this->hasMany('App\Models\Client\ClientAddress', 'client_id', 'id');
    }
	
	public function automobiles()
    {
        return $this->hasMany('App\Models\Client\ClientAuto', 'client_id', 'id');
    }
	
    public function transactions()
    {
        return $this->hasMany('App\Models\Inventory\Transaction');
    }
	
    public function returns_from_the_client()
    {
        return $this->hasMany('App\Models\Inventory\ReturnFromTheClient');
    }
    
    public function settlements()
	{
		return $this->hasMany('App\Models\Settlement');
	}
}
