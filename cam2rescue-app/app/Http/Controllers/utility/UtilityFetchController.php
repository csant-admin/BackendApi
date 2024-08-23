<?php

namespace App\Http\Controllers\utility;

use App\Http\Controllers\Controller;
use App\Models\utility\TblBarangay;
use App\Models\utility\TblColor;
use App\Models\utility\TblInjury;
use App\Models\utility\TblPetIllness;
use App\Models\utility\TblSex;
use App\Models\utility\TblUrgency;
use App\Models\utility\TblStatuses;
use App\Models\utility\TblUserType;
use App\Models\utility\TblOrganizationType;
use Illuminate\Http\Request;

class UtilityFetchController extends Controller
{
    //

    public function getBarangayList() {
        try {
            $data = TblBarangay::select('id', 'description')->orderBy('description', 'asc')->get();
            if($data->isEmpty()) {
                return response()->json([], 404);
            }
            $barangay = $data->map(function($item){
                return [
                    'id' => $item->id,
                    'description' => $item->description
                ];
            });
            return response()->json($barangay, 200);
        } catch(\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function getColorList() {
        try {
            $data = TblColor::select('id', 'description')->orderBy('description', 'asc')->get();
            if($data->isEmpty()) {
                return response()->json([], 404);
            }
            $color = $data->map(function($item){
                return [
                    'id' => $item->id,
                    'description' => $item->description
                ];
            });
            return response()->json($color, 200);
        } catch(\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function getInjuryList() {
        try {
            $data = TblInjury::select('id', 'description')->orderBy('description', 'asc')->get();
            if($data->isEmpty()) {
                return response()->json([], 404);
            }
            $injury = $data->map(function($item){
                return [
                    'id' => $item->id,
                    'description' => $item->description
                ];
            });
            return response()->json($injury, 200);
        } catch(\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function getPetIllnessList() {
        try {
            $data = TblPetIllness::select('id', 'description')->orderBy('description', 'asc')->get();
            if($data->isEmpty()) {
                return response()->json([], 404);
            }
            $petIllness = $data->map(function($item){
                return [
                    'id' => $item->id,
                    'description' => $item->description
                ];
            });
            return response()->json($petIllness, 200);
        } catch(\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function getSexList() {
        try {
            $data = TblSex::select('id', 'description')->orderBy('description', 'asc')->get();
            if($data->isEmpty()) {
                return response()->json([], 404);
            }
            $sex = $data->map(function($item){
                return [
                    'id' => $item->id,
                    'description' => $item->description
                ];
            });
            return response()->json($sex, 200);
        } catch(\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function getUrgencyList() {
        try {
            $data = TblUrgency::select('id', 'description')->orderBy('description', 'asc')->get();
            if($data->isEmpty()) {
                return response()->json([], 404);
            }
            $urgency = $data->map(function($item){
                return [
                    'id' => $item->id,
                    'description' => $item->description
                ];
            });
            return response()->json($urgency, 200);
        } catch(\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function getStatuses() {
        try {
            $data = TblStatuses::select('id', 'description')->orderBy('description', 'asc')->get();
            if($data->isEmpty()) {
                return response()->json([], 404);
            }
            $statuses = $data->map(function($item){
                return [
                    'id' => $item->id,
                    'description' => $item->description
                ];
            });
            return response()->json($statuses, 200);
        } catch(\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function getUserType() {
        try {
            $data = TblUserType::select('id', 'description')->orderBy('description', 'asc')->get();
            if($data->isEmpty()) {
                return response()->json([], 404);
            }
            $userType = $data->map(function($item){
                return [
                    'id' => $item->id,
                    'description' => $item->description
                ];
            });
            return response()->json( $userType, 200);
        } catch(\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function getOrganizationType() {
        try {
            $data = TblOrganizationType::select('id', 'description')->orderBy('description', 'asc')->get();
            if($data->isEmpty()) {
                return response()->json([], 404);
            }
            $organizationType = $data->map(function($item){
                return [
                    'id' => $item->id,
                    'description' => $item->description
                ];
            });
            return response()->json($organizationType, 200);
        } catch(\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

}
