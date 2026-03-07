<?php

    namespace App\Services\InvestmentApp;

    class AccountService {
        public function __construct(
            private RepositoryAccount $repositoryAccount
        ) {}

        public function store(AccountData $dto): Account
        {
            return DB::connection('mysql_investment')->transaction(function () use ($dto) {
                return $this->repositoryAccount->create($dto->toArray());
            });
        }
    }

