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
    public function login(Request $request) {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        try {
            $user = UserAuth::where('Username', $request->username)->first();
            if (!$user) {
                return response()->json(['error' => 'User not found.'], 404);
            }

            if(intval($user->UserStatus) === 0) {
                return response()->json(['error' => 'Account has been deactivated, please call Cam2Rescue team.'], 404);
            }
    
            if ($user && Hash::check($request->password, $user->Password)) {

                Auth::login($user);
                
                $token = $user->createToken('authToken')->plainTextToken;
                
                \Log::info('Login Request:', $request->all());

    
                return response()->json(['user' => $user, 'access_token' => $token, 'token_type' => 'Bearer'], 200);
            } else {
                return response()->json(['error' => 'Invalid credentials.'], 401);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
    

    public function logout(Request $request)
    {
        Auth::logout();
        return response()->json(['message' => 'Successfully logged out']);
    }
}

