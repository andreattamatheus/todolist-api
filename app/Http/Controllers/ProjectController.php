<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;

class ProjectController extends Controller
{
    public function getUserProjects(UserRepository $userRepository): ?\Illuminate\Http\JsonResponse
    {
        try {
            $getUserTodos = $userRepository->getUserProjects(auth()->user());
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
