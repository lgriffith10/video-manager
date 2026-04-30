<?php

namespace App\Features\Auth\Presentation;

use App\Features\Auth\Application\RegisterUserCommand\RegisterUserCommand;
use App\Features\Auth\Presentation\Requests\RegisterRequest;
use App\Shared\Application\CommandBusInterface;
use App\Shared\Presentation\AbstractApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

class RegisterController extends AbstractApiController
{
    public function __construct(private readonly CommandBusInterface $commandBus)
    {
    }

    #[Route('/api/auth/register', name: 'auth.register', methods: ['POST'])]
    public function __invoke(#[MapRequestPayload] RegisterRequest $request): JsonResponse
    {
        $result = $this->commandBus->dispatch(new RegisterUserCommand(
            id: $request->id,
            email: $request->email,
            password: $request->password
        ));

        return $this->respondWithCommand($result, Response::HTTP_CREATED);
    }
}
