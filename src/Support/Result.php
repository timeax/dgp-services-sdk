<?php
declare(strict_types=1);

namespace Dgp\Sdk\Support;

use JsonSerializable;
use Throwable;
use Dgp\Sdk\Support\Serialization\Arrayable;

/**
 * @template T
 */
final readonly class Result implements Arrayable, JsonSerializable
{
    /**
     * @param T|null $value
     */
    private function __construct(
        private bool      $ok,
        private mixed     $value,
        private ?DgpError $error,
    ) {}

    /**
     * @template TOut
     * @param TOut|null $value
     * @return Result<TOut>
     */
    public static function ok(mixed $value = null): self
    {
        return new self(true, $value, null);
    }

    /**
     * @template TOut
     * @return Result<TOut>
     */
    public static function fail(DgpError $error): self
    {
        return new self(false, null, $error);
    }

    /**
     * @template TOut
     * @return Result<TOut>
     */
    public static function fromThrowable(Throwable $e, ?DgpErrorCode $fallback = null): self
    {
        return self::fail(DgpError::fromThrowable($e, $fallback));
    }

    public function isOk(): bool
    {
        return $this->ok;
    }

    public function isFailure(): bool
    {
        return !$this->ok;
    }

    /**
     * @return T|null
     */
    public function value(): mixed
    {
        return $this->value;
    }

    public function error(): ?DgpError
    {
        return $this->error;
    }

    /**
     * @param callable(T):mixed $fn
     * @return Result<mixed>
     */
    public function map(callable $fn): self
    {
        if (!$this->ok) {
            return self::fail($this->error ?? DgpError::unknown());
        }

        try {
            return self::ok($fn($this->value));
        } catch (Throwable $e) {
            return self::fromThrowable($e, DgpErrorCode::UNKNOWN);
        }
    }

    /**
     * @throws \RuntimeException
     * @return T
     */
    public function unwrap(): mixed
    {
        if ($this->ok) {
            return $this->value;
        }

        $err = $this->error;
        throw new \RuntimeException($err ? ($err->code->value . ': ' . $err->message) : 'Result failure');
    }

    /** @return array<string, mixed> */
    public function toArray(): array
    {
        return array_filter([
            'ok' => $this->ok,
            'value' => $this->ok ? $this->value : null,
            'error' => $this->ok ? null : ($this->error?->toArray()),
        ], static fn ($v) => $v !== null);
    }

    /** @return array<string, mixed> */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}