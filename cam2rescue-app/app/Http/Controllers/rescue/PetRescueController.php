<?php

namespace App\Http\Controllers\rescue;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\rescue\PetRescueModel;
use Carbon\Carbon;

class PetRescueController extends Controller
{
    //
    public function getRescueList() {
        try{
            $data = PetRescueModel::with(['userDetail','barangay', 'petColor', 'petSex', 'urgency', 'injury'])->get();
            if($data->isEmpty()) {
                return response()->json(['message' => 'No pets listed for rescue'], 404 );
            }

            $rescueDataList = $data->map(function($item) {
                return [
                    'RescueId'      => $item->RescueId,
                    'SBZ_Address'   => $item->SBZ_Address,
                    'BarangayId'    => $item->barangay->description,
                    'City'          => $item->City,
                    'PetColorId'    => $item->petColor->description,
                    'PetSexId'      => $item->petSex->description,
                    'UrgencyId'     => $item->urgency->description,
                    'InjuryId'      => $item->injury->description,
                    'Description'   => $item->Description,
                    'created_by'    => $item->userDetail->Lastname . ', ' . $item->userDetail->Firstname,
                    'updated_by'    => $item->updated_by,
                    'created_at'    => $item->created_at->format('Y-m-d g:i A'),
                    'updated_at'    => $item->updated_at->format('Y-m-d g:i A')
                ];

            });

            return response()->json($rescueDataList, 200);
        } catch(\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }

    }

    public function approveRescue($id) {
        try {
            $rescue = PetRescueModel::where('RescueId', $id)->firstOrFail();
            if(!$rescue) {
                return response()->json(['message' => "Cannot Find Pet with this ID $id"], 404);
            }
            $rescue->RescueStatus = 1;
            $rescue->updated_by = 'ApproverName'; 
            $rescue->updated_at = Carbon::now();
            
            $rescue->save();
    
            return response()->json(['message' => 'Rescue approved successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
