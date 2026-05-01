<?php

namespace App\Domain\Users\Repositories;

use App\Domain\Users\Aggregates\User;

interface UserRepositoryInterface
{
    public function findByEmail(string $email): ?User;

    public function save(User $aggregate): void;

    public function register(User $aggregate, string $password): void;
}
