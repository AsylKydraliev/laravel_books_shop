<?php

namespace App\Listeners;

use App\Events\BookCreated;
use App\Mail\EmailMailable;
use Illuminate\Support\Facades\Mail;

class BookCreatedListener
{

    /**
     * @param BookCreated $event
     * @return void
     */
    public function handle(BookCreated $event): void
    {
        $to = 'recipient@example.com';
        Mail::to($to)->send(new EmailMailable($event->book));
    }
}
