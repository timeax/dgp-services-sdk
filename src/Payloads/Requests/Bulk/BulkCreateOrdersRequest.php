<?php
declare(strict_types=1);

namespace Dgp\Sdk\Payloads\Requests\Bulk;

use JsonSerializable;
use Dgp\Sdk\Support\Serialization\Arrayable;
use Dgp\Sdk\Payloads\Requests\Orders\CreateOrderRequest;

final readonly class BulkCreateOrdersRequest implements Arrayable, JsonSerializable
{
    /**
     * @param CreateOrderRequest[] $orders
     */
    public function __construct(
        public array $orders,
    ) {}

    public function toArray(): array
    {
        return [
            'orders' => array_map(static fn (CreateOrderRequest $o) => $o->toArray(), $this->orders),
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}