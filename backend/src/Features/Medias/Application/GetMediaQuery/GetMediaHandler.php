<?php

namespace App\Features\Medias\Application\GetMediaQuery;

use App\Domain\Medias\Repositories\MediaRepositoryInterface;
use App\Domain\Medias\ValueObjects\MediaId;
use App\Shared\Application\QueryResult;
use App\Shared\Application\UseCaseError;
use App\Shared\Domain\Storage\FileStorageInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler('query.bus')]
final readonly class GetMediaHandler
{
    public function __construct(
        private MediaRepositoryInterface $mediaRepository,
        private FileStorageInterface $fileStorage,
    ) {
    }

    public function __invoke(GetMediaQuery $query): QueryResult
    {
        $media = $this->mediaRepository->findById(MediaId::from($query->mediaId));

        if ($media === null) {
            return QueryResult::err(UseCaseError::notFound('Media not found.'));
        }

        $url = $this->fileStorage->presignedDownloadUrl($media->storagePath);

        return QueryResult::ok(new GetMediaResult(
            mediaId: $media->id->value,
            name: $media->name->value,
            mimeType: $media->mimeType->value,
            status: $media->status->value,
            url: $url,
        ));
    }
}
