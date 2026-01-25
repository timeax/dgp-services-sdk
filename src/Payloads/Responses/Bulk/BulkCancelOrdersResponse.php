<?php
declare(strict_types=1);

namespace Dgp\Sdk\Payloads\Responses\Bulk;

use JsonSerializable;
use Dgp\Sdk\Types\Bulk\BulkCancelOrderResult;

final readonly class BulkCancelOrdersResponse implements JsonSerializable
{
    /**
     * @param array<int, BulkCancelOrderResult> $results
     */
    public function __construct(
        public array $results = [],
    ) {}

    public function jsonSerialize(): array
    {
        return [
            'results' => array_map(
                static fn (BulkCancelOrderResult $r) => $r->toArray(),
                $this->results
            ),
        ];
    }
}