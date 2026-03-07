<?php

    namespace App\Repositories\Cam2Rescue\Eloquent\ManageAccount;

    use App\Repositories\BaseHasOneRepository;
    use App\Repositories\Cam2Rescue\Contract\ManageAccount\ManageUserDetailRepositoryInterface;

    class ManageUserDetailRepository extends BaseHasOneRepository implements ManageUserDetailRepositoryInterface {
        protected function getModel(): string {
            return UserDetail::class;
        }
    }