<?php
declare(strict_types=1);

namespace Dgp\Sdk\Contracts\Bulk;

use Dgp\Sdk\Support\Result;
use Dgp\Sdk\Payloads\Requests\Bulk\BulkCreateOrdersRequest;
use Dgp\Sdk\Payloads\Responses\Bulk\BulkCreateOrdersResponse;

interface BulkOrderCreateContract
{
    /** @return Result<BulkCreateOrdersResponse> */
    public function bulkCreateOrders(BulkCreateOrdersRequest $request): Result;
}