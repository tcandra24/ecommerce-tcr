<?php

namespace App\View\Components;

use Illuminate\View\Component;

class EmailInvoiceTemplate extends Component
{
    public $invoice;
    public $grandTotal;
    public $title;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($invoice, $grandTotal, $title = '')
    {
        $this->invoice = $invoice;
        $this->grandTotal = $grandTotal;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.email-invoice-template');
    }
}
