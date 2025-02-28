<?php

namespace App\Http\Controllers\Pets;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ListOfPets extends Controller
{
    //
    public function list() {
        try {
            $lists = DB::table('tblpet')->select('PetID', 'PetName', 'PetDescription', 'ImagePath')->get();
    
            if (!$lists) {
                return response()->json(['data' => [], 'message' => 'No Pets Found!'], 404);
            }
    
            return response()->json($lists, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function viewPetDetails(Request $request) {
        $id = $request->input('petID');
        try {
            $lists = DB::table('tblpet')->select('PetID', 'PetName', 'PetSex', 'PetDescription', 'ImagePath')->where('PetID', $id)->get();
    
            if ($lists->isEmpty()) {
                return response()->json(['data' => [], 'message' => 'No Pets Found!'], 404);
            }
    
            return response()->json($lists, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
