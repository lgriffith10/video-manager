<?php

namespace App\Domain\Medias\Aggregates;

use App\Domain\Medias\ValueObjects\MediaId;
use App\Domain\Medias\ValueObjects\MediaName;
use App\Domain\Medias\ValueObjects\MediaStatus;
use App\Domain\Medias\ValueObjects\MimeType;
use App\Shared\Domain\DomainResult;

final readonly class Media
{
    public function __construct(
        public readonly MediaId $id,
        public readonly MediaName $name,
        public readonly MimeType $mimeType,
        public readonly string $storagePath,
        public readonly MediaStatus $status,
    ) {
    }

    public function confirm(): self
    {
        return new self(
            id: $this->id,
            name: $this->name,
            mimeType: $this->mimeType,
            storagePath: $this->storagePath,
            status: MediaStatus::Published,
        );
    }

    /**
     * @return DomainResult<Media>
     */
    public static function create(
        MediaId $id,
        MediaName $name,
        MimeType $mimeType,
        string $storagePath,
    ): DomainResult {
        return DomainResult::ok(new self(
            id: $id,
            name: $name,
            mimeType: $mimeType,
            storagePath: $storagePath,
            status: MediaStatus::Draft,
        ));
    }
}
