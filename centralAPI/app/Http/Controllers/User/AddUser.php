<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\DynamicInsertService;
use App\Models\Core\User;

class AddUser extends Controller
{
    //
    public function registerUser(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'name' => 'required|string|max:255',
        ]);
        $useModel = new User();
        $insertService = new DynamicInsertService();
        $userId = $insertService->insertUsingModel($useModel, $request, true);

        return response()->json([
            'message' => 'User registered successfully',
            'user_id' => $userId
        ]);
    }
}
