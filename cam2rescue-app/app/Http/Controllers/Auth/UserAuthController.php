<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use App\Models\Auth\UserAuth;

class UserAuthController extends Controller
{
public function login(Request $request)
{
    $request->validate([
        'username' => 'required|string',
        'password' => 'required|string',
    ]);

    try {
        $user = UserAuth::where('Username', $request->username)
            ->with(['roles.accessControl' => fn($q) => $q->where('access_permission', 1)])
            ->first();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found.'
            ], 404);
        }

        if ((int)$user->UserStatus === 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'Your account has been deactivated. Contact support.'
            ], 403);
        }

        if (!Hash::check($request->password, $user->Password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid username or password.'
            ], 401);
        }

        Auth::login($user);
        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'Login successful.',
            'data' => [
                'user' => $user->makeHidden(['Password', 'remember_token']),
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]
        ]);
    } catch (\Throwable $e) {
        \Log::error('Login exception: '.$e->getMessage());
        return response()->json([
            'status' => 'error',
            'message' => 'A server error occurred. Please try again later.'
        ], 500);
    }
}



    public function logout(Request $request)
    {
        Auth::logout();
        return response()->json(['message' => 'Successfully logged out']);
    }
}

