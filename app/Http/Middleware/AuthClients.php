<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthClients
{
    public function handle($request, Closure $next)
    {
        if (false == Auth::guard('clients')->check())
		{
            return redirect()->route('account.login.send');
        }

        return $next($request);
    }
}
