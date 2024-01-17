<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Customer;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function profile()
    {
        return view('ecommerce.customer.my-profile.index', [
            'customer' => Auth::guard('customer')->user(),
        ]);
    }
}
