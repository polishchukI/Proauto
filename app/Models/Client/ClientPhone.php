<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Model;

class ClientPhone extends Model
{
	protected $table = 'client_phones';
	
    protected $primaryKey = 'id';
	
	public $timestamps = false;
	
    protected $guarded = ['id'];
	
    public function client()
    {
        return $this->belongsTo(App\Models\Client\Client::class, 'client_id', 'id');
    }
}
