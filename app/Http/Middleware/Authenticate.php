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
        $routeUrl = '';
        if($request->segment(1) === 'admin'){
            $routeUrl = '/admin/login';
        } else {
            $routeUrl = '/login';
        }

        if (! $request->expectsJson()) {
            return url($routeUrl);
        }
    }
}