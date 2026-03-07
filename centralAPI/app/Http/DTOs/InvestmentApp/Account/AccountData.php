<?php

    namespace App\Http\DTOs\InvestmentApp\Account;

    class AccountData {
        public function __construct(
            public ?string $name,
            public ?string $email,
            public ?string $password,
        ) {}

        public static function fromArray(array $data): self
        {
            return new self(
                name:       $data['name'] ?? null,
                email:      $data['email'] ?? null,
                password:   $data['password'] ?? null,
            );
        }

        public function toArray(): array
        {
            return get_object_vars($this);
        }
    }


