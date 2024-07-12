<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class DebugBarMiddleware
{
    public function handle($request, Closure $next)
    {
        // if (auth()->user() && in_array(auth()->id(), [1,2,3]))
		// {
            \Debugbar::enable();
        // }
        // elseif (Auth::guard('clients') && in_array(Auth::guard('clients')->id(), [4]))
		// {
        //     \Debugbar::enable();
        // }
        // else
		// {
        //     \Debugbar::disable();
        // }
        return $next($request);
    }
}
