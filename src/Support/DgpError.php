<?php
declare(strict_types=1);

namespace Dgp\Sdk\Support;

use JsonSerializable;
use Throwable;
use Dgp\Sdk\Support\Serialization\Arrayable;

final readonly class DgpError implements Arrayable, JsonSerializable
{
    public function __construct(
        public DgpErrorCode $code,
        public string       $message,
        /** @var array<string, mixed>|null */
        public ?array       $details = null,
        public ?string      $providerCode = null,
        public ?int         $httpStatus = null,
        public ?int         $retryAfterSeconds = null,
        /** @var array<string, mixed>|null */
        public ?array       $meta = null,
    ) {}

    public static function unknown(string $message = 'Unknown error', ?Throwable $e = null): self
    {
        return new self(
            DgpErrorCode::UNKNOWN,
            $message,
            $e ? ['exception' => $e::class, 'exception_message' => $e->getMessage()] : null
        );
    }

    public static function fromThrowable(Throwable $e, ?DgpErrorCode $fallback = null): self
    {
        $code = $fallback ?? DgpErrorCode::UNKNOWN;

        return new self(
            $code,
            $e->getMessage() ?: $code->value,
            [
                'exception' => $e::class,
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ],
        );
    }

    /** @return array<string, mixed> */
    public function toArray(): array
    {
        return array_filter([
            'code' => $this->code->value,
            'message' => $this->message,
            'details' => $this->details,
            'provider_code' => $this->providerCode,
            'http_status' => $this->httpStatus,
            'retry_after_seconds' => $this->retryAfterSeconds,
            'meta' => $this->meta,
        ], static fn ($v) => $v !== null);
    }

    /** @return array<string, mixed> */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}