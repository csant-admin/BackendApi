<?php

    namespace App\Repositories\InvestmentApp\Contracts\Account;

    interface RepositoryAccountInterface {
        public function store(array $data): Account;

        public function findByEmail(string $email): ?Account;

        public function findById(int $id): ?Account;

        public function update(int $id, array $data): void;

        public function delete(int $id): void;
        
    }

