<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoStoreRequest;
use App\Jobs\CreateTodo;
use App\Models\Todo;
use App\Repositories\TodoRepository;
use App\Repositories\UserRepository;
use App\Services\TodoService;
use Illuminate\Http\Response;

class TodoController extends Controller
{
    public function __construct(private TodoService $todoService)
    {
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TodoStoreRequest $request, TodoRepository $todoRepository)
    {
        try {
            $this->todoService->store($todoRepository, $request);
            return response()->json([], Response::HTTP_ACCEPTED);
        } catch (\Throwable $th) {
            \Log::alert($th);
            return response()->json([
                'success' => false,
                'error' => $th,
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $todoId, TodoRepository $todoRepository)
    {
        try {
            $todoRepository->destroy($todoId);
            return response()->json([
                'success' => true,
                'message' => 'Todo deleted successfully',
            ], 204);
        } catch (\Throwable $th) {
            \Log::alert($th);
            return response()->json([
                'success' => false,
                'error' => $th,
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(TodoStoreRequest $request, TodoRepository $todoRepository)
    {
        try {
            $todoRepository->update($request);
            return response()->json([
                'success' => true,
                'message' => 'Todo update successfully',
            ], 204);
        } catch (\Throwable $th) {
            \Log::alert($th);
            return response()->json([
                'success' => false,
                'error' => $th,
            ], 500);
        }
    }

    public function getUserTodos(UserRepository $userRepository)
    {
        try {
            $getUserTodos = $userRepository->getUserTodos(auth()->user());
            return response()->json($getUserTodos, 200);
        } catch (\Throwable $th) {
            \Log::alert($th);
            return response()->json([
                'success' => false,
                'error' => $th,
            ], 500);
        }
    }
}
