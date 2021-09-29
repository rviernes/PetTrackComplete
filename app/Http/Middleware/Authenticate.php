<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            if (auth()->user()->usertype == 'admin') {
                return route('/admin/dashboard');
            } elseif (auth()->user()->usertype == 'veterinary') {
                return route('/veterinary/dashboard');
            } elseif (auth()->user()->usertype == 'customer'){
                return route('/user/dashboard');
            } else{
                return route('/');
            }
            
        }
    }
}
