<?php

    namespace App\Repositories\Cam2Rescue\Contract\BaseContract;

    interface HasOneRepositoryInterface {
        public function upsertAUserAccount(string $userId, array $data): Model;
        public function findAUserAccount(string $userId): Model;
    }