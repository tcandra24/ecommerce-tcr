<?php

namespace App\Http\Controllers\Sandbox;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Invoice;

class EmailController extends Controller
{
    public function show($invoice)
    {
        $invoice = Invoice::with('orders', 'orders.product', 'customer')->where('invoice', $invoice)->first();

        $grandTotal = 0;
        foreach($invoice->orders as $order){
            $grandTotal += $order->total;
        }

        return view('emails.invoice-detail', ['invoice' => $invoice, 'grandTotal' => $grandTotal]);
    }
}
