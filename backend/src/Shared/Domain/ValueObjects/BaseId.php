<?php

namespace App\Shared\Domain\ValueObjects;

use Symfony\Component\Uid\Uuid;

abstract class BaseId
{
    protected function __construct(
        public readonly string $value,
    ) {
    }

    public static function generate(): static
    {
        return new static(Uuid::v4()->toRfc4122());
    }

    public static function create(string $uuid): static
    {
        return new static(value: $uuid);
    }

    public static function from(string $value): static
    {
        return new static($value);
    }

    public function equals(self $other): bool
    {
        return $this->value === $other->value;
    }
}
