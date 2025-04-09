<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\core\cam2rescue\CentralSequences;
use App\Models\PostPet;
use App\Helpers\SystemCentralSequence;
use App\Helpers\PostPetData;
use DB;

class PostAdoption extends Controller
{
    //
    protected $sequences;
    protected $post_pet_data;

    public function __construct(SystemCentralSequence $sequences, PostPetData $post_pet_data) {
        $this->sequences = $sequences;
        $this->post_pet_data = $post_pet_data;
    }
    public function postPet(Request $request) {
        DB::connection('mysql_cam2rescue_core')->beginTransaction();
        DB::connection('mysql')->beginTransaction();
        $request->validate([
            'image'             => 'required|mimes:jpg,jpeg,png|max:2048',
            'petName'           => 'required|string|max:100',
            'petGender'         => 'required|string|max:10',
            'petDescription'    => 'required|string|max:1000'
        ]);
        try {
            $newPetId = $this->sequences->petIdCentralSequence();
            $data = $this->post_pet_data->postPetForAdoptionData($request, $newPetId);
            if(PostPet::updateOrCreate(['PetID' => $newPetId['seq_no']], $data)) {
                $this->sequences->updateRecentGeneratedPetId($newPetId);
            }
            DB::connection('mysql_cam2rescue_core')->commit();
            DB::connection('mysql')->commit();
            return response()->json(['data' => $data], 200);
        } catch(\Exception $e) {
            DB::connection('mysql_cam2rescue_core')->rollBack();
            DB::connection('mysql')->rollBack();
            return response()->json(['data' => $data], 500);
        }
    }

    public function removePost(Request $request, $id) {
        DB::connection('mysql')->beginTransaction();
        try{
            if(DB::connection('mysql')->table('pets')->where('PetId', $id)->delete()) {
                DB::connection('mysql')->commit();
                return response()->json(['message' => 'Post has been successfully deleted'], 200);
            } else {
                throw new \Exception('Failed to delete Post');
            }
        } catch(\Exception $e) {
            DB::connection('mysql')->rollBack();
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
