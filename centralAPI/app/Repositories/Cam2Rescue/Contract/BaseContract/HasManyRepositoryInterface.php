<?php

    namespace App\Repositories\Cam2Rescue\Contract\BaseContract;

    interface HasManyRepositoryInterface {
        public function replaceByUserId(string $userId, array $rows): void;
    }