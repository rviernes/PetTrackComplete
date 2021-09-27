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
            alert()->warning('You do not have access to that page','Customer Denied');
            return back();
        }
        elseif (auth()->user()->usertype == "veterinary") {
            alert()->warning('You do not have access to that page','Veterinary Denied');
            return back();
        }
        
        
    }
}
