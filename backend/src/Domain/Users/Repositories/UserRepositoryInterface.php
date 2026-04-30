<?php

namespace App\Domain\Users\Repositories;

use App\Domain\Users\Aggregates\UserAggregate;

interface UserRepositoryInterface
{
    public function findByEmail(string $email): ?UserAggregate;

    public function save(UserAggregate $aggregate): void;

    public function register(UserAggregate $aggregate, string $password): void;
}
