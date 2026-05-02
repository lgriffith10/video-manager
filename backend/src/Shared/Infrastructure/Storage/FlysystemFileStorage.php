<?php

namespace App\Shared\Infrastructure\Storage;

use App\Shared\Domain\Storage\FileStorageInterface;
use Aws\S3\S3Client;
use League\Flysystem\FilesystemOperator;

class FlysystemFileStorage implements FileStorageInterface
{
    public function __construct(
        private readonly FilesystemOperator $defaultStorage,
        private readonly S3Client $s3Client,
        private readonly string $s3Bucket,
    ) {}

    public function upload(string $path, mixed $content): void
    {
        if (is_resource($content)) {
            $this->defaultStorage->writeStream($path, $content);
        } else {
            $this->defaultStorage->write($path, $content);
        }
    }

    public function delete(string $path): void
    {
        $this->defaultStorage->delete($path);
    }

    public function exists(string $path): bool
    {
        return $this->defaultStorage->fileExists($path);
    }

    public function publicUrl(string $path): string
    {
        return $this->defaultStorage->publicUrl($path);
    }

    public function presignedUploadUrl(string $path, string $mimeType, int $ttlSeconds = 3600): string
    {
        $command = $this->s3Client->getCommand('PutObject', [
            'Bucket'      => $this->s3Bucket,
            'Key'         => $path,
            'ContentType' => $mimeType,
        ]);

        return (string) $this->s3Client->createPresignedRequest($command, "+{$ttlSeconds} seconds")->getUri();
    }

    public function presignedDownloadUrl(string $path, int $ttlSeconds = 3600): string
    {
        $command = $this->s3Client->getCommand('GetObject', [
            'Bucket' => $this->s3Bucket,
            'Key'    => $path,
        ]);

        return (string) $this->s3Client->createPresignedRequest($command, "+{$ttlSeconds} seconds")->getUri();
    }
}
