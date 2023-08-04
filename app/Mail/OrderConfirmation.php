<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $order_item;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order_item)
    {
        $this->order_item = $order_item;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $order_confirm = 'Gadget Hub: Your Order Pending';
        return $this->subject($order_confirm)->view('admin.partials.order_confirmation');
    }
}
