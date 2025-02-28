<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PostPet;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\rescue\PetRescueModel;
use App\Models\core\cam2rescue\CentralSequences;
use App\Helpers\SystemCentralSequence;
use App\Helpers\PostPetData;

class PostController extends Controller
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
            'petId'             => 'required|string|max:50',
            'image'             => 'required|mimes:jpg,jpeg,png|max:2048',
            'petName'           => 'required|string|max:100',
            'petGender'         => 'required|string|max:10',
            'petDescription'    => 'required|string|max:1000'
        ]);
        try {
            $newPetId = $this->sequences->petIdCentralSequence();
            $data = $this->post_pet_data->postPetForAdoptionData($request, $newPetId);
            if(PostPet::create($data)) {
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
            if(PetRescueModel::create($data)) {
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
}
