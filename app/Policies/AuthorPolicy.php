<?php

namespace App\Policies;

use App\Models\Author;
use App\Models\User;

class AuthorPolicy
{
    /**
     * @param User $user
     * @param Author $author
     * @return bool
     */
    public function update(User $user, Author $author): bool
    {
        return $user->id === $author->user_id;
    }

    /**
     * @param User $user
     * @param Author $author
     * @return bool
     */
    public function delete(User $user, Author $author): bool
    {
        return $user->id === $author->user_id;
    }
}
