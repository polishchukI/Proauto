<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfClientAuthenticated
{
    public function handle($request, Closure $next)
    {
        if (Auth::guard('clients')->check()) {
            return redirect()->route('account.dashboard');
        }

        return $next($request);
    }
}
