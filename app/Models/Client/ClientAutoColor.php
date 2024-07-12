<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Model;

class ClientAutoColor extends Model
{
	protected $table = 'client_auto_colors';
	
    protected $primaryKey = 'id';
	
    protected $guarded = ['id'];
}
