<?php 

    namespace App\Helpers;

    use App\Models\core\cam2rescue\CentralSequences;

    class SystemCentralSequence {
        
        public function userIdCentalSequence() {
            try {
                CentralSequences::where('code', 'USN')->increment('seq_no');
                $seq_no = CentralSequences::where('code', 'USN')->value('seq_no');
                return compact('seq_no');
            } catch(\Exception $e) {
                throw new \Exception('Failed to update or retrieve the sequence: ' . $e->getMessage());
            }
        }

        public function petIdCentralSequence() {
            try {
                CentralSequences::where('code', 'PSN')->increment('seq_no');
                $seq_no = CentralSequences::where('code', 'PSN')->value('seq_no');
                return compact('seq_no');
            } catch(\Exception $e) {
                throw new \Exception('Failed to generate new sequence : ' . $e->getMessage());
            }

        }

        public function rescueIdCentralSequence() {
            try {
                $seq_no = CentralSequences::where('code', 'RSN')->incremenAndGet('seq_no');
                return compact('seq_no');
            } catch(\Exception $e) {
                throw new \Exception('Failed to update or retrieve the sequence: ' . $e->getMessage());
            }
        }

        public function adoptionCentralSequence() {
            try {
                $seq_no = CentralSequences::where('code', 'PASN')->incrementAndGet('seq_no');
                return compact('seq_no');
            } catch(\Exception $e) {
                throw new \Exception('Failed to update or retrieve the sequence: ' . $e->getMessage());
            }
        }

        public function appointmentCentralSequences() {
            try {
                $seq_no = CentralSequences::where('code', 'APSN')->incrementAndGet('seq_no');
                return compact('seq_no');
            } catch(\Exception $e) {
                throw new \Exception('Failed to update or retrieve the sequence: ' . $e->getMessage());
            }
        }

        public function updateRecentGeneratedUserId($newUserId) {
            try {
                $is_updated_sequence = CentralSequences::where('code', 'USN')->update(['recent_generated' => (int)$newUserId['seq_no'] - 1 ]);
                return $is_updated_sequence;
            } catch(Exception $e) {
                throw new Exception('Failed to update recent generated Sequence with code USN ' . $e->getMessage());
            }
        }

        public function updateRecentGeneratedPetId($newPetId) {
            try {
                $is_updated_sequence = CentralSequences::where('code', 'PSN')->update(['recent_generated' => (int)$newPetId['seq_no'] - 1]);
                return $is_updated_sequence;
            } catch(\Exception $e) {
                throw new \Exception('Failed to update recent generated sequence with code PSN ', $e->getMessage());
            }
        }

        public function updateRecentGenratedAdoptionId() {
            try {
                $is_updated_sequence = CentralSequences::where('code', 'PASN')->update(['recent_generated' => (int)$newAdoptionId['seq-no'] - 1]);
                return $is_updated_sequence;
            } catch(\Exception $e) {
                throw new Exception('Failed to update recent_generated Sequence with code PASN ' . $e->getMessage());
            }
        }

        public function updateRecentGeneratedRescueId($newRescueId) {
            try {
                $is_updated_sequence = CentralSequences::where('code', 'RSN')->update(['recent_generated' => (int)$newRescueId['seq_no'] - 1]);
                return $is_updated_sequence;
            } catch(\Exception $e) {
                throw new Exception('Failed to update recent generated sequence with code RSN ' . $e->getMessage());
            }
        }

    }