<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\Invoice;

class CustomerController extends Controller
{
    public function profile()
    {
        $user = Auth::guard('customer')->user();
        $invoices = Invoice::where('customer_id', $user->id)->orderBy('created_at', 'desc')->get();

        return view('ecommerce.customer.my-profile.index', [
            'customer' => $user,
            'invoices' => $invoices,
        ]);
    }
}
