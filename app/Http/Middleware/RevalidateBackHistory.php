<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RevalidateBackHistory
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
        $path = $request->path();
        
        if (($path == "loginlogin" || $path == "registerregister") && auth()->user()->usertype == 'admin') {
           return back();
        } elseif(auth()->user()) {
            if ($path != 'loginlogin' && !(auth()->user()->usertype == 'customer') && !(auth()->user()->usertype == 'admin')) {
                return back();
            }
        }
        return $next($request);
    }
}
