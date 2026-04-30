<?php

namespace App\Shared\Infrastructure\Bus;

use App\Shared\Application\CommandBusInterface;
use App\Shared\Application\CommandResult;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;

final class MessengerCommandBus implements CommandBusInterface
{
    public function __construct(
        private readonly MessageBusInterface $commandBus,
    )
    {
    }

    public function dispatch(object $command): CommandResult
    {
        try {
            $envelope = $this->commandBus->dispatch($command);
            $stamp = $envelope->last(HandledStamp::class);

            return $stamp?->getResult() ?? CommandResult::ok();
        } catch (HandlerFailedException $e) {
            throw $e->getPrevious() ?? $e;
        }
    }
}
