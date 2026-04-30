<?php

namespace App\Shared\Presentation;


use App\Shared\Application\UseCaseError;

final class HttpErrorMapper
{
    public static function toStatus(UseCaseError $error): int
    {
        return match ($error->code) {
            'NOT_FOUND' => 404,
            'UNAUTHORIZED' => 401,
            'FORBIDDEN' => 403,
            'CONFLICT' => 409,
            'VALIDATION_FAILED' => 422,
            default => 500,
        };
    }
}
