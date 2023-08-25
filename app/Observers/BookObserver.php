<?php

namespace App\Observers;

use App\Events\BookCreated;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;

class BookObserver
{
    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    public bool $afterCommit = true;

    /**
     * @param Book $book
     * @return void
     */
    public function created(Book $book): void
    {
        $bookLog = [
            'user_id' => Auth::id(),
            'content' => 'store'
        ];

        $book->logs()->create($bookLog);
    }

    /**
     * @param Book $book
     * @return void
     */
    public function updated(Book $book): void
    {
        $changes = $book->getChanges();
        $original = $book->getOriginal();
        $bookLogs = [];

        foreach ($original as $originalKey => $originalItem) {
            foreach ($changes as $changeKey => $changeItem) {
                if ($originalKey == $changeKey && $originalKey != 'updated_at') {
                    $bookLogs[] = [
                        'user_id' => Auth::id(),
                        'content' => ucfirst("$originalKey was changed from $originalItem to $changeItem"),
                    ];
                }
            }
        }

        if ($bookLogs) {
            $book->logs()->createMany($bookLogs);
        }
    }
}
