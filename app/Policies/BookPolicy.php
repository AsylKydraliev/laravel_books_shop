<?php

namespace App\Policies;

use App\Models\Book;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Access\Response;

class BookPolicy
{
    /**
     * @param User $user
     * @param Book $book
     * @return bool
     */
    public function update(User $user, Book $book): bool
    {
        $currentDateTime = Carbon::now();
        $createdAt = Carbon::parse($book->created_at);
        $daysDifference = $currentDateTime->diffInDays($createdAt);

        if($daysDifference > 1) {
            return false;
        }

        return true;
    }

    /**
     * @param User $user
     * @param Book $book
     * @return bool
     */
    public function delete(User $user, Book $book): bool
    {
        if($book->price > 500) {
            return false;
        }

        return true;
    }
}
