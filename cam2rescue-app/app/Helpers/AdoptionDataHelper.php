<?php

    namespace App\Helpers;

    use App\Helpers\SystemCentralSequence;
    use \Carbon\Carbon;

    class AdoptionDataHelper {

        public function adoptionData($request, $newAdoptionId) {
            return [
                'adoption_id'       => $newAdoptionId['seq_no'],
                'pet_id'            => $request->pet_id,
                'user_id'           => $request->user_id,
                'adoption_status'   => 0,
            ];
        }

        public function appointmentData($request, $newAdoptionId) {
            return [
                'adoption_id'           => $newAdoptionId['seq_no'],
                'appointment_date'      => $request->appointmentDetails_date,
                'appointment_time'      => $request->appointmentDetails_time,
                'appointment_with'      => $request->Orgname ?? $request->user_id,
                'appointment_status'    => 0
            ];
        }

        public function commonData($request) {
            return [
                'created_at'    => Carbon::now(),
                'created_by'    => $request->user_id,
                'updated_at'    => Carbon::now(),
                'updated_by'    => $request->user_id
            ];
        }

    }