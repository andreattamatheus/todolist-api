<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Collection;

class UserRepository
{
    protected $user = User::class;


    public function getUserTodos($user): Collection
    {
        return $this->user::where('email', $user->email)->first()->todos;
    }

}
