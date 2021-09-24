<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use SweetAlert\SweetAlert;

class UserMiddleware
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
        if(auth()->user()->usertype == "customer"){
            return $next($request);
        }
        elseif (auth()->user()->usertype == "veterinary") {
            return redirect('/home')->with('denied',"You don't have access to that page! V");
        }
        elseif(auth()->user()->usertype == "admin"){
            alert()->warning("You do not have access to that page", "Admin Denied");
            return back();
        }
    }
}
