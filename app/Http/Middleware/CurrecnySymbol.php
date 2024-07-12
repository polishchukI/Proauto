<?php

namespace App\Http\Middleware;

use Closure;
use Torann\Currency\Middleware\CurrencyMiddleware;

class CurrecnySymbol extends CurrencyMiddleware
{
	public function handle($request, Closure $next)
    {
		$user_currency = $request->getSession()->get('currency');
		
		$user_currency_find = currency()->find($user_currency);

		// dd(compact('user_currency_find'));
		$currency_symbol = $user_currency_find->symbol ?? "RUB";//after deactivating currencies in mysql settings
		
		$request->getSession()->put(['currency_symbol' => $currency_symbol]);
        
		return $next($request);
    }
}
