<?php

namespace App\Domain\Users\Aggregates;

use App\Domain\Users\ValueObjects\UserId;

final readonly class UserAggregate
{
    public function __construct(
        public readonly UserId $id,
        public readonly string $email,
    )
    {
    }

    public static function create(UserId $id, string $email): self
    {
        return new self(
            id: $id,
            email: $email,
        );
    }
}
