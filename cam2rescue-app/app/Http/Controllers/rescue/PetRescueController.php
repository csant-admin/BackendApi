<?php

namespace App\Http\Controllers\rescue;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\rescue\PetRescueModel;
use Carbon\Carbon;
use DB;

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
                    'ImagePath'         => $item->ImagePath,
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
                    'created_at'        => date('Y-m-d g:i A', strtotime($item->created_at)),
                    // 'updated_at'        => $item->updated_at->format('Y-m-d g:i A')
                ];

            });

            return response()->json($rescueDataList, 200);
        } catch(\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }

    }

    public function approveRescue($id, Request $request) {
        DB::connection('mysql')->beginTransaction();
        try {
            $rescue = PetRescueModel::where('RescueId', $id)->first();

            if(!$rescue) {
                throw new Exception("Pet Not Found Error");
            }

            $validatedData = $request->validate([
                'RescueStatus'  => 'required|integer',
                'updated_by'    => 'required|string'
            ]);

            $data = [
                'RescueStatus'  => $validatedData['RescueStatus'],
                'updated_by'    => $validatedData['updated_by'],
                'FailedReason'  => $request['FailedReason'] ?? null
            ];

            $isSave = $rescue->update($data);
            if(!$isSave) {
                throw new \Exeption('An Error occur, please call cam2rescue team');
            }
            DB::connection('mysql')->commit();
            return response()->json(['message' => 'Rescue approved successfully'], 200);
        } catch (\Exception $e) {
            DB::connection('mysql')->rollBack();
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
