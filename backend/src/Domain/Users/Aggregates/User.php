<?php

namespace App\Domain\Users\Aggregates;

use App\Domain\Users\ValueObjects\UserId;
use App\Shared\Domain\DomainResult;

final readonly class User
{
    public function __construct(
        public readonly UserId $id,
        public readonly string $email,
    )
    {
    }

    /**
     * @param UserId $id
     * @param string $email
     * @return DomainResult<User>
     */
    public static function create(UserId $id, string $email): DomainResult
    {
        return DomainResult::ok(new self(id: $id, email: $email));
    }
}
