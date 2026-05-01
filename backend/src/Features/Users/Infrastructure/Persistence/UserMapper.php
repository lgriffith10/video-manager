<?php

namespace App\Features\Users\Infrastructure\Persistence;

use App\Domain\Users\Aggregates\User;
use App\Domain\Users\ValueObjects\UserId;

class UserMapper
{
    public static function toDomain(UserOrm $orm): User
    {
        return new User(
            id: UserId::from($orm->id),
            email: $orm->email,
        );
    }

    public static function toOrm(User $aggregate, ?UserOrm $orm = null): UserOrm
    {
        $orm ??= new UserOrm();
        $orm->id = $aggregate->id->value;
        $orm->email = $aggregate->email;

        return $orm;
    }
}
