<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\rescue\PetRescueModel;
use App\Models\core\cam2rescue\CentralSequences;
use App\Helpers\SystemCentralSequence;
use App\Helpers\PostPetData;

class PostRescue extends Controller
{
    //
    protected $sequences;
    protected $post_pet_data;

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
            $newRescueId = $this->sequences->rescueIdCentralSequence();
            $data = $this->post_pet_data->postPetForRescueData($request, $newRescueId);
            if(PetRescueModel::updateOrCreate(['PetId' => $request->input['rescueId']], $data)) {
                $this->sequences->updateRecentGeneratedRescueId($newRescueId);
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

    public function removePost(Request $request, $id) {
        DB::connection('mysql')->beginTransaction();
        try {
            if(DB::connection('mysql')->table('tblRescue')->where('RescueId', $id)->delete()) {
                DB::connection('mysql')->commit();
                return response()->json(['message' => 'Post has been successfully deleted'], 200);
            } else {
                throw new \Exception('Failed to delete post');
            }
        } catch(\Exception $e) {
            DB::connection('mysql')->rollBack();
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
