<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResetPasswordNative extends Mailable
{
    use Queueable, SerializesModels;
    public $native;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($native)
    {
       $this->native = $native;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.native.native');
    }
}
