<?php

namespace App\Features\Medias\Presentation;

use App\Features\Medias\Application\ConfirmMediaUploadCommand\ConfirmMediaUploadCommand;
use App\Shared\Application\CommandBusInterface;
use App\Shared\Presentation\AbstractApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ConfirmMediaUploadController extends AbstractApiController
{
    public function __construct(private readonly CommandBusInterface $commandBus)
    {
    }

    #[Route('/api/medias/{mediaId}/confirm', name: 'medias.confirm_upload', methods: ['POST'])]
    public function __invoke(string $mediaId): JsonResponse
    {
        $result = $this->commandBus->dispatch(new ConfirmMediaUploadCommand(
            mediaId: $mediaId,
        ));

        return $this->respondWithCommand($result, Response::HTTP_NO_CONTENT);
    }
}
