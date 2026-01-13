<?php
declare(strict_types=1);

namespace Dgp\Sdk\Payloads\Responses\Bulk;

use JsonSerializable;
use Dgp\Sdk\Support\Serialization\Arrayable;
use Dgp\Sdk\Types\Bulk\BulkCreateOrderResult;

final readonly class BulkCreateOrdersResponse implements Arrayable, JsonSerializable
{
    /**
     * @param BulkCreateOrderResult[] $results
     */
    public function __construct(
        public array $results,
    ) {}

    public function toArray(): array
    {
        return [
            'results' => array_map(static fn (BulkCreateOrderResult $r) => $r->toArray(), $this->results),
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}