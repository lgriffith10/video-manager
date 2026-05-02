<?php

namespace App\Features\Auth\Application\Jobs;

use App\Shared\Application\InfrastructureJobInterface;

final readonly class SendWelcomeEmailJob implements InfrastructureJobInterface
{
    public function __construct(
        public string $userId,
        public string $email,
    ) {
    }
}
