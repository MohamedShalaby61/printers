<?php

namespace App\Mail;
use App\User;
use App\CompletedFile;
use App\MyOrders;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PaymentMail extends Mailable
{
    use Queueable, SerializesModels;
    public $fileURL;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($fileURL)
    {
       $this->fileURL = $fileURL;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.payment.payment');
    }
}
