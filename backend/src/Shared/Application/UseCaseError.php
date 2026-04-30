<?php

namespace App\Shared\Application;

final class UseCaseError
{
    private function __construct(
        public readonly string $code,
        public readonly string $message,
        public readonly array  $context = [],
    )
    {
    }

    public static function notFound(string $message, array $context = []): self
    {
        return new self('NOT_FOUND', $message, $context);
    }

    public static function unauthorized(string $message, array $context = []): self
    {
        return new self('UNAUTHORIZED', $message, $context);
    }

    public static function forbidden(string $message, array $context = []): self
    {
        return new self('FORBIDDEN', $message, $context);
    }

    public static function conflict(string $message, array $context = []): self
    {
        return new self('CONFLICT', $message, $context);
    }

    public static function validationFailed(string $message, array $context = []): self
    {
        return new self('VALIDATION_FAILED', $message, $context);
    }

    public static function unexpected(string $message, array $context = []): self
    {
        return new self('UNEXPECTED', $message, $context);
    }
}
