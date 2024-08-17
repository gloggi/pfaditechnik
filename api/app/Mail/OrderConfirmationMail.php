<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class OrderConfirmationMail extends Mailable
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
    public function __construct(Order $order, $filePath)
    {
        $this->order = $order;
        $this->filePath = $filePath;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Order Confirmation')
                    ->markdown('emails.orders.confirmation')
                    ->with('order', $this->order)
                    ->attach(Storage::path($this->filePath), [
                        'as' => 'QR_Bill-' . $this->order->order_nr . '.pdf',
                        'mime' => 'application/pdf',
                    ]);
    }
}