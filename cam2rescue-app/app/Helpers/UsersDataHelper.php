<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Hash;

class UsersDataHelper {
    public function screenUserData($request) {
        $validatedData = $request->validate([
            'Lastname'          => 'required|string|max:100',
            'Firstname'         => 'required|string|max:100',
            'Middlename'        => 'nullable|string|max:100',
            'dob'               => 'required|date',
            'Gender'            => 'required|integer|max:11',
            'Status'            => 'nullable|integer|max:11',
            'Barangay'          => 'nullable|integer|max:100',
            'City'              => 'nullable|string|max:100',
            'OrgName'           => 'nullable|string|max:200',
            'OrgType'           => 'nullable|integer|max:5',
            'OrgCity'           => 'nullable|string|max:50',
            'OrgBarangay'       => 'nullable|integer|max:5',
            'Email'             => 'nullable|string|max:100',
            'UserType'          => 'required|integer|max:5',
            'Username'          => 'nullable|string|max:100|unique:tbluser,Username',
            'Password'          => 'nullable|string|min:8|confirmed',
        ]);

        return $validatedData;
    }

    public function userTblData($validatedData, $newUserId) {
        return [
            'UserID'    => $newUserId['seq_no'],
            'Email'     => $validatedData['Email'],
            'Username'  => $validatedData['Username'],
            'UserType'  => $validatedData['UserType'],
            'Password'  => Hash::make($validatedData['Password']),
        ];
    }

    public function userDetailTblData($validatedData, $newUserId) {
        return [
            'UserId'                    => $newUserId['seq_no'],
            'Lastname'                  => $validatedData['Lastname'],
            'Firstname'                 => $validatedData['Firstname'],
            'Middlename'                => $validatedData['Middlename'] ?? null,
            'BirthDate'                 => $validatedData['dob'],
            'Gender'                    => $validatedData['Gender'],
            'CivilStatus'               => $validatedData['Status'],
            'Barangay'                  => $validatedData['Barangay'],
            'City'                      => $validatedData['City'],
            'Organization_Name'         => $validatedData['OrgName'] ?? null,
            'Organization_Type'         => $validatedData['OrgType'] ?? null,
            'Organization_Barangay_Loc' => $validatedData['OrgBarangay'] ?? null,
            'Organization_City_Loc'     => $validatedData['OrgCity'] ?? null
        ];
    }
}