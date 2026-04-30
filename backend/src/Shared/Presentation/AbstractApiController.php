<?php

namespace App\Shared\Presentation;

use App\Shared\Application\CommandResult;
use App\Shared\Application\QueryResult;
use App\Shared\Application\UseCaseError;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

abstract class AbstractApiController extends AbstractController
{
    protected function respondWithCommand(CommandResult $result, int $successStatus = 204): JsonResponse
    {
        if ($result->isErr()) {
            return $this->errorResponse($result->unwrapErr());
        }

        return new JsonResponse(null, $successStatus);
    }

    private function errorResponse(UseCaseError $error): JsonResponse
    {
        return new JsonResponse(
            ['code' => $error->code, 'message' => $error->message, 'context' => $error->context],
            HttpErrorMapper::toStatus($error),
        );
    }

    protected function respondWithQuery(QueryResult $result, int $successStatus = 200): JsonResponse
    {
        if ($result->isErr()) {
            return $this->errorResponse($result->unwrapErr());
        }

        return new JsonResponse($result->unwrap(), $successStatus);
    }
}
