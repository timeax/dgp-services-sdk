<?php
declare(strict_types=1);

namespace Dgp\Sdk\Types\Orders;

use JsonSerializable;
use Dgp\Sdk\Support\Serialization\Arrayable;

final readonly class OrderStatus implements Arrayable, JsonSerializable
{
    /**
     * @param array<string, mixed>|null $meta
     */
    public function __construct(
        public OrderStatusCode $code,
        public ?string         $providerStatus = null, // raw provider status text if any
        public ?int            $startCount = null,
        public ?int            $remains = null,
        public ?string         $message = null,
        public ?array          $meta = null,
    )
    {
    }

    public function toArray(): array
    {
        return array_filter([
            'code' => $this->code->value,
            'provider_status' => $this->providerStatus,
            'start_count' => $this->startCount,
            'remains' => $this->remains,
            'message' => $this->message,
            'meta' => $this->meta,
        ], static fn($v) => $v !== null);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}