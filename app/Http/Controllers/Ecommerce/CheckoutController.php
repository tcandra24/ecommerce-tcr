<?php

namespace App\Http\Controllers\Ecommerce;

use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Mail\InvoiceMail;

use Midtrans\Snap;
use App\Models\Cart;
use App\Models\City;
use App\Models\Province;
use App\Models\Invoice;
use App\Models\Order;

class CheckoutController extends Controller
{
    protected $request;
    /**
     * __construct
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        // Set midtrans configuration
        \Midtrans\Config::$serverKey    = config('services.midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
        \Midtrans\Config::$isSanitized  = config('services.midtrans.isSanitized');
        \Midtrans\Config::$is3ds        = config('services.midtrans.is3ds');
    }

    public function index()
    {
        $user = Auth::guard('customer')->user();
        $carts = Cart::with('product')->where('customer_id', $user->id)->get();

        $provinces = Province::all();
        $cities = City::all();
        return view('ecommerce.checkouts.index', [
            'carts' => $carts,
            'customer' => $user,
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
            $carts = Cart::where('customer_id', $user->id)->get();

            $grandTotal = $carts->sum('total');

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
                'payment_status' => 'pending',
                'order_status' => 'waiting_payment',
                'grand_total' => $grandTotal,
            ]);

            foreach($carts as $cart){
                $invoice->orders()->create([
                    'invoice_id' => $invoice->id,
                    'product_id' => $cart->product_id,
                    'qty' => $cart->qty,
                    'price' => $cart->price,
                ]);
            }

            // Payload Midtrans
            $payload = [
                'transaction_details' => [
                    'order_id' => $invoice->invoice,
                    'gross_amount' => $invoice->grand_total
                ],
                'customer_details' => [
                    'first_name' => $invoice->name,
                    'email' => $user->email,
                    'phone' => $invoice->phone,
                    'shipping_address' => $invoice->address,
                ]
            ];

            $snapToken = Snap::getSnapToken($payload);
            $invoice->snap_token = $snapToken;
            $invoice->save();

            Mail::to($user->email)->send(new InvoiceMail($invoice, $grandTotal, 'Waiting For Payment....'));

            Cart::where('customer_id', $user->id)->delete();

        });

        return redirect()->to('/my-account')->with('success', 'Invoice Create Successfully');
    }
}


// $details = [
//     'title' => 'Mail from ItSolutionStuff.com',
//     'body' => 'This is for testing email using smtp'
// ];

// Mail::to('tcandra007@gmail.com')->send(new \App\Mail\TestMail($details));

// dd("Email is Sent.");
