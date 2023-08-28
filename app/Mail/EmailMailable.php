<?php

namespace App\Mail;

use App\Models\Book;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailMailable extends Mailable
{
    use Queueable, SerializesModels;

    public Book $book;

    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    /**
     * @return EmailMailable
     */
    public function build(): EmailMailable
    {
        return $this->from(
                env('MAIL_FROM_ADDRESS'),
                env('MAIL_FROM_NAME')
            )
                ->subject('iokeefe@example.org')
                ->view('mail.email', ['book' => $this->book]);
    }
}
