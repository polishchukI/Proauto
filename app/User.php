<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;
    
    protected $guarded = ['id'];
    
    protected $hidden = [
        'password',
		'remember_token',
    ];
    
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

	public function warehouse()
    {
        return $this->belongsTo('App\Models\Inventory\Warehouse', 'default_warehouse_id','id');
    }
	
    public function curency()
    {
        return $this->belongsTo('App\Models\Inventory\Currency', 'default_currency','code');
    }
}