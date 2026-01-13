<?php
declare(strict_types=1);

namespace Dgp\Sdk\Types\Orders;

use JsonSerializable;
use Dgp\Sdk\Support\Serialization\Arrayable;

final readonly class OrderRef implements Arrayable, JsonSerializable
{
    /**
     * @param array<string, mixed>|null $meta
     */
    public function __construct(
        public string  $providerOrderId,
        public ?string $clientOrderRef = null, // host-side idempotency/reference
        public ?array  $meta = null,
    )
    {
    }

    public function toArray(): array
    {
        return array_filter([
            'provider_order_id' => $this->providerOrderId,
            'client_order_ref' => $this->clientOrderRef,
            'meta' => $this->meta,
        ], static fn($v) => $v !== null);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}