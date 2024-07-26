<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Models\Dashboard\ManageUser\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManageUserController extends Controller
{
    public function getUserList() {
        try {
            $userlist = User::with('userDetail')->where('userType', 2)->get();

            if(empty($userlist)) {
                return response()->json([], 200);
            }

            return response()->json($userlist, 200);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Error fetching user list', 'message' => $e->getMessage()], 500);
        }
    }

    public function updateUser(Request $request, $id) {
       
        $validatedData = $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|max:255',
            'address'   => 'nullable|string|max:255',
            'phone'     => 'nullable|string|max:20',
        ]);

        DB::beginTransaction();

        try {

            $user = User::findOrFail($id);

            $user->name     = $validatedData['name'];
            $user->email    = $validatedData['email'];
            $user->save();

            $userDetail = $user->userDetail;
            if (!$userDetail) {
                $userDetail             = new UserDetail();
                $userDetail->fk_user_id = $user->id; 
            }
            $userDetail->address    = $validatedData['address'];
            $userDetail->phone      = $validatedData['phone'];
           
            $userDetail->save();

            DB::commit();

            return response()->json(['message' => 'User updated successfully'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Error updating user', 'message' => $e->getMessage()], 500);
        }
    } 
}
