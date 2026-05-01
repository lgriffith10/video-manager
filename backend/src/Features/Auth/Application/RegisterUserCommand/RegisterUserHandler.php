<?php

namespace App\Features\Auth\Application\RegisterUserCommand;

use App\Domain\Users\Aggregates\User;
use App\Domain\Users\Repositories\UserRepositoryInterface;
use App\Domain\Users\ValueObjects\UserId;
use App\Shared\Application\CommandResult;
use App\Shared\Application\UseCaseError;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler('command.bus')]
final readonly class RegisterUserHandler
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
    )
    {
    }

    public function __invoke(RegisterUserCommand $command): CommandResult
    {
        if ($this->userRepository->findByEmail($command->email) !== null) {
            return CommandResult::err(
                UseCaseError::conflict('An account with that email already exists.')
            );
        }

        $userId = UserId::from($command->id);
        $userResult = User::create(id: $userId, email: $command->email);

        if ($userResult->isErr()) {
            return CommandResult::err(
                UseCaseError::conflict($userResult->unwrapErr())
            );
        }

        $this->userRepository->register($userResult->unwrap(), $command->password);

        return CommandResult::ok();
    }
}
