<?php

namespace App\Features\Medias\Application\ConfirmMediaUploadCommand;

class ConfirmMediaUploadCommand
{
    public function __construct(
        public readonly string $mediaId,
    ) {
    }
}
