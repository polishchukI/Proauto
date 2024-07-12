<?php

namespace App\Http\Controllers\Shop;

use App\Models\Shop\Coupon;

use App\Jobs\UpdateCoupon;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class CouponsController extends Controller
{
    public function addcoupon(Request $request)
    {
		$coupon = Coupon::where('code', $request->coupon_code)->first();
		
		if (!$coupon)
		{
            return back()->withErrors('Invalid coupon code. Please try again.');
        }

        dispatch_now(new UpdateCoupon($coupon));

        return back()->with('success_message', 'Coupon has been applied!');
    }
	
    public function deletecoupon()
    {
        session()->forget('coupon');

        return back()->with('success_message', 'Coupon has been removed.');
    }
}
