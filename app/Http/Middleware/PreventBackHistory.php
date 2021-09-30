<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PreventBackHistory
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
        $response = $next($request);
        $response->header('Cache-Control','nocache, no-store, max-age=0, must-revalidate');
        $response->header('Pragma','nocache');
        $response->header('Expires','Fri, 01 Jan 1990 00:00:00 GMT');

        return $response;
    }
}
