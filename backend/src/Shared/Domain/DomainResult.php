<?php

namespace App\Shared\Domain;

use RuntimeException;

/**
 * @template T
 * @template E
 */
final class DomainResult
{
    private function __construct(
        private readonly bool  $success,
        private readonly mixed $value,
        private readonly mixed $error,
    )
    {
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
            throw new RuntimeException('Called unwrap() on an Err result');
        }

        return $this->value;
    }

    /**
     * @return E
     */
    public function unwrapErr(): mixed
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
     * @return self<U, E>
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
     * @return self<TVal, never>
     */
    public static function ok(mixed $value = null): self
    {
        return new self(true, $value, null);
    }

    /**
     * @template F
     * @param callable(E): F $fn
     * @return self<T, F>
     */
    public function mapErr(callable $fn): self
    {
        if ($this->success) {
            return $this;
        }

        return self::err($fn($this->error));
    }

    /**
     * @template TErr
     * @param TErr $error
     * @return self<never, TErr>
     */
    public static function err(mixed $error): self
    {
        return new self(false, null, $error);
    }

    /**
     * @template U
     * @param callable(T): self<U, E> $fn
     * @return self<U, E>
     */
    public function andThen(callable $fn): self
    {
        if (!$this->success) {
            return $this;
        }

        return $fn($this->value);
    }
}
