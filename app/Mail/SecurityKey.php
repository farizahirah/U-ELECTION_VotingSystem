<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SecurityKey extends Mailable
{
    use Queueable, SerializesModels;

    public $key;
    /**
     * Create a new message instance.
     */
    public function __construct($key)
    {
        $this->key = $key;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Mail from U-Election')
                    ->view('Mail')
                    ->with(['data' => $this->key]);
    }

}
