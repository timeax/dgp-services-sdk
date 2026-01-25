<?php
declare(strict_types=1);

namespace Dgp\Sdk\Contracts\Bulk;

use Dgp\Sdk\Support\Result;
use Dgp\Sdk\Payloads\Requests\Bulk\BulkCreateRefillsRequest;
use Dgp\Sdk\Payloads\Responses\Bulk\BulkCreateRefillsResponse;

interface BulkRefillCreateContract
{
    /**
     * Bulk create refills for orders by provider order id.
     *
     * @return Result<BulkCreateRefillsResponse>
     */
    public function bulkCreateRefills(BulkCreateRefillsRequest $request): Result;
}