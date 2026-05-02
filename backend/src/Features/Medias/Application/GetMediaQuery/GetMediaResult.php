<?php

namespace App\Features\Medias\Application\GetMediaQuery;

class GetMediaResult
{
    public function __construct(
        public readonly string $mediaId,
        public readonly string $name,
        public readonly string $mimeType,
        public readonly string $status,
        public readonly string $url,
    ) {
    }
}
