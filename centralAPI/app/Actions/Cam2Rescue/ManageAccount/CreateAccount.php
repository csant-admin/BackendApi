<?php

    namespace App\Actions\Cam2Rescue\ManageAccount;

    class CreateAccount {
        public function __construct(
            private BenefitsIdHasOneRepositoryInterface $benefitsIdHasOneRepository
        ) {}
    }