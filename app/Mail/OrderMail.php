<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $cartitems;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order, $cartitems)
    {
        $this->order = $order;
        $this->cartitems = $cartitems;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $order_confirm = 'Gadget Hub: Your Order Pending';
        return $this->subject($order_confirm)->view('frontend.partials.order-mail');
    }
}
