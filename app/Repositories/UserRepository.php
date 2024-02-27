<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Collection;

class UserRepository
{
    protected $user = User::class;

    public function getUserTodos(): Collection
    {
        return $this->user::where('email', auth()->user()->email)->first()
            ->todos()->orderBy('created_at', 'desc')->get();
    }

    public function getUserProjects(): Collection
    {
        return $this->user::where('email', auth()->user()->email)->first()
            ->projects()->orderBy('created_at', 'desc')->get();
    }
}
