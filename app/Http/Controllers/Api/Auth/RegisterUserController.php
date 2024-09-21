<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\Api\RegisterUserRequest;

class RegisterUserController extends Controller
{
    public function register(RegisterUserRequest $request)
    {

        $validatedData = $request->validated();

        $validatedData['password'] = Hash::make($validatedData['password']);
        // Create the user
        $user = User::create($validatedData);

        $token = $user->createToken('user', ['app:all'])->plainTextToken;
        Auth::login($user);

        // Return response with token
        return response()->json([
            'message' => 'Registered successfully.',
            'token' => $token,
        ], 201);
    }
}
