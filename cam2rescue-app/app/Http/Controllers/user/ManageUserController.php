<?php

namespace App\Http\Controllers\user;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User\User;
use App\Models\User\UserDetail;
use App\Models\core\cam2rescue\CentralSequences;
use DB;

class ManageUserController extends Controller
{
    //
    public function createUser(Request $request) {
        $validatedData = $request->validate([
            'Lastname'          => 'required|string|max:100',
            'Firstname'         => 'required|string|max:100',
            'Middlename'        => 'string|max:100',
            'dob'               => 'required|date',
            'Gender'            => 'required|integer|max:11',
            'Status'            => 'required|integer|max:11',
            'Barangay'          => 'required|integer|max:100',
            'City'              => 'required|string|max:100',
            'Email'             => 'required|string|email|max:100|unique:tbluser,Email',
            'OrgName'           => 'nullable|string|max:200',
            'OrgType'           => 'nullable|integer|max:5',
            'OrgCity'           => 'nullable|string|max:50',
            'OrgBarangay'       => 'nullable|integer|max:5',
            'UserType'          => 'required|integer|max:5',
            'Username'          => 'required|string|max:100|unique:tbluser,Username',
            'Password'          => 'required|string|min:8|confirmed',
        ]);

        DB::connection('mysql_cam2rescue_core')->beginTransaction();
        DB::connection('mysql')->beginTransaction();
        try {
            $sequenceNo = CentralSequences::select('UserIdNo', 'Recently_Generated_UserID')->first();

            $user = User::create([
                'UserID'    => $sequenceNo->UserIdNo,
                'Email'     => $validatedData['Email'],
                'Username'  => $validatedData['Username'],
                'UserType'  => $validatedData['UserType'],
                'Password'  => Hash::make($validatedData['Password']),
            ]);

            $detail = UserDetail::create([
                'UserId'                    => $sequenceNo->UserIdNo,
                'Lastname'                  => $validatedData['Lastname'],
                'Firstname'                 => $validatedData['Firstname'],
                'Middlename'                => $validatedData['Middlename'],
                'BirthDate'                 => $validatedData['dob'],
                'Gender'                    => $validatedData['Gender'],
                'CivilStatus'               => $validatedData['Status'],
                'Barangay'                  => $validatedData['Barangay'],
                'City'                      => $validatedData['City'],
                'Organization_Name'         => $validatedData['OrgName'] ?? null,
                'Organization_Type'         => $validatedData['OrgType'] ?? null,
                'Organization_Barangay_Loc' => $validatedData['OrgBarangay'] ?? null,
                'Organization_City_Loc'     => $validatedData['OrgCity'] ?? null
            ]);

            if($user && $detail) {
                $sequenceNo->where('Sequence_Id', 0)->update([
                    'UserIdNo' => intval($sequenceNo->UserIdNo) + 1,
                    'Recently_Generated_UserID' => $sequenceNo->UserIdNo
                ]);
            }

            DB::connection('mysql_cam2rescue_core')->commit();
            DB::connection('mysql')->commit();
            
            return response()->json(['message' => 'User added successfully!'], 201);
            

        } catch (\Exception $e) {
            DB::connection('mysql_cam2rescue_core')->rollBack();
            DB::connection('mysql')->rollBack();
            return response()->json(['message' => 'Failed to create user: ' . $e->getMessage()], 500);
        }
    }

    public function getList() {
        $data = array();
        try {
            $lists = User::with(['details', 'details.sex', 'details.barangay','details.civilStatus'])->where('UserType', '!=', 1)->get();
            if($lists->isEmpty()) {

                return response()->json([[], 'message' => 'No Records Found'], 404);
            }

            $filteredList = $lists->map(function ($user) {
                return [
                    'UserID'        => $user->UserID,
                    'Lastname'      => $user->details->Lastname ?? null,
                    'Firstname'     => $user->details->Firstname ?? null,
                    'Middlename'    => $user->details->Middlename ?? null,
                    'Email'         => $user->Email,
                    'Gender'        => $user->details->sex->description ?? null,
                    'Barangay'      => $user->details->barangay->description ?? null,
                    'City'          => $user->details->City ?? null,
                ];
            });

            return response()->json($filteredList, 200);

        } catch(\Exception $e) {

            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function getUserDetail($id) {
        try {
            $user = User::with(['details', 'details.barangay', 'details.sex', 'details.civilStatus'])->where('UserID', $id)->get();
            if($user->isEmpty()) {
                return response()->json(['message' => 'No Details Found!'], 404);
            }
            $user_data = $user->map(function($item) {
                return [
                    'id'            => $item->UserID,
                    'email'         => $item->Email,
                    'lastname'      => $item->details->Lastname,
                    'firstname'     => $item->details->Firstname,
                    'middlename'    => $item->details->Middlename,
                    'birthday'      => $item->details->BirthDate,
                    'gender'        => $item->details->sex->description,
                    'civilStatus'   => $item->details->civilStatus->description,
                    'barangay'      => $item->details->barangay->description,
                    'city'          => $item->details->City
                ];
            });

            return response()->json($user_data, 200);
        } catch(\Exception $e) {
            return response()->json(['message' => 'Error!' . $e->getMessage()], 500);
        }
    }

    public function changeStatus($id) {
        DB::connection('mysql')->beginTransaction();
        try {
            $user = User::where('UserID', $id)->first();
            if (!$user) {
                return response()->json(['message' => 'User Not Found'], 404);
            }
            if (intval($user->UserStatus) === 1) {
                $isUpdated = User::where('UserID', $id)->update(['UserStatus' => 0]);
                $message    = $isUpdated 
                            ? 'User has been successfully deactivated' 
                            : 'Failed to deactivate user, please call Cam2Rescue team';
            } else {
                $isUpdated = User::where('UserID', $id)->update(['UserStatus' => 1]);
                $message    = $isUpdated 
                            ? 'User has been successfully activated' 
                            : 'Failed to activate user, please call Cam2Rescue team';
            }
            if (!$isUpdated) {
                DB::connection('mysql')->rollBack();
                return response()->json(['message' => $message], 500);
            }
            DB::connection('mysql')->commit();
            return response()->json(['message' => $message], 200);
    
        } catch (\Exception $e) {
            DB::connection('mysql')->rollBack();
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }
}
