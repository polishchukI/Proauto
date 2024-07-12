<?php

namespace App\Models\Webservice;

use Illuminate\Database\Eloquent\Model;

class ProviderWebserviceTime extends Model
{
    protected $table = 'provider_webservice_time';
	
	public $incrementing = false;

	public $timestamps = false;
	
    protected $guarded = [];
}
