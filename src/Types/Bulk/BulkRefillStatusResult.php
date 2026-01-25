<?php
declare(strict_types=1);

namespace Dgp\Sdk\Types\Bulk;

use JsonSerializable;
use Dgp\Sdk\Support\DgpError;
use Dgp\Sdk\Types\Refill\RefillStatus;
use Dgp\Sdk\Support\Serialization\Arrayable;

final readonly class BulkRefillStatusResult implements Arrayable, JsonSerializable
{
    public function __construct(
        public string|int    $providerRefillId,
        public bool          $ok,
        public ?RefillStatus $status = null,
        public ?DgpError     $error = null,
    )
    {
    }

    public static function ok(string|int $providerRefillId, RefillStatus $status): self
    {
        return new self(
            providerRefillId: $providerRefillId,
            ok: true,
            status: $status,
            error: null,
        );
    }

    public static function fail(string|int $providerRefillId, DgpError $error): self
    {
        return new self(
            providerRefillId: $providerRefillId,
            ok: false,
            status: null,
            error: $error,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'provider_refill_id' => $this->providerRefillId,
            'ok' => $this->ok,
            'status' => $this->status?->toArray(),
            'error' => $this->error?->toArray(),
        ], static fn($v) => $v !== null);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}