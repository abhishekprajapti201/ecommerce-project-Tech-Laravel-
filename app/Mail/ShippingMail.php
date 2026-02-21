<?php

namespace App\Mail;

use App\Models\Order;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ShippingMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $user;
    public $shipping;

    public function __construct( $order,  $user, $shipping)
    {
        $this->order = $order;
        $this->user = $user;
        $this->shipping = $shipping;
    }

    public function build()
    {
        return $this->subject('Your Order Has Been Shipped!')
                    ->view('emails.shipping');
    }
}

