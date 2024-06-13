<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ReceiptTemplate extends Component
{
    public $invoice;
    public $grandTotal;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($invoice, $grandTotal)
    {
        $this->invoice = $invoice;
        $this->grandTotal = $grandTotal;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.receipt-template');
    }
}
