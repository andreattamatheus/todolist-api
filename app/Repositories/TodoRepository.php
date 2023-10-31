<?php

namespace App\Repositories;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Support\Collection;

class TodoRepository
{
    /**
     * Get all todos by a specific user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function getAllByUser(User $user): Collection
    {
        return $user->todos;
    }
}
