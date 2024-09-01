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
            $data = PetRescueModel::with(['userDetail','barangay', 'petColor', 'petSex', 'urgency', 'injury', 'rescueStatuses'])->orderBy('RescueStatus', 'asc')->get();

            if($data->isEmpty()) {
                return response()->json(['message' => 'No pets listed for rescue'], 404 );
            }

            $rescueDataList = $data->map(function($item) {
                return [
                    'RescueId'          => $item->RescueId,
                    'Address'           => $item->SBZ_Address . ' ' . $item->barangay->description . ', ' . $item->City,
                    'BarangayId'        => $item->barangay->description,
                    'City'              => $item->City,
                    'PetColorId'        => $item->petColor->description,
                    'PetSexId'          => $item->petSex->description,
                    'ImportantNote'     => $item->urgency->description .', '. $item->injury->description,
                    'InjuryId'          => $item->injury->description,
                    'Description'       => $item->Description,
                    'RescueStatus'      => $item->rescueStatuses->description,
                    'RescueStatusId'    => $item->rescueStatuses->StatusId,
                    'created_by'        => $item->userDetail->Lastname . ', ' . $item->userDetail->Firstname,
                    'updated_by'        => $item->updated_by ? $item->userDetail->Lastname . ', ' . $item->userDetail->Firstname : "-",
                    'created_at'        => $item->created_at->format('Y-m-d g:i A'),
                    'updated_at'        => $item->updated_at->format('Y-m-d g:i A')
                ];

            });

            return response()->json($rescueDataList, 200);
        } catch(\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }

    }

    public function approveRescue($id, Request $request) {
        try {
            $rescue = PetRescueModel::where('RescueId', $id)->firstOrFail();

            $validatedData = $request->validate([
                'RescueStatus'  => 'required|integer',
                'updated_by'    => 'required|string',
            ]);

            $rescue->RescueStatus = $validatedData['RescueStatus'];
            $rescue->updated_by = $validatedData['updated_by'];
            $rescue->FailedReason = $request['FailedReason'] ?? null;
            $rescue->updated_at = Carbon::now();
            
            $rescue->save();
    
            return response()->json(['message' => 'Rescue approved successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
