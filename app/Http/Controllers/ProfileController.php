<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;

use App\Models\Inventory\Currency;
use App\Models\Inventory\Warehouse;

use Illuminate\Http\Request;

use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;

class ProfileController extends Controller
{
    public function edit()
    {
        $warehouses = Warehouse::all();
        $currencies = Currency::where('active','=','1')->get();
		
		return view('inventory.profile.edit', compact('warehouses','currencies'));
    }

    public function update(ProfileRequest $request)
    {
        auth()->user()->update($request->all());

        return back()->withStatus('Profile successfully updated.');
    }

    public function password(PasswordRequest $request)
    {
        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->withPasswordStatus('Password successfully updated.');
    }
    
    public function changeTheme(Request $request)
    {
        auth()->user()->update(['white_color' => $request->get('white_color')]);
	}
}
