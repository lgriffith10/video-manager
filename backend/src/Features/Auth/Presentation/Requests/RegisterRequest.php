<?php

namespace App\Features\Auth\Presentation\Requests;

use Symfony\Component\Validator\Constraints as Assert;

class RegisterRequest
{
    function __construct(
        #[Assert\NotBlank]
        #[Assert\Email]
        public readonly string $email,

        #[Assert\NotBlank]
        #[Assert\Uuid]
        public readonly string $id,
        
        #[Assert\NotBlank]
        public readonly string $password
    )
    {
    }
}
