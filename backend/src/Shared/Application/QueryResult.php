<?php

namespace App\Shared\Application;

use RuntimeException;

/**
 * @template T
 */
final class QueryResult
{
    private function __construct(
        private readonly bool          $success,
        private readonly mixed         $value,
        private readonly ?UseCaseError $error,
    )
    {
    }

    /**
     * @return self<never>
     */
    public static function err(UseCaseError $error): self
    {
        return new self(false, null, $error);
    }

    public function isOk(): bool
    {
        return $this->success;
    }

    public function isErr(): bool
    {
        return !$this->success;
    }

    /**
     * @return T
     */
    public function unwrap(): mixed
    {
        if (!$this->success) {
            throw new RuntimeException("Called unwrap() on an Err result: {$this->error->message}");
        }

        return $this->value;
    }

    public function unwrapErr(): UseCaseError
    {
        if ($this->success) {
            throw new RuntimeException('Called unwrapErr() on an Ok result');
        }

        return $this->error;
    }

    /**
     * @param T $default
     * @return T
     */
    public function unwrapOr(mixed $default): mixed
    {
        return $this->success ? $this->value : $default;
    }

    /**
     * @template U
     * @param callable(T): U $fn
     * @return self<U>
     */
    public function map(callable $fn): self
    {
        if (!$this->success) {
            return $this;
        }

        return self::ok($fn($this->value));
    }

    /**
     * @template TVal
     * @param TVal $value
     * @return self<TVal>
     */
    public static function ok(mixed $value): self
    {
        return new self(true, $value, null);
    }

    /**
     * @template U
     * @param callable(T): self<U> $fn
     * @return self<U>
     */
    public function andThen(callable $fn): self
    {
        if (!$this->success) {
            return $this;
        }

        return $fn($this->value);
    }
}
