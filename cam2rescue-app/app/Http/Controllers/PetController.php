<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PetController extends Controller
{
    //

    public function getPetList() {
        try {
            $lists = DB::table('tblpet')->select('PetID', 'PetName', 'ImagePath')->get();
    
            if ($lists->isEmpty()) {
                return response()->json(['data' => [], 'message' => 'No Pets Found!'], 404);
            }
    
            return response()->json($lists, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
    
}
