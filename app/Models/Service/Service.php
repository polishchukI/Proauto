<?php

namespace App\Models\Service;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';
	
    protected $primaryKey = 'id';
	
    protected $guarded = ['id'];

}
