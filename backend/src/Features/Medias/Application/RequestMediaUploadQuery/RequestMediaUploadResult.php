<?php

namespace App\Features\Medias\Application\RequestMediaUploadQuery;

class RequestMediaUploadResult
{
    public function __construct(
        public readonly string $mediaId,
        public readonly string $uploadUrl,
    ) {
    }
}
