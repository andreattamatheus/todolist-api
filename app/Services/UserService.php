<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService {

    public function register(Request $request)
    {
        try {
            DB::beginTransaction();
                $user = User::create([
                    'name' => $request['name'],
                    'email' => $request['email'],
                    'password' => Hash::make($request['password']),
                ]);
            DB::commit();
            $token = $user->createToken('auth_token')->plainTextToken;
            return [
                'name' => $user->name,
                'email' => $user->email,
                'token' => $token
            ];
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
}
