<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'clients';
	
	protected $primaryKey = 'id';
	
	protected $protected = 'id';
}
