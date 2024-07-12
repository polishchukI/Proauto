<?php

namespace App\Http\Controllers\AuthClient;

use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
	use ResetsPasswords;
	
    protected $redirectTo = '/home';
	
    public function __construct()
    {
        $this->middleware('guest');
    }
}
