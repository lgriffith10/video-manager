<?php

namespace App\Features\Medias\Application\GetMediaQuery;

class GetMediaQuery
{
    public function __construct(
        public readonly string $mediaId,
    ) {
    }
}
