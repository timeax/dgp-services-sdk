<?php
declare(strict_types=1);

namespace Dgp\Sdk\Payloads\Requests\Bulk;

use JsonSerializable;
use Dgp\Sdk\Support\Serialization\Arrayable;

final readonly class BulkGetOrderStatusRequest implements Arrayable, JsonSerializable
{
    /**
     * @param string[] $providerOrderIds
     */
    public function __construct(
        public array $providerOrderIds,
    ) {}

    public function toArray(): array
    {
        return [
            'provider_order_ids' => array_values($this->providerOrderIds),
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}