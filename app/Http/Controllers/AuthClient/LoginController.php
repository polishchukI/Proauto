<?php

namespace App\Http\Controllers\AuthClient;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\TelegramBotController;

class LoginController extends Controller
{
	use AuthenticatesUsers;
	
    protected $redirectTo = 'account/dashboard';
	
    protected function guard()
    {
        return Auth::guard('clients');
    }
	
    public function __construct()
    {
        $this->middleware('guest.client')->except('logout');
    }
	
	///////////////////////user session params for discount/prices/etc
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);
		$this->updateSession($request);

        return $this->authenticated($request, $this->guard()->user('clients')) ?: redirect()->intended($this->redirectPath());
    }
	
	protected function updateSession(Request $request)
	{
		$client_id					= (int)$request->user('clients')->id;
		$client_product_discount	= (int)$request->user('clients')->product_discount;
		//teleg
		// if(isset($request->user('clients')->chat_id) && isset($request->user('clients')->telegram_notifications) && $request->user('clients')->telegram_notifications == 1)
		// {
			// $chat_id				= $request->user('clients')->chat_id;
			// $text					= 'Hello ' . $request->user('clients')->firstname . ' ! You have logged in to your account.';
			// $TelegramBotController	= new TelegramBotController;
			// $TelegramBotController->sendMessage($chat_id, $text);
		// }
		//teleg
		$request->session()->put('client_id', $client_id);
		$request->session()->put('client_product_discount', $client_product_discount);
	}
}
