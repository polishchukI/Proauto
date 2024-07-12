<?php

namespace App\Models\Special;

use Illuminate\Database\Eloquent\Model;

class Rim extends Model
{
    protected $table = 'special_rims';
	
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
        if (request('bolt_hole_circle'))
        {
            $q->where('bolt_hole_circle', '=', request('bolt_hole_circle'));
        }
        if (request('rim_hole_number'))
        {
            $q->where('rim_hole_number', '=', request('rim_hole_number'));
        }
        if (request('size'))
        {
            $q->where('size', '=', request('size'));
        }
        if (request('colour'))
        {
            $q->where('colour', '=', request('colour'));
        }
        if (request('offset'))
        {
            $q->where('offset', '=', request('offset'));
        }
        return $q;
    }
}
