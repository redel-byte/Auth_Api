<?php

namespace App\Http\Controllers;

use App\Http\Requests\loginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        return response()->json([
            'message' => 'Account created successfully',
            'user' => $user,
        ], 201);
    }

    public function login(loginRequest $request)
    {
        $credentials = $request->validated();

        if ($token = Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Login successfully',
                'token' => $token
            ], 200);
        }

        return response()->json([
            'message' => 'Login failed',
        ], 401);
    }
    public function me()
    {
        return response()->json(Auth::user());
    }
    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => 'logout seccusfelly']);
    }
}
