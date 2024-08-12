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
                'username' => 'required',
                'password' => 'required',
            ]);

            $user = UserAuth::where('Username', $request->username)->first();

            if ($user && Hash::check($request->password, $user->Password)) {
                Auth::login($user);

                return response()->json(['user' => $user], 200);
            }

            return response()->json(['error' => 'The provided credentials do not match our records.'], 401);
        }


    public function logout(Request $request)
    {
        Auth::logout();
        return response()->json(['message' => 'Successfully logged out']);
    }
}

