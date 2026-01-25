<?php
declare(strict_types=1);

namespace Dgp\Sdk\Payloads\Responses\Bulk;

use JsonSerializable;
use Dgp\Sdk\Types\Bulk\BulkRefillStatusResult;

final readonly class BulkGetRefillStatusResponse implements JsonSerializable
{
    /**
     * @param array<int, BulkRefillStatusResult> $results
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
                static fn(BulkRefillStatusResult $r) => $r->toArray(),
                $this->results
            ),
        ];
    }
}