<?php
declare(strict_types=1);

namespace Dgp\Sdk\Types\Bulk;

use JsonSerializable;
use Dgp\Sdk\Support\DgpError;
use Dgp\Sdk\Types\Refill\RefillRef;
use Dgp\Sdk\Support\Serialization\Arrayable;

final readonly class BulkCreateRefillResult implements Arrayable, JsonSerializable
{
    public function __construct(
        public string|int $providerOrderId,
        public bool       $ok,
        public ?RefillRef $refillRef = null,
        public ?DgpError  $error = null,
    )
    {
    }

    public static function ok(string|int $providerOrderId, RefillRef $refillRef): self
    {
        return new self(
            providerOrderId: $providerOrderId,
            ok: true,
            refillRef: $refillRef,
            error: null,
        );
    }

    public static function fail(string|int $providerOrderId, DgpError $error): self
    {
        return new self(
            providerOrderId: $providerOrderId,
            ok: false,
            refillRef: null,
            error: $error,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'provider_order_id' => $this->providerOrderId,
            'ok' => $this->ok,
            'refill_ref' => $this->refillRef?->toArray(),
            'error' => $this->error?->toArray(),
        ], static fn($v) => $v !== null);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}