<?php

namespace App\Domain\Medias\ValueObjects;

use App\Shared\Domain\DomainResult;

final class MediaName
{
    private function __construct(
        public readonly string $value,
    ) {
    }

    public static function create(string $value): DomainResult
    {
        $trimmed = trim($value);

        if ($trimmed === '') {
            return DomainResult::err('Le nom du média ne peut pas être vide.');
        }

        if (mb_strlen($trimmed) > 255) {
            return DomainResult::err('Le nom du média ne peut pas dépasser 255 caractères.');
        }

        return DomainResult::ok(new self($trimmed));
    }
}
