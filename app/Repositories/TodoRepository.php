<?php

namespace App\Repositories;

use App\Models\Todo;
use Illuminate\Support\Collection;

class TodoRepository
{
    protected $todo = Todo::class;

    public function getAll(): Collection
    {
        return $this->todo::all();
    }

}
