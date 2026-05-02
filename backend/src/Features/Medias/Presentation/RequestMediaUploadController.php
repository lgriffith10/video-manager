<?php

namespace App\Features\Medias\Presentation;

use App\Features\Medias\Application\RequestMediaUploadQuery\RequestMediaUploadQuery;
use App\Features\Medias\Presentation\Requests\RequestMediaUploadRequest;
use App\Shared\Application\QueryBusInterface;
use App\Shared\Presentation\AbstractApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

class RequestMediaUploadController extends AbstractApiController
{
    public function __construct(private readonly QueryBusInterface $queryBus)
    {
    }

    #[Route('/api/medias/request-upload', name: 'medias.request_upload', methods: ['POST'])]
    public function __invoke(#[MapRequestPayload] RequestMediaUploadRequest $request): JsonResponse
    {
        $result = $this->queryBus->ask(new RequestMediaUploadQuery(
            name: $request->name,
            mimeType: $request->mimeType,
        ));

        return $this->respondWithQuery($result, Response::HTTP_CREATED);
    }
}
