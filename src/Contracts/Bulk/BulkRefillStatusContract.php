<?php
declare(strict_types=1);

namespace Dgp\Sdk\Contracts\Bulk;

use Dgp\Sdk\Support\Result;
use Dgp\Sdk\Payloads\Requests\Bulk\BulkGetRefillStatusRequest;
use Dgp\Sdk\Payloads\Responses\Bulk\BulkGetRefillStatusResponse;

interface BulkRefillStatusContract
{
    /**
     * Bulk get refill statuses by provider refill id.
     *
     * @return Result<BulkGetRefillStatusResponse>
     */
    public function bulkGetRefillStatuses(BulkGetRefillStatusRequest $request): Result;
}