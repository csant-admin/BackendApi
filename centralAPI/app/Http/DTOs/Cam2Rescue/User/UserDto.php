<?php

    namespace App\Http\DTOs\Cam2Rescue\User;

    class UserDto {
        public function __construct(
            public string $userId,
            public string $email,
            public string $password,
            public string $firstName,
            public string $lastName,
            public string $phoneNumber,
            public string $userType,
        ) {}

        public static function fromArray(): array {
            return [
                'userId' => $this->userId,
                'email' => $this->email,
                'password' => $this->password,
                'firstName' => $this->firstName,
                'lastName' => $this->lastName,
                'phoneNumber' => $this->phoneNumber,
                'userType' => $this->userType
            ];
        }
        public function toArray()
        {
            return get_object_vars($this);
        }
    }
