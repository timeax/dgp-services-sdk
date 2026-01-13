<?php
declare(strict_types=1);

namespace Dgp\Sdk\Payloads\Responses\Orders;

use JsonSerializable;
use Dgp\Sdk\Support\Serialization\Arrayable;
use Dgp\Sdk\Types\Orders\OrderRef;

final readonly class CreateOrderResponse implements Arrayable, JsonSerializable
{
    public function __construct(
        public OrderRef $order,
    ) {}

    public function toArray(): array
    {
        return ['order' => $this->order->toArray()];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}