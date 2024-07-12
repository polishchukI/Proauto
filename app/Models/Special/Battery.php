<?php

namespace App\Models\Special;

use Illuminate\Database\Eloquent\Model;

class Battery extends Model
{
    protected $table = 'special_batteries';
	
    protected $primaryKey = 'id';
	
    protected $guarded = ['id'];
}
