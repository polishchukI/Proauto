<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Model;

class ClientMessages extends Model
{
	protected $table = 'client_messages';
	
    protected $primaryKey = 'id';
	
    protected $guarded = ['id'];
	
	public function client()
    {
        return $this->belongsTo('App\Models\Client\Client');
    }
}
