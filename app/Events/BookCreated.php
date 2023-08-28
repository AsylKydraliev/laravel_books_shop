<?php

namespace App\Events;

use App\Models\Book;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BookCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Book $book;

    /**
     * @param $book
     */
    public function __construct($book)
    {
        $this->book = $book;
    }
}
