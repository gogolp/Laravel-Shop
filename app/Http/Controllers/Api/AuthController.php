<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $validate = $request->validate([
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'password' => 'required'
        ]);

        if (empty($validate['phone']) && empty($validate['email'])) {
            return response()->json([
                'message' => 'Email or Phone is required'
            ], 422);
        }

        $user = User::where('email', $validate['email'])
            ->orWhere('phone', $validate['phone'])
            ->first();

        if (!$user || !Hash::check($validate['password'], $user->password)) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login Successful',
            'token' => $token,
            'user' => $user,
        ], 200);
    }

    public function register(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'email' => 'nullable|email|unique:users',
            'phone' => 'nullable|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);

        if (empty($validate['email'] && empty($validate['phone']))) {
            return response()->json([
                'message' => 'Email or Phone is required'
            ], 422);
        }

        $user = User::create([
            'name' => $validate['name'],
            'email' => $validate['email'] ?? null,
            'phone' => $validate['phone'] ?? null,
            'password' => $validate['password'],
        ]);

        $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'User registered successfully',
            'user_id' => $user->id,
        ], 201);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out, successfully'
        ], 200);
    }

    public function me(Request $request)
    {
        return new UserResource($request->user());
    }

    // New update this function later!!!!!!
    public function verifyCode(Request $request)
    {
        return response()->json([
            'success' => true,
            'message' => 'Verified',
        ], 200);
    }

}
