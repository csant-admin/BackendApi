<?php

    namespace App\Services\Cam2Rescue\ManageAccount;    

    class ManageAccountService {
        public function __construct(
            private BenefitsIdHasOneRepositoryInterface $benefitsIdHasOneRepository
        ) {}
    }