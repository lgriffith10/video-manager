<?php

namespace App\Domain\Medias\Repositories;

use App\Domain\Medias\Aggregates\Media;
use App\Domain\Medias\ValueObjects\MediaId;

interface MediaRepositoryInterface
{
    public function save(Media $media): void;

    public function findById(MediaId $id): ?Media;
}
