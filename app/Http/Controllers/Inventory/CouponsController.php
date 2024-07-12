<?php

namespace App\Http\Controllers\Inventory;

use App\Models\Shop\Coupon;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;


class CouponsController extends Controller
{
    public function index()
    {
        $coupons = Coupon::paginate(25);

        return view('inventory.coupons.index', compact('coupons'));
    }
    
    public function create()
    {
        return view('inventory.coupons.create');
    }
    
    public function store(Request $request, Coupon $coupon)
    {
        $coupon = $coupon->create($request->all());
        
        return redirect()->route('coupons.index')->withStatus('Successfully Registered Coupon.');
	}
    
    public function edit(Coupon $coupon)
    {
        return view('inventory.coupons.edit', compact('coupon'));
    }
    
    public function update(Request $request, Coupon $coupon)
    {
        $coupon->update($request->all());
        
        return redirect()->route('coupons.index')->withStatus('Successfully Updated Coupon.');
    }
    
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();

        return redirect()->route('coupons.index')->withStatus('Coupon removed successfully.');
    }
}
