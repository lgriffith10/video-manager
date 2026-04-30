<?php

namespace App\Features\Auth\Presentation\Requests;

use Symfony\Component\Validator\Constraints as Assert;

class LoginRequest
{
    function __construct(
        #[Assert\NotBlank]
        #[Assert\Email]
        public readonly string $email,
        #[Assert\NotBlank]
        public readonly string $password
    )
    {
    }
}
