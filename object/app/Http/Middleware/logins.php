<?php

namespace App\Http\Middleware;

use Closure;

class logins
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
        if(session()->has('user')){
            return $next($request);
        }

        return redirect('/login');
    }
}
