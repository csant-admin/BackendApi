<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User\User;
use App\Models\User\UserDetail;

class UserController extends Controller
{
    //
    public function createUser(Request $request) {
        $validatedData = $request->validate([
            'UserId'            => 'required|string|max:100',
            'Lastname'          => 'required|string|max:100',
            'Firstname'         => 'required|string|max:100',
            'Middlename'        => 'string|max:100',
            'dob'               => 'required|date',
            'Gender'            => 'required|string|max:10',
            'Status'            => 'required|string|max:10',
            'Barangay'          => 'required|string|max:100',
            'City'              => 'required|string|max:100',
            'Email'             => 'required|string|email|max:100|unique:tbluser,Email',
            'OrgName'           => 'string|max:200',
            'OrgType'           => 'integer|max:5',
            'OrgCity'           => 'string|max:50',
            'OrgBarangay'       => 'integer|max:5',
            'UserType'          => 'required|integer|max:5',
            'Username'          => 'required|string|max:100|unique:tbluser,Username',
            'Password'          => 'required|string|min:8|confirmed',
        ]);
        try {
            User::create([
                'UserID'    => $validatedData['UserId'],
                'Email'     => $validatedData['Email'],
                'Username'  => $validatedData['Username'],
                'UserType'  => $validatedData['UserType'],
                'Password'  => Hash::make($validatedData['Password']),
            ]);

            UserDetail::create([
                'UserId'                    => $validatedData['UserId'],
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
            
            return response()->json(['message' => 'User added successfully!'], 201);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to create user: ' . $e->getMessage()], 500);
        }
    }

    public function getList() {
        $data = array();
        try {
            $lists = User::with('details')->get();

            if($lists->isEmpty()) {

                return response()->json([[], 'message' => 'No Records Found'], 404);
            }

            $filteredList = $lists->map(function ($user) {
                return [
                    'Lastname' => $user->details->Lastname ?? null,
                    'Firstname' => $user->details->Firstname ?? null,
                    'Middlename' => $user->details->Middlename ?? null,
                    'Email' => $user->Email,
                    'Gender' => $user->details->Gender ?? null,
                    'Barangay' => $user->details->Barangay ?? null,
                    'City' => $user->details->City ?? null,
                ];
            });

            return response()->json($filteredList, 200);

        } catch(\Exception $e) {

            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
