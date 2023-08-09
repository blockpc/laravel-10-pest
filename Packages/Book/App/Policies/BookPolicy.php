<?php

declare(strict_types=1);

namespace Packages\Book\App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Packages\Book\App\Models\Book;

final class BookPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given post can be updated by the user.
     */
    public function update(User $user, Book $book): bool
    {
        return $user->books->contains($book);
    }
}
