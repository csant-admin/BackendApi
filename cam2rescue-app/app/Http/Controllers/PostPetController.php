<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostPet;

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
        $petId = $request->input('petId');
        $petName = $request->input('petName');
        $petSex = $request->input('petGender');
        $petDescription = $request->input('petDescription');
        $path = $request->file('image')->store('images', 'public');

        PostPet::create(['PetID' => $petId, 'PetName' => $petName, 'PetSex' => $petSex, 'PetDescription' => $petDescription, 'ImagePath' => $path]);

        return response()->json(['path' => $path], 201);
    }
}
