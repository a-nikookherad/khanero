<?php

namespace App\mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendNewsletter extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $Url;


    public function __construct($Url)
    {
        $this->Url=$Url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $From=config('mail.from.address');
        return $this->from($From)->view('Newsletter::Mail.SendNewsletter');
    }
}
