<?php

    namespace App\Actions\InvestmentApp\Account;

    class StoreAccount {
        public function __construct(
            private ServiceAccount $serviceAccount
        ) {}
       
        public function execute(array $data): Account
        {
            $dto = AccountData::fromArray($data);
            return $this->serviceAccount->store($dto);
        }
    }
