<?php

namespace App\Features\Medias\Infrastructure\Persistence;

use App\Domain\Medias\Aggregates\Media;
use App\Domain\Medias\ValueObjects\MediaId;
use App\Domain\Medias\ValueObjects\MediaName;
use App\Domain\Medias\ValueObjects\MediaStatus;
use App\Domain\Medias\ValueObjects\MimeType;

class MediaMapper
{
    public static function toDomain(MediaOrm $orm): Media
    {
        return new Media(
            id: MediaId::from($orm->id),
            name: MediaName::create($orm->name)->unwrap(),
            mimeType: MimeType::create($orm->mimeType)->unwrap(),
            storagePath: $orm->storagePath,
            status: MediaStatus::from($orm->status),
        );
    }

    public static function toOrm(Media $aggregate, ?MediaOrm $orm = null): MediaOrm
    {
        $orm ??= new MediaOrm();
        $orm->id = $aggregate->id->value;
        $orm->name = $aggregate->name->value;
        $orm->mimeType = $aggregate->mimeType->value;
        $orm->storagePath = $aggregate->storagePath;
        $orm->status = $aggregate->status->value;

        return $orm;
    }
}
