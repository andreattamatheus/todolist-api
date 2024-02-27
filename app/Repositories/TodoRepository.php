<?php

namespace App\Repositories;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class TodoRepository
{
    protected $todo = Todo::class;

    public function store($user, $title)
    {
        DB::beginTransaction();
        $todo = $this->todo::create([
            'id' => Uuid::uuid4(),
            'title' => $title,
            'description' => 'Generic description',
            'user_id' => $user->id,
            'project_id' => optional($user->projects->first())->id,
        ]);
        DB::commit();
        return $todo;
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        $todoToUpdate = $this->todo::where('id', $request->input('todoId'))->first();
        $todoToUpdate->title = $request->input('title');
        $todoToUpdate->save();
        DB::commit();
        return $todoToUpdate;
    }

    public function destroy(string $todoId)
    {
        return $this->todo::find($todoId)->delete();
    }
}
