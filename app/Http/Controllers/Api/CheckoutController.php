<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\InvoiceMail;

use App\Models\Invoice;

class CheckoutController extends Controller
{
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
        $data_transaction = Invoice::with('customer')->where('invoice', $orderId)->first();

        if ($transaction == 'capture') {

            // For credit card transaction, we need to check whether transaction is challenge by FDS or not
            if ($type == 'credit_card') {

              if($fraud == 'challenge') {

                /**
                *   update invoice to pending
                */
                $data_transaction->update([
                    'payment_status' => 'pending',
                ]);

              } else {

                /**
                *   update invoice to success
                */
                $data_transaction->update([
                    'payment_status' => 'success',
                    'order_status' => 'waiting_confirmation',
                ]);

                Mail::to($data_transaction->customer->email)->send(new InvoiceMail($data_transaction, $data_transaction->grand_total, 'Payment Success'));

              }

            }

        } elseif ($transaction == 'settlement') {

            /**
            *   update invoice to success
            */
            $data_transaction->update([
                'payment_status' => 'success',
                'order_status' => 'waiting_confirmation',
            ]);

            Mail::to($data_transaction->customer->email)->send(new InvoiceMail($data_transaction, $data_transaction->grand_total, 'Payment Success'));


        } elseif($transaction == 'pending'){


            /**
            *   update invoice to pending
            */
            $data_transaction->update([
                'payment_status' => 'pending',
                'order_status' => 'waiting_confirmation',
            ]);


        } elseif ($transaction == 'deny') {


            /**
            *   update invoice to failed
            */
            $data_transaction->update([
                'payment_status' => 'failed',
                'order_status' => 'waiting_confirmation',
            ]);


        } elseif ($transaction == 'expire') {


            /**
            *   update invoice to expired
            */
            $data_transaction->update([
                'payment_status' => 'expired',
                'order_status' => 'waiting_confirmation',
            ]);


        } elseif ($transaction == 'cancel') {

            /**
            *   update invoice to failed
            */
            $data_transaction->update([
                'payment_status' => 'failed',
                'order_status' => 'waiting_confirmation',
            ]);

        }

    }
}
