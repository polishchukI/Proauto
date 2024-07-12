<?php

namespace App\Models\Special;

use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    protected $table = 'special_tools';
	
    protected $primaryKey = 'id';
	
    protected $guarded = ['id'];
}
