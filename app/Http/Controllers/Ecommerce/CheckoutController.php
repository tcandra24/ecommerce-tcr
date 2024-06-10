<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

            // Payload Midtrans
            $payload = [
                'transaction_details' => [
                    'order_id' => $invoice->invoice,
                    'gross_amount' => $invoice->grand_total
                ],
                'customer_details' => [
                    'first_name' => $invoice->name,
                    'email' => Auth::guard('customer')->user()->email,
                    'phone' => $invoice->phone,
                    'shipping_address' => $invoice->address,
                ]
            ];

            $snapToken = Snap::getSnapToken($payload);
            $invoice->snap_token = $snapToken;
            $invoice->save();

            Cart::where('customer_id', $user->id)->delete();

        });

        return redirect()->to('/my-account')->with('success', 'Invoice Create Successfully');
    }

    public function notificationHandler(Request $request)
    {
        $payload      = $request->getContent();
        $notification = json_decode($payload);

        $validSignatureKey = hash("sha512", $notification->order_id . $notification->status_code . $notification->gross_amount . config('services.midtrans.serverKey'));

        if ($notification->signature_key != $validSignatureKey) {
            return response(['message' => 'Invalid signature'], 403);
        }

        $transaction  = $notification->transaction_status;
        $type         = $notification->payment_type;
        $orderId      = $notification->order_id;
        $fraud        = $notification->fraud_status;

        //data tranaction
        $data_transaction = Invoice::where('invoice', $orderId)->first();

        if ($transaction == 'capture') {

            // For credit card transaction, we need to check whether transaction is challenge by FDS or not
            if ($type == 'credit_card') {

              if($fraud == 'challenge') {

                /**
                *   update invoice to pending
                */
                $data_transaction->update([
                    'status' => 'pending'
                ]);

              } else {

                /**
                *   update invoice to success
                */
                $data_transaction->update([
                    'status' => 'success'
                ]);

              }

            }

        } elseif ($transaction == 'settlement') {

            /**
            *   update invoice to success
            */
            $data_transaction->update([
                'status' => 'success'
            ]);


        } elseif($transaction == 'pending'){


            /**
            *   update invoice to pending
            */
            $data_transaction->update([
                'status' => 'pending'
            ]);


        } elseif ($transaction == 'deny') {


            /**
            *   update invoice to failed
            */
            $data_transaction->update([
                'status' => 'failed'
            ]);


        } elseif ($transaction == 'expire') {


            /**
            *   update invoice to expired
            */
            $data_transaction->update([
                'status' => 'expired'
            ]);


        } elseif ($transaction == 'cancel') {

            /**
            *   update invoice to failed
            */
            $data_transaction->update([
                'status' => 'failed'
            ]);

        }

    }
}
