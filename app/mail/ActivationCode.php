<?php

namespace App\mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ActivationCode extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $Token;
    public function __construct($code)
    {
        $this->Token=$code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $From=config('mail.from.address');
        return $this->from($From)->view('MultiAuth:Mail.ActiveCode');
    }
}
