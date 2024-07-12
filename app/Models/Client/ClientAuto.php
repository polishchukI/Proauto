<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientAuto extends Model
{
    use SoftDeletes;
	
	protected $table = 'client_autos';
	
    protected $primaryKey = 'id';//////////////////if one key - than no brackets
	
    protected $guarded = ['id'];
	
    public function client()
    {
        return $this->belongsTo('App\Models\Client\Client', 'client_id', 'id');
    }
    
    public function color()
    {
        return $this->hasOne('App\Models\Client\ClientAutoColor', 'auto_color_id', 'id');
    }
	
	public function serviceparts()
    {
        return $this->hasMany('App\Models\Client\ClientAutoServicePart', 'client_auto_id', 'id');
    }

    public function products()
    {
        return $this->hasMany('App\Models\Product\Product', 'product_id', 'id');
    }
}
