<?php

namespace App\Traits\Auth;
use Illuminate\Support\Facades\Auth;

trait LoginTrait
{
    public function doLogin($request, $guard){
        $credentials = $request->only('email', 'password');
        if (!Auth::guard($guard)->attempt($credentials, $request->remember)) {
            return false;
        }

        return true;
    }
}
