<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Traits\Auth\LoginTrait;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use LoginTrait;

    public function index()
    {
        return view('ecommerce.auth.login');
    }

    public function login(LoginRequest $request)
    {
        try {
            if(!$this->doLogin($request, 'customer')){
                throw new \Exception('Login Failed, Username/Password wrong');
            }

            $request->session()->regenerate();
            return redirect()->intended('/');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
