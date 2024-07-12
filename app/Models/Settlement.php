<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settlement extends Model
{
    protected $table = 'settlements';
	
    protected $primaryKey = 'id';
	
    protected $guarded = ['id'];
	
	public function client()
    {
        return $this->hasMany('App\Models\Client\Client');
    }
	
	public function provider()
    {
        return $this->hasMany('App\Models\inventory\Provider');
    }
}