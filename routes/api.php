<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TodoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::prefix('v1')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('register', [AuthController::class, 'register']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::prefix('todos')->group(function () {
            Route::get('', [TodoController::class, 'getUserTodos']);
            Route::post('', [TodoController::class, 'store']);
            Route::put('', [TodoController::class, 'update']);
            Route::delete('/{todo}', [TodoController::class, 'destroy']);
        });
        Route::prefix('projects')->group(function () {
            Route::get('', [ProjectController::class, 'getUserProjects']);
        });
    });
});
