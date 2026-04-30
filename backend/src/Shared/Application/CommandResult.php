<?php

namespace App\Shared\Application;

use RuntimeException;

final class CommandResult
{
    private function __construct(
        private readonly bool          $success,
        private readonly ?UseCaseError $error,
    )
    {
    }

    public static function ok(): self
    {
        return new self(true, null);
    }

    public static function err(UseCaseError $error): self
    {
        return new self(false, $error);
    }

    public function isOk(): bool
    {
        return $this->success;
    }

    public function isErr(): bool
    {
        return !$this->success;
    }

    public function unwrapErr(): UseCaseError
    {
        if ($this->success) {
            throw new RuntimeException('Called unwrapErr() on an Ok result');
        }

        return $this->error;
    }
}
