<?php

namespace App\Http\Controllers\adoption;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\pet\Pet;
use App\Models\adoption\AdoptPet;
use \Carbon\Carbon;
use App\Models\core\cam2rescue\CentralSequences;
use App\Models\appointment\ScheduledAppointment;

class PetAdoptionController extends Controller
{
    //

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
            $adoptee = $request->Lastname . ' ' . $request->Firstname ?? null;

            CentralSequences::where('Sequence_Id', 0)->increment('Adoption_ID');

            $sequenceNo = CentralSequences::where('Sequence_Id', 0)->first(['Adoption_ID']);
            if (!$sequenceNo) {
                throw new \Exception("Failed to retrieve the incremented 'Adoption_ID'.");
            }

            $common_data = [
                'created_at'    => Carbon::now(),
                'created_by'    => $adoptee,
                'updated_at'    => Carbon::now(),
                'updated_by'    => $request->user_id
            ];

            $adoption_data = [
                'adoption_id'       => $sequenceNo->Adoption_ID,
                'pet_id'            => $request->pet_id,
                'user_id'           => $request->user_id,
                'adoption_status'   => 0,
            ];

            $appointment_data = [
                'adoption_id'           => $sequenceNo->Adoption_ID,
                'appointment_date'      => $request->appointmentDetails_date,
                'appointment_time'      => $request->appointmentDetails_time,
                'appointment_with'      => $request->Orgname ?? $request->user_id,
                'appointment_status'    => 0
            ];

            $isCreated_PetAdoption  = AdoptPet::create(array_merge($adoption_data, $common_data));
            $isCreated_Apointment   = ScheduledAppointment::create(array_merge($appointment_data, $common_data));

            if(!$isCreated_PetAdoption || !$isCreated_Apointment) {

                throw new \Exception("Failed to create either Pet Adoption or Appointment.");
            }

            CentralSequences::where('Sequence_Id', 0)->update([
                'Recently_Generated_Adoption_ID' => $sequenceNo->Adoption_ID
            ]);

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
