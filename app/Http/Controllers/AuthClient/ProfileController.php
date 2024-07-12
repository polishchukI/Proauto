<?php

namespace App\Http\Controllers\AuthClient;

use App\Models\Client\Profile;

use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
	public function index(Request $request)
    {
		$client_id = (int)$request->user('clients')->id;
		$client = Profile::where('id', '=', $client_id)->first();
		if($client)
		{
			$client = $client->toArray();
		}
		
        return view('shop.account.profile', compact('client'));
    }
	
    public function update(Request $request)
    {
		request()->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users',
			// 'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
			]);
		
		$client_id = (int)$request->user('clients')->id;
        		
        $profile = Profile::findOrFail($client_id);

		$profile->firstname = $request["firstname"];
		$profile->lastname = $request["lastname"];
		$profile->secondname = $request["secondname"];
		$profile->name = $request["lastname"] ." ". $request["firstname"] ." ". $request["secondname"];

		$profile->email = $request["email"];
		$profile->phone = $request["phone"];

		if($request->file('avatar'))
		{
			$avatar = $request->file('avatar');
			$filename = 'avatar-' . $client_id . '.' . $avatar->getClientOriginalExtension();
			$request->file('avatar')->move(public_path('images/avatars/clients'), $filename);
			$profile->avatar = '/images/avatars/clients/' . $filename;
		}
		if($request["telegram_notifications"] == "on")
		{
			$profile->telegram_notifications = 1;
		}
		else
		{
			$profile->telegram_notifications = 0;
		}
		
		if($request["newsletter"] == "on")
		{
			$profile->newsletter = 1;
		}
		else
		{
			$profile->newsletter = 0;
		}
		$profile->save();
		
		return back()->with('flash_message', 'Profile updated!');
    }
}