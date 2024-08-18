<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class OrderInfoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    protected $filePath;

    /**
     * Create a new message instance.
     *
     * @param \App\Models\Order $order
     * @param string $filePath
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Neue Pfaditechnik Bestellung')
                    ->markdown('emails.orders.info')
                    ->with('order', $this->order);
    }
}