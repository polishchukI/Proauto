<?php

namespace App\Models\Service;

use Illuminate\Database\Eloquent\Model;

class ServicesReceiptItem extends Model
{
    protected $table = 'services_receipt_items';
	
    protected $primaryKey = 'id';
	
    protected $guarded = ['id'];

    public function service()
    {
        return $this->BelongsTo('App\Models\Service\Service');
    }
}
