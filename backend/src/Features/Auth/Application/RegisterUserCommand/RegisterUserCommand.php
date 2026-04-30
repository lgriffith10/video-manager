<?php

namespace App\Features\Auth\Application\RegisterUserCommand;

class RegisterUserCommand
{
    public function __construct(
        public readonly string $id,
        public readonly string $email,
        public readonly string $password
    )
    {
    }
}
