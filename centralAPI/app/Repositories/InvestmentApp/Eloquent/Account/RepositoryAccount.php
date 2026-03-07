<?php

    namespace App\Repositories\InvestmentApp\Eloquent\Account;

    class RepositoryAccount implements RepositoryAccountInterface {
        public function store(array $data): Account
        {
            return Account::create($data);
        }

        public function findByEmail(string $email): ?Account
        {
            return Account::where('email', $email)->first();
        }
        public function findById(int $id): ?Account
        {
            return Account::findOrFail($id);
        }
        public function update(int $id, array $data): bool
        {
           $account = Account::findOrFail($id);
           return $account->update($data);
        }
        public function delete(int $id): bool
        {
            $account = Account::findOrFail($id);
            return $account->delete($id);
        }
    }
