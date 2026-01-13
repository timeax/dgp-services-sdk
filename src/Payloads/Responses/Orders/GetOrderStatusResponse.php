<?php
declare(strict_types=1);

namespace Dgp\Sdk\Payloads\Responses\Orders;

use JsonSerializable;
use Dgp\Sdk\Support\Serialization\Arrayable;
use Dgp\Sdk\Types\Orders\OrderStatus;

final readonly class GetOrderStatusResponse implements Arrayable, JsonSerializable
{
    public function __construct(
        public OrderStatus $status,
    ) {}

    public function toArray(): array
    {
        return ['status' => $this->status->toArray()];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}