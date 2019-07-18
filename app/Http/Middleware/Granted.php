<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Granted
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
        if(Auth::check()) {
            if( !Auth::user()->permissions->where('permission_id', 71)->isEmpty() || !Auth::user()->permissions->where('permission_id', env("P_REGULAR"))->isEmpty()) {
                return $next($request);
            } else {
                return route('login');
            }
        } 
    }
}
