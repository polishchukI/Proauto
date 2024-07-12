<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Model;

class ClientAddress extends Model
{	
	protected $table = 'client_addresses';
	
    protected $primaryKey = 'id';
	
    protected $guarded = ['id'];
	
    public function client()
    {
        return $this->belongsTo('App\Models\Client\Client', 'client_id', 'id');
    }
}
