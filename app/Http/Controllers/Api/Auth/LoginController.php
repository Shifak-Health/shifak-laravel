<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use Illuminate\Support\Facades\Auth;

class RegisterUserController extends Controller
{
    public function Login(LoginRequest $request)
    {
        $credentials = $request->validated();
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('user', ['app:all'])->plainTextToken;
            return response()->json(['message' => 'Login successful', 'token' => $token], 200);
        }
    }
}
