<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Invoice;

class OrderController extends Controller
{
    public function show($invoice)
    {
        $invoice = Invoice::with('orders', 'orders.product')->where('invoice', $invoice)->first();

        $grandTotal = 0;
        foreach($invoice->orders as $order){
            $grandTotal += $order->total;
        }


        return view('ecommerce.customer.orders.detail', [
            'invoice' => $invoice,
            'grandTotal' => $grandTotal,
        ]);
    }
}
