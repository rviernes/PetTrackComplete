<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VetMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()->usertype == "veterinary"){
            return $next($request);
        }
        elseif (auth()->user()->usertype == "customer") {
            return back();
        }
        elseif(auth()->user()->usertype == "admin"){
            return back();
        }
    }
}
