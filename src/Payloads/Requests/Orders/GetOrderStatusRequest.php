<?php
declare(strict_types=1);

namespace Dgp\Sdk\Payloads\Requests\Orders;

use JsonSerializable;
use Dgp\Sdk\Support\Serialization\Arrayable;

final readonly class GetOrderStatusRequest implements Arrayable, JsonSerializable
{
    public function __construct(
        public string $providerOrderId,
    ) {}

    public function toArray(): array
    {
        return ['provider_order_id' => $this->providerOrderId];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}