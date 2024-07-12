<?php

namespace App\Http\Controllers\Shop;

use Carbon\Carbon;

use App\Rules\Recaptcha;

use Illuminate\Http\Request;

use App\Models\Shop\ShopMessages;

use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\Controller;

class MessagesController extends Controller
{
	public function ContactPageSendMessage(Request $request)
	{
		// Validator::make($request->all(), [
		// 		'recaptcha_response' => [
		// 		'required',
		// 		new Recaptcha,
		// 		],
		// ]);
		
		$validatedData = $request->validate([
			'name' => 'required|max:255',
			'email' => 'required|email',
			'message' => 'required',
		]);
		
		if($validatedData)
		{
			$requestedData = $request->all();
			ShopMessages::create($requestedData);
	
			return redirect()->back()->withStatus('Ваше заявка зарегистрирована, мы скоро с вами свяжемся.');
		}
		else
		{
			return redirect()->back()->with('error','Ваше заявка не зарегистрирована не все поля заполнены.');
		}

    }
	
	public function NopartsSendMessage(Request $request)
	{
		// Validator::make($request->all(), [
		// 		'recaptcha_response' => [
		// 		'required',
		// 		new Recaptcha,
		// 		],
		// ]);

		$validatedData = $request->validate([
			'name' => 'required|max:255',
			'email' => 'required|email',
			'message' => 'required',
		]);

		if($validatedData)
		{
			$requestedData = $request->all();
			$requestedData['subject_id'] = (int)8;//Noparts subject
			
			ShopMessages::create($requestedData);
		}
		else
		{
			
		}


    }
	
	static function AskpriceSendMessage(Request $request)
	{
		// Validator::make($request->all(), [
		// 		'recaptcha_response' => [
		// 		'required',
		// 		new Recaptcha,
		// 		],
		// ]);
		
		$validatedData = $request->validate([
			'name' => 'required|max:255',
			'email' => 'required|email',
			'message' => 'required',
		]);
		if($validatedData)
		{
			$requestedData = $request->all();
			$requestedData['subject_id'] = (int)18;//ask_price subject
			
			ShopMessages::create($requestedData);
	
			return redirect()->back();
		}
		else
		{
			
		}
		
	}
	
	static function TrackorderSendMessage(Request $request)
	{
		//2020-09-09-99/22
		$validatedData = $request->validate([
			'orderid' => 'required',
			'email' => 'required|email',			
		]);
		
		$orderid = explode("-", $validatedData["orderid"]);
		$orderid = $orderid["4"];
		$query = OnlineOrder::where('id', $orderid)->get();
		if($query)
		{
			$order = $query->toArray();
		}
		dd($order);

		return redirect()->back();
	}
}
