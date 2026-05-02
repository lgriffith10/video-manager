<?php

namespace App\Features\Medias\Application\ConfirmMediaUploadCommand;

use App\Domain\Medias\Repositories\MediaRepositoryInterface;
use App\Domain\Medias\ValueObjects\MediaId;
use App\Shared\Application\CommandResult;
use App\Shared\Application\UseCaseError;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler('command.bus')]
final readonly class ConfirmMediaUploadHandler
{
    public function __construct(
        private MediaRepositoryInterface $mediaRepository,
    ) {
    }

    public function __invoke(ConfirmMediaUploadCommand $command): CommandResult
    {
        $media = $this->mediaRepository->findById(MediaId::from($command->mediaId));

        if ($media === null) {
            return CommandResult::err(UseCaseError::notFound('Media not found.'));
        }

        $this->mediaRepository->save($media->confirm());

        return CommandResult::ok();
    }
}
