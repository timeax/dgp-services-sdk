<?php
declare(strict_types=1);

namespace Dgp\Sdk\Payloads\Requests\Bulk;

use JsonSerializable;
use Dgp\Sdk\Support\Serialization\Normalizes;

final class BulkCancelOrdersRequest implements JsonSerializable
{
    use Normalizes;

    /**
     * @param array<int, string|int> $provider_order_ids
     */
    public function __construct(
        public array $provider_order_ids = [],
    )
    {
    }

    public function jsonSerialize(): array
    {
        return $this->normalize([
            'provider_order_ids' => $this->provider_order_ids,
        ]);
    }
}