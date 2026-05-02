<?php

namespace App\Features\Medias\Presentation;

use App\Features\Medias\Application\GetMediaQuery\GetMediaQuery;
use App\Shared\Application\QueryBusInterface;
use App\Shared\Presentation\AbstractApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class GetMediaController extends AbstractApiController
{
    public function __construct(private readonly QueryBusInterface $queryBus)
    {
    }

    #[Route('/api/medias/{mediaId}', name: 'medias.get', methods: ['GET'])]
    public function __invoke(string $mediaId): JsonResponse
    {
        $result = $this->queryBus->ask(new GetMediaQuery(mediaId: $mediaId));

        return $this->respondWithQuery($result);
    }
}
