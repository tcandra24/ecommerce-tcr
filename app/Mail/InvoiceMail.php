<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $invoice;
    public $grandTotal;
    public $title;

    /**
     * Create a new message instance.
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
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Invoice ' . $this->invoice->invoice)->view('emails.invoice-detail');
    }
}
