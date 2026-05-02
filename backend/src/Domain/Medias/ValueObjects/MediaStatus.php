<?php

namespace App\Domain\Medias\ValueObjects;

enum MediaStatus: string
{
    case Draft = 'draft';
    case Processing = 'processing';
    case Published = 'published';
    case Deleted = 'deleted';
}
