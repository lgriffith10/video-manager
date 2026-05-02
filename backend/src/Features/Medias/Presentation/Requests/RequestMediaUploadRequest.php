<?php

namespace App\Features\Medias\Presentation\Requests;

use Symfony\Component\Validator\Constraints as Assert;

class RequestMediaUploadRequest
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Length(max: 255)]
        public readonly string $name,

        #[Assert\NotBlank]
        public readonly string $mimeType,
    ) {
    }
}
