<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class adminLogin
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
        if (Auth::check() ){
            if (Auth::user()->lever==1 || Auth::user()->lever==2 )
            {
                return $next($request);
            }else
                {
                return redirect()->route('trangchu');
                }
        }else
            {
            return redirect()->route('trangchu');
            }

    }
}
