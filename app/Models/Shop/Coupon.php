<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
	protected $table = 'coupons';
	
    protected $primaryKey = 'id';
	
    protected $fillable = ['code', 'type', 'value'];
	
	
    public static function findByCode($code)
    {
        return self::where('code', $code)->first();
    }

    public function discount($total)
    {
        if ($this->type == 'fixed')
		{
            return $this->value;
        }
		elseif ($this->type == 'percent')
		{
            return round(($this->value / 100) * $total);
        }
		else
		{
            return 0;
        }
    }
}
