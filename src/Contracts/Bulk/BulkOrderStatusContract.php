<?php
declare(strict_types=1);

namespace Dgp\Sdk\Contracts\Bulk;

use Dgp\Sdk\Support\Result;
use Dgp\Sdk\Payloads\Requests\Bulk\BulkGetOrderStatusRequest;
use Dgp\Sdk\Payloads\Responses\Bulk\BulkGetOrderStatusResponse;

interface BulkOrderStatusContract
{
    /** @return Result<BulkGetOrderStatusResponse> */
    public function bulkGetOrderStatus(BulkGetOrderStatusRequest $request): Result;
}