<?php

namespace App\Http\Controllers\AuthClient;

use App\Models\Client\Client;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ChangePasswordController extends Controller
{
    public function index(Request $request)
    {
		$client_id = (int)$request->user('clients')->id;
		$client = Client::where('id',$client_id)->first();
		$email = $client->email;
        return view('shop.account.password', compact('email'));
    }
}