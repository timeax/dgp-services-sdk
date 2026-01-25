<?php
declare(strict_types=1);

namespace Dgp\Sdk\Types\Bulk;

use JsonSerializable;
use Dgp\Sdk\Support\DgpError;
use Dgp\Sdk\Support\Serialization\Arrayable;

final readonly class BulkCancelOrderResult implements Arrayable, JsonSerializable
{
    public function __construct(
        public string|int $providerOrderId,
        public bool       $ok,
        public ?bool      $canceled = null,
        public ?DgpError  $error = null,
    )
    {
    }

    public static function ok(string|int $providerOrderId, bool $canceled = true): self
    {
        return new self(
            providerOrderId: $providerOrderId,
            ok: true,
            canceled: $canceled,
            error: null,
        );
    }

    public static function fail(string|int $providerOrderId, DgpError $error): self
    {
        return new self(
            providerOrderId: $providerOrderId,
            ok: false,
            canceled: null,
            error: $error,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'provider_order_id' => $this->providerOrderId,
            'ok' => $this->ok,
            'canceled' => $this->canceled,
            'error' => $this->error?->toArray(),
        ], static fn($v) => $v !== null);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}