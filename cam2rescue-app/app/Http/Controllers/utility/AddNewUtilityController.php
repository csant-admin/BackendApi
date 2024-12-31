<?php

namespace App\Http\Controllers\utility;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\utility\TblColor;
use App\Models\utility\TblBarangay;
use App\Models\utility\TblInjury;
use App\Models\utility\TblOrganizationType;
use App\Models\utility\TblUrgency;
use App\Models\utility\TblPetIllness;
use DB;

class AddNewUtilityController extends Controller
{
    //
    public function addNewIllness(Request $request) {
        try {
            $addedIllness = TblPetIllness::create(['description' => $request->addNewUtility]);
            if(!$addedIllness) {
                return response()->json(['message' => 'Failed to Add Illness'], 500);
            }
            return response()->json(['message' => 'New illness was added'], 200);
        } catch(\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function addNewColor(Request $request) {
        try {
            $addedColor = TblColor::create(['description' => $request->addNewUtility]);
            if(!$addedColor) {
                return response()->json(['message' => 'Failed to add color'], 500);
            }
            return response()->json(['message' => 'New color was added'], 200);
        } catch(\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function addNewBarangay(Request $request) {
        try {
            $addedBarangay = TblBarangay::create(['description' => $request->addNewUtility]);
            if(!$addedBarangay) {
                return response()->json(['message' => 'Failed to add new barangay'], 500);
            }
            return response()->json(['message' => 'New barangay was added'], 200);
        } catch(\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function addNewInjury(Request $request) {
        try {
            $addedInjury = TblInjury::create(['description' => $request->addNewUtility]);
            if(!$addedInjury) {
                return response()->json(['message' => 'Failed to add new injury'], 500);
            }
            return response()->json(['message' => 'New injury was added'], 200);
        } catch(\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function addNewUrgency(Request $request) {
        try {
            $addedUrgency = TblUrgency::create(['description' => $request->addNewUtility]);
            if(!$addedUrgency) {
                return response()->json(['message' => 'Failed to add new urgency'], 500);
            }
            return response()->json(['message' => 'New urgency was added'], 200);
        } catch(\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
