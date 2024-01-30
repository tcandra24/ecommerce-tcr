<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Cart;
use App\Models\City;
use App\Models\Province;
use App\Models\Invoice;
use App\Models\Order;

class CheckoutController extends Controller
{
    public function index()
    {
        $carts = Cart::with('product')->where('customer_id', Auth::guard('customer')->user()->id)->get();

        $provinces = Province::all();
        $cities = City::all();
        return view('ecommerce.checkouts.index', [
            'carts' => $carts,
            'customer' => Auth::guard('customer')->user(),
            'provinces' => $provinces,
            'cities' => $cities,
        ]);
    }

    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            $length = 10;
            $random = '';
            for ($i = 0; $i < $length; $i++) {
                $random .= rand(0, 1) ? rand(0, 9) : chr(rand(ord('a'), ord('z')));
            }

            $user = Auth::guard('customer')->user();
            $carts = Cart::where('customer_id', Auth::guard('customer')->user()->id)->get();

            $noInvoice = 'INV-TCR-' . Str::upper($random);
            $invoice = Invoice::create([
                'invoice' => $noInvoice,
                'customer_id' => $user->id,
                'weight' => $carts->sum('weight'),
                'name' => $user->name,
                'phone' => $user->phone,
                'city_id' => $request->city,
                'province_id' => $request->province,
                'address' => $user->address,
                'status' => 'pending',
                'grand_total' => $carts->sum('total'),
            ]);

            foreach($carts as $cart){
                $invoice->orders()->create([
                    'invoice_id' => $invoice->id,
                    'product_id' => $cart->product_id,
                    'qty' => $cart->qty,
                    'price' => $cart->price,
                ]);
            }

            Cart::where('customer_id', $user->id)->delete();

        });

        return redirect()->to('/my-account')->with('success', 'Invoice Create Successfully');
    }
}
