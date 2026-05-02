<?php

namespace App\Shared\Infrastructure\Bus;

use App\Shared\Application\InfrastructureJobBusInterface;
use App\Shared\Application\InfrastructureJobInterface;
use Symfony\Component\Messenger\MessageBusInterface;

final class MessengerInfrastructureJobBus implements InfrastructureJobBusInterface
{
    public function __construct(
        private readonly MessageBusInterface $infrastructureJobBus,
    ) {
    }

    public function dispatch(InfrastructureJobInterface $job): void
    {
        $this->infrastructureJobBus->dispatch($job);
    }
}
