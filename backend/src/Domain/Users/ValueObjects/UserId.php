<?php

namespace App\Domain\Users\ValueObjects;

use Symfony\Component\Uid\Uuid;

final class UserId
{
    private function __construct(
        public readonly string $value,
    )
    {
    }

    public static function generate(): self
    {
        return new self(Uuid::v4()->toRfc4122());
    }

    public static function create(string $uuid): self
    {
        return new self(value: $uuid);
    }

    public static function from(string $value): self
    {
        return new self($value);
    }
}
