<?php

namespace App\Http\Controllers\adoption;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\pet\Pet;
use App\Models\adoption\AdoptPet;
use \Carbon\Carbon;
use App\Models\appointment\ScheduledAppointment;
use App\Helpers\SystemCentralSequence;

class PetAdoptionController extends Controller
{
    //
    protected $sequences;
    protected $adoption_data;

    public function __construct(SystemCentralSequence $sequences, AdoptionDataHeper $adoption_data) {
        $this->sequences = $sequences;
        $this->adoption_data = $adoption_data;
    }

    public function getPetDetail($id) {
        try {
            $data = Pet::where('PetID', $id)->get();
            if($data->isEmpty()) {
                return response()->json([
                    'message' => 'No Pet Found with this Id : ' . $id
                ], 404);
            }
            return response()->json($data, 200);
        } catch(\Exception $e) {
            return response()->json([
                'message' => 'Error!' . $e->getMessage()
            ], 500);
        }
    } 

    public function adoptPet(Request $request) {
        DB::connection('mysql_cam2rescue_core')->beginTransaction();
        DB::connection('mysql')->beginTransaction();
        try{
            $newAdoptionId = $this->sequences->adoptionCentralSequence();
            if(!$newAdoptionId) {
                throw new Exception('Failed to get new user ID');
            }
            $adoption_data      = $this->adoption_data->adoptionData($request, $newAdoptionId);
            $appointment_data   = $this->adoption_data->appointmentData($request, $newAdoptionId);
            $common_data        = $this->adoption_data->commonData($request);

            $isCreated_PetAdoption  = AdoptPet::create(array_merge($adoption_data, $common_data));
            $isCreated_Apointment   = ScheduledAppointment::create(array_merge($appointment_data, $common_data));

            if(!$isCreated_PetAdoption || !$isCreated_Apointment) {
                throw new \Exception("Failed to create either Pet Adoption or Appointment.");
            }
            $this->sequences->updateRecentGenratedAdoptionId($newAdoptionId);
            DB::connection('mysql_cam2rescue_core')->commit();
            DB::connection('mysql')->commit();
            return response()->json([
                'message' => 'Adoption has been successfully created'
            ], 200);
        } catch(\Exception $e) {

            DB::connection('mysql_cam2rescue_core')->rollBack();
            DB::connection('mysql')->rollBack();

            return response()->json([
                'message'       => 'An Error Occur, Please Call Cam2Rescue Team',
                'error_msg'     => 'Error!' . $e->getMessage()
            ], 500);
        }
    }
}
