<?php

namespace App\Services;

use App\Jobs\CreateTodo;
use App\Repositories\TodoRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TodoService
{
    public function store(TodoRepository $todoRepository, Request $request)
    {
        try {
            CreateTodo::dispatch($todoRepository, auth()->user(), $request->title);
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
}
