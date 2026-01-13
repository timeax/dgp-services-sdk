<?php
declare(strict_types=1);

namespace Dgp\Sdk\Types\Refill;

use JsonSerializable;
use Dgp\Sdk\Support\Serialization\Arrayable;

final class RefillRef implements Arrayable, JsonSerializable
{
    /**
     * @param array<string, mixed>|null $meta
     */
    public function __construct(
        public readonly string $providerRefillId,
        public readonly string $providerOrderId,
        public readonly ?array $meta = null,
    ) {}

    public function toArray(): array
    {
        return array_filter([
            'provider_refill_id' => $this->providerRefillId,
            'provider_order_id' => $this->providerOrderId,
            'meta' => $this->meta,
        ], static fn ($v) => $v !== null);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}