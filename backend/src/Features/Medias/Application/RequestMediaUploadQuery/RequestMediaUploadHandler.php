<?php

namespace App\Features\Medias\Application\RequestMediaUploadQuery;

use App\Domain\Medias\Aggregates\Media;
use App\Domain\Medias\Repositories\MediaRepositoryInterface;
use App\Domain\Medias\ValueObjects\MediaId;
use App\Domain\Medias\ValueObjects\MediaName;
use App\Domain\Medias\ValueObjects\MimeType;
use App\Shared\Application\QueryResult;
use App\Shared\Application\UseCaseError;
use App\Shared\Domain\Storage\FileStorageInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler('query.bus')]
final readonly class RequestMediaUploadHandler
{
    public function __construct(
        private MediaRepositoryInterface $mediaRepository,
        private FileStorageInterface $fileStorage,
    ) {
    }

    public function __invoke(RequestMediaUploadQuery $query): QueryResult
    {
        $nameResult = MediaName::create($query->name);
        if ($nameResult->isErr()) {
            return QueryResult::err(UseCaseError::validationFailed($nameResult->unwrapErr()));
        }

        $mimeTypeResult = MimeType::create($query->mimeType);
        if ($mimeTypeResult->isErr()) {
            return QueryResult::err(UseCaseError::validationFailed($mimeTypeResult->unwrapErr()));
        }

        $mediaId = MediaId::generate();
        $storagePath = sprintf('medias/%s/%s', $mediaId->value, $query->name);

        $uploadUrl = $this->fileStorage->presignedUploadUrl($storagePath, $query->mimeType);

        $mediaResult = Media::create(
            id: $mediaId,
            name: $nameResult->unwrap(),
            mimeType: $mimeTypeResult->unwrap(),
            storagePath: $storagePath,
        );

        if ($mediaResult->isErr()) {
            return QueryResult::err(UseCaseError::unexpected($mediaResult->unwrapErr()));
        }

        $this->mediaRepository->save($mediaResult->unwrap());

        return QueryResult::ok(new RequestMediaUploadResult(
            mediaId: $mediaId->value,
            uploadUrl: $uploadUrl,
        ));
    }
}
