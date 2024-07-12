<?php

namespace App\Models\Webservice;

use Illuminate\Database\Eloquent\Model;

class ProviderWebserviceCounter extends Model
{
	protected $table = 'provider_webservice_counter';
	
	public $incrementing = false;

	public $timestamps = false;
	
    protected $primaryKey = ['wsid', 'stmp'];

    protected $guarded = [];
}
