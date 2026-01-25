<?php
declare(strict_types=1);

namespace Dgp\Sdk\Payloads\Requests\Bulk;

use JsonSerializable;
use Dgp\Sdk\Support\Serialization\Normalizes;

final class BulkGetRefillStatusRequest implements JsonSerializable
{
    use Normalizes;

    /**
     * @param array<int, string|int> $provider_refill_ids
     */
    public function __construct(
        public array $provider_refill_ids = [],
    )
    {
    }

    public function jsonSerialize(): array
    {
        return $this->normalize([
            'provider_refill_ids' => $this->provider_refill_ids,
        ]);
    }
}