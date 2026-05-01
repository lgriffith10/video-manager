<?php

namespace App\Shared\Infrastructure\Storage;

use App\Shared\Domain\Storage\FileStorageInterface;
use League\Flysystem\FilesystemOperator;

class FlysystemFileStorage implements FileStorageInterface
{
    public function __construct(
        private readonly FilesystemOperator $defaultStorage,
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
}
