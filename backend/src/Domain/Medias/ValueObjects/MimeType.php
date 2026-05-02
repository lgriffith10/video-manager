<?php

namespace App\Domain\Medias\ValueObjects;

use App\Shared\Domain\DomainResult;

final class MimeType
{
    private const ALLOWED = [
        'image/jpeg',
        'image/png',
        'image/gif',
        'image/webp',
        'video/mp4',
        'video/avi',
        'video/quicktime',
        'video/webm',
        'application/pdf',
        'text/plain',
    ];

    private function __construct(
        public readonly string $value,
    ) {
    }

    public static function create(string $value): DomainResult
    {
        if (!in_array($value, self::ALLOWED, true)) {
            return DomainResult::err(sprintf('Le type MIME "%s" n\'est pas supporté.', $value));
        }

        return DomainResult::ok(new self($value));
    }

    public function isImage(): bool
    {
        return str_starts_with($this->value, 'image/');
    }

    public function isVideo(): bool
    {
        return str_starts_with($this->value, 'video/');
    }

    public function isPdf(): bool
    {
        return $this->value === 'application/pdf';
    }
}
