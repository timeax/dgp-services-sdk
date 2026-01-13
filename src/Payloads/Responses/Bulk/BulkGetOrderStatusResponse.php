<?php
declare(strict_types=1);

namespace Dgp\Sdk\Payloads\Responses\Bulk;

use JsonSerializable;
use Dgp\Sdk\Support\Serialization\Arrayable;
use Dgp\Sdk\Types\Bulk\BulkOrderStatusResult;

final readonly class BulkGetOrderStatusResponse implements Arrayable, JsonSerializable
{
    /**
     * @param BulkOrderStatusResult[] $results
     */
    public function __construct(
        public array $results,
    ) {}

    public function toArray(): array
    {
        return [
            'results' => array_map(static fn (BulkOrderStatusResult $r) => $r->toArray(), $this->results),
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}