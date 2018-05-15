<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        // Session::put('oldURL', $request->url()); // malosh lazma
        if (Auth::guard($guard)->check()) {
            // return redirect('/home');
            return redirect()->route('home');
        }

        return $next($request);
    }
}
