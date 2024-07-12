<?php

namespace App\Models\Special;

use Illuminate\Database\Eloquent\Model;

class Tyre extends Model
{
    protected $table = 'special_tyres';
	
    protected $primaryKey = 'id';
	
    protected $guarded = ['id'];

    public function scopeFilter($q)
    {
        if (request('brand'))
        {
            $q->where('brand', '=', request('brand'));
        }
        if (request('width'))
        {
            $q->where('width', '=', request('width'));
        }
        if (request('size'))
        {
            $q->where('size', '=', request('size'));
        }
        if (request('height'))
        {
            $q->where('height', '=', request('height'));
        }
        if (request('season'))
        {
            $q->where('season', '=', request('season'));
        }
        return $q;
    }

    
}
