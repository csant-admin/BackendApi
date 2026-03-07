<?php

    namespace App\Repositories\Cam2Rescue\Eloquent\BaseEloquent;

    abstract class BaseHasOneRepository implements HasOneRepositoryInterface {
        abstract protected function getModel(): string;
        public function upsertAUserAccount(string $userId, array $data): Model {
            $model = $this->modelClass();
            $data['user_id'] = $userId;
            return $model::updateOrCreate(
                ['user_id' => $userId],
                $data
            );
        }
    }
