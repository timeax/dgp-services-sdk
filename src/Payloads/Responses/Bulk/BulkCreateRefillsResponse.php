<?php
declare(strict_types=1);

namespace Dgp\Sdk\Payloads\Responses\Bulk;

use JsonSerializable;
use Dgp\Sdk\Types\Bulk\BulkCreateRefillResult;

final readonly class BulkCreateRefillsResponse implements JsonSerializable
{
    /**
     * @param array<int, BulkCreateRefillResult> $results
     */
    public function __construct(
        public array $results = [],
    )
    {
    }

    public function jsonSerialize(): array
    {
        return [
            'results' => array_map(
                static fn(BulkCreateRefillResult $r) => $r->toArray(),
                $this->results
            ),
        ];
    }
}