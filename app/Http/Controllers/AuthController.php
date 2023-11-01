<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRegisterRequest;
use App\Http\Requests\AuthLoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\AuthService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(AuthRegisterRequest $request)
    {
        try {
            $user = $this->userService->register($request);
            return response()->json([
                'email' => $user['email'],
                'access_token' => $user['token'],
                'token_type' => 'Bearer',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th], 500);
        }

    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(AuthLoginRequest $request)
    {
        if (!auth()->attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Password is incorrect'
            ], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'name' => $user->name,
            'email' => $user->email,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }


    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me(Request $request)
    {
        return $request->user();
    }

}
