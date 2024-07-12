<?php

namespace App\Models\Special;

use Illuminate\Database\Eloquent\Model;

class Oil extends Model
{
    protected $table = 'special_oils';
	
    protected $primaryKey = 'id';
	
    protected $guarded = ['id'];

    public function scopeFilter($q)
    {
        if (request('oil_brand'))
        {
            $q->where('brand', '=', request('oil_brand'));
        }
        if (request('oil_type'))
        {
            $q->where('type', '=', request('oil_type'));
        }
        if (request('oil_viscosity'))
        {
            $q->where('sae', '=', request('oil_viscosity'));
        }
        if (request('oil_acea'))
        {
            $q->where('acea', '=', request('oil_acea'));
        }
        if (request('oil_api'))
        {
            $q->where('api', '=', request('oil_api'));
        }
        if (request('oil_oem'))
        {
            $q->where('oem', '=', request('oil_oem'));
        }
        if (request('oil_basis'))
        {
            $q->where('basis', '=', request('oil_basis'));
        }
        return $q;
    }
}
