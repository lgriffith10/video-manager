<?php

namespace App\Features\Auth\Presentation;

use App\Shared\Application\CommandBusInterface;
use App\Shared\Presentation\AbstractApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/auth/login', name: 'auth.login')]
class LoginController extends AbstractApiController
{
    function __construct(private readonly CommandBusInterface $commandBus)
    {

    }

    #[Route(methods: ['GET'])]
    public function __invoke(): JsonResponse
    {
        return new JsonResponse([
            "luciano" => "test"
        ]);
    }
}
