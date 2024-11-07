<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostPet;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\rescue\PetRescueModel;
use App\Models\core\cam2rescue\CentralSequences;
use DB;

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

        DB::connection('mysql_cam2rescue_core')->beginTransaction();
        DB::connection('mysql')->beginTransaction();
        
        try {

            $sequenceNo = CentralSequences::increment('PetIdNo')->first(['PetIdNo']);
        
            $data = [
                'PetID'             => $sequenceNo->PetIdNo,
                'PetName'           => $request->input('petName'),
                'PetSex'            => $request->input('petGender'),
                'PetDescription'    => $request->input('petDescription'),
                'ImagePath'         => $request->file('image')->store('images', 'public')
            ];

            if(PostPet::create($data)) {

                $sequenceNo->where('Sequence_Id', 0)->update([
                    'Recently_Generated_PetID' => $sequenceNo->PetIdNo
                ]);
            }

            DB::connection('mysql_cam2rescue_core')->commit();
            DB::connection('mysql')->commit();

            return response()->json(['data' => $data], 201);

        } catch(\Exception $e) {

            DB::connection('mysql_cam2rescue_core')->rollBack();
            DB::connection('mysql')->rollBack();

            return response()->json(['data' => $data], 500);
        }
    }

    public function postRescue(Request $request) {
        
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

        DB::connection('mysql_cam2rescue_core')->beginTransaction();
        DB::connection('mysql')->beginTransaction();

        try {

            $sequenceNo = CentralSequences::increment('PetIdNo')->first(['PetIdNo']);

            $data = [
                'RescueId'          => $sequenceNo->PetIdNo,
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

            if(PetRescueModel::create($data)) {

                $sequenceNo->where('Sequence_Id', 0)->update([
                    'Recently_Generated_PetID' => $sequenceNo->PetIdNo,
                ]);
            }

            DB::connection('mysql_cam2rescue_core')->commit();
            DB::connection('mysql')->commit();

            return response()->json(['data' => $data, 'msg' => 'Posted Successfully'], 201);

        } catch(\Exception $e) {

            DB::connection('mysql_cam2rescue_core')->rollBack();
            DB::connection('mysql')->rollBack();

            return response()->json(['msg' => $e->getMessage()], 500);
        }
    }
}
