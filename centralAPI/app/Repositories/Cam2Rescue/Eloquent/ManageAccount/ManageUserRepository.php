<?php

    namespace App\Repositories\Cam2Rescue\Eloquent\ManageAccount;

    class ManageUserRepository extends BaseHasOneRepository implements ManageUserRepositoryInterface {
        protected function getModel(): string {
            return User::class;
        }
    }