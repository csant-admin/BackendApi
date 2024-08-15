<?php

namespace App\Http\Controllers;

use App\Models\Auth\UserAuth;

use Illuminate\Http\Request;

class TestController extends Controller
{
    //

    public function createToken()
    {
        $user = UserAuth::find(1); // Adjust the ID or query as needed
        if ($user) {
            $token = $user->createToken('testToken')->plainTextToken;
            dd($token); // Dump the token to verify creation
        } else {
            return response()->json(['error' => 'User not found'], 404);
        }
    }
}


