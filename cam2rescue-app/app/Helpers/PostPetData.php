<?php

namespace App\Helpers;

class PostPetData {
    public function postPetForAdoptionData($request, $newPetId) {
        return [
            'PetID'             => $newPetId['seq_no'],
            'PetName'           => $request->input('petName'),
            'PetSex'            => $request->input('petGender'),
            'PetDescription'    => $request->input('petDescription'),
            'ImagePath'         => $request->file('image')->store('images', 'public')
        ];
    }

    public function postPetForRescueData($request, $newRescueId) {
        return [
            'RescueId'          => $newRescueId['seq_no'],
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
            'created_at'        => Carbon::now(),
            'updated_by'        => $request->input('UserID'),
            'updated_at'        => Carbon::now()
        ];
    }
}