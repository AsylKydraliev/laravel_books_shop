<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class YourEmailMailable extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @return YourEmailMailable
     */
    public function build(): YourEmailMailable
    {
        return $this->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
            ->subject('iokeefe@example.org')
            ->view('emailTemplate');
    }
}
