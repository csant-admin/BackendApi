<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostPet;
use Illuminate\Support\Facades\Auth;
use App\Models\rescue\PetRescueModel;

class PostPetController extends Controller
{
    //
    public function postPet(Request $request) {
        $request->validate([
            'petId'             => 'required|string|max:50',
            'image'             => 'required|mimes:jpg,jpeg,png|max:2048',
            'petName'           => 'required|string|max:100',
            'petGender'         => 'required|string|max:10',
            'petDescription'    => 'required|string|max:1000'
        ]);
        
        $data = [
            'PetID'             => $request->input('petId'),
            'PetName'           => $request->input('petName'),
            'PetSex'            => $request->input('petGender'),
            'PetDescription'    => $request->input('petDescription'),
            'ImagePath'         => $request->file('image')->store('images', 'public')
        ];

        PostPet::create($data);

        return response()->json(['data' => $data], 201);
    }

    public function postRescue(Request $request) {
        if (!Auth::check()) {
            return response()->json(['msg' => 'User not authenticated'], 401);
        }
    
        // Get the authenticated user
        $user = Auth::user();
        echo '<pre>';
        print_r($user);
        echo '</pre>';
        $request->validate([
            'petId'             => 'required|string|max:50',
            'image'             => 'required|mimes:jpg,jpeg,png|max:2048',
            'Color'             => 'required|string|max:50',
            'Injury'            => 'required|string|max:5',
            'Urgency'           => 'required|string|max:5',
            'Gender'            => 'required|string|max:50',
            'Barangay'          => 'required|string|max:50',
            'Street'            => 'required|string|max:100',
            'City'              => 'required|string|max:100',
            'description'       => 'required|string|max:1000',
            'UserID'            => 'required|string|max:20'

        ]);

        $data = [
            'RescueId'          => $request->input('petId'),
            'PetColorId'        => $request->input('Color'),
            'PetSexId'          => $request->input('Gender'),
            'InjuryId'          => $request->input('Injury'),
            'UrgencyId'         => $request->input('Urgency'),
            'BarangayId'        => $request->input('Barangay'),
            'SBZ_Address'       => $request->input('Street'),
            'City'              => $request->input('City'),
            'Description'       => $request->input('description'),
            'ImagePath'         => $request->file('image')->store('images/rescue-images', 'public'),
            'created_by'        => $request->input('UserID'),
            'updated_by'        => '',
        ];
        try {
      
            $isPosted = PetRescueModel::create($data);

            if(!$isPosted):
                return response()->json(['message' => 'Failed to Post Pet'], 422);
            else:
                return response()->json(['data' => $data, 'msg' => 'Posted Successfully'], 201);
            endif;
        } catch(\Exception $e) {

            return response()->json(['msg' => $e->getMessage()], 500);
        }
    }
}
