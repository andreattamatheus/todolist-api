<?php

namespace App\Repositories;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Ramsey\Uuid\Uuid;

class TodoRepository
{
    protected $todo = Todo::class;

    public function store(Request $request)
    {
        return $this->todo::create([
            'id' => Uuid::uuid4(),
            'title' => $request->title,
            'description' => 'Generic description',
            'user_id' => auth()->user()->id,
            'project_id' => auth()->user()->projects->first()->id,
        ]);
    }

    public function destroy(string $todoId)
{
        return $this->todo::find($todoId)->delete();
    }
}
