<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
            if(in_array('admin' ,User::find(Auth::id())->roles->pluck('name')->toArray())) {
                return $next($request);
            }
            return redirect()->back();
        }

}
