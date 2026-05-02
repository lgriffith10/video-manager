<?php

namespace App\Shared\Domain\Storage;

interface FileStorageInterface
{
    public function upload(string $path, mixed $content): void;

    public function delete(string $path): void;

    public function exists(string $path): bool;

    public function publicUrl(string $path): string;

    public function presignedUploadUrl(string $path, string $mimeType, int $ttlSeconds = 3600): string;

    public function presignedDownloadUrl(string $path, int $ttlSeconds = 3600): string;
}
