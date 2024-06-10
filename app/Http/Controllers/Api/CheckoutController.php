<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
