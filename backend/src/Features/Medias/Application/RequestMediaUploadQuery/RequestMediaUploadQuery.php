<?php

namespace App\Features\Medias\Application\RequestMediaUploadQuery;

class RequestMediaUploadQuery
{
    public function __construct(
        public readonly string $name,
        public readonly string $mimeType,
    ) {
    }
}
