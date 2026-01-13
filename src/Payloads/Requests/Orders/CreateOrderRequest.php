<?php
declare(strict_types=1);

namespace Dgp\Sdk\Payloads\Requests\Orders;

use JsonSerializable;
use Dgp\Sdk\Support\Serialization\Arrayable;

final readonly class CreateOrderRequest implements Arrayable, JsonSerializable
{
    /**
     * @param array<string, mixed> $fields
     * @param array<string, mixed>|null $meta
     */
    public function __construct(
        public string  $serviceId,
        public int     $quantity,
        public array   $fields = [],              // generic field bag: link, username, comments, etc
        public ?string $idempotencyKey = null,  // host provided key (optional)
        public ?array  $meta = null,
    ) {}

    public function toArray(): array
    {
        return array_filter([
            'service_id' => $this->serviceId,
            'quantity' => $this->quantity,
            'fields' => $this->fields,
            'idempotency_key' => $this->idempotencyKey,
            'meta' => $this->meta,
        ], static fn ($v) => $v !== null);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}