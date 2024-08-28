<?php

namespace App\Http\Controllers\rescue;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\rescue\PetRescueModel;

class PetRescueController extends Controller
{
    //
    public function getRescueList() {
        try{
            $rescueDataList = PetRescueModel::all();
            if($rescueDataList->isEmpty()) {
                return response()->json(['message' => 'No pets listed for rescue'], 404 );
            }

            return response()->json($rescueDataList, 200);
        } catch(\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }

    }
}
