<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Customer;
use App\Models\Invoice;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::all();

        return view('admin.invoices.index', [ 'invoices' => $invoices ]);
    }

    public function show($invoice)
    {
        $invoice = Invoice::with('orders')->where('invoice', $invoice)->first();

        $customers = Customer::all();

        return view('admin.invoices.show', [ 'invoice' => $invoice, 'customers' => $customers ]);
    }
}
