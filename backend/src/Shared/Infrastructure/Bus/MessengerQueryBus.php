<?php

namespace App\Shared\Infrastructure\Bus;

use App\Shared\Application\QueryBusInterface;
use App\Shared\Application\QueryResult;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;

final class MessengerQueryBus implements QueryBusInterface
{
    public function __construct(
        private readonly MessageBusInterface $queryBus,
    )
    {
    }

    public function ask(object $query): QueryResult
    {
        try {
            $envelope = $this->queryBus->dispatch($query);
            $stamp = $envelope->last(HandledStamp::class);

            return $stamp->getResult();
        } catch (HandlerFailedException $e) {
            throw $e->getPrevious() ?? $e;
        }
    }
}
