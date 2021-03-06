<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use SweetAlert\SweetAlert;

class AdminMiddleware
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
        if(auth()->user()->usertype == "admin"){
            return $next($request);
        }
        elseif(auth()->user()->usertype == "customer"){
            return back();
        }
        elseif (auth()->user()->usertype == "veterinary") {
            return back();
        }
        
        
    }
}
