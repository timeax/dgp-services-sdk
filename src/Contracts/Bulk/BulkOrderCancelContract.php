<?php
declare(strict_types=1);

namespace Dgp\Sdk\Contracts\Bulk;

use Dgp\Sdk\Support\Result;
use Dgp\Sdk\Payloads\Requests\Bulk\BulkCancelOrdersRequest;
use Dgp\Sdk\Payloads\Responses\Bulk\BulkCancelOrdersResponse;

interface BulkOrderCancelContract
{
    /**
     * Bulk cancel orders by provider order id.
     *
     * @return Result<BulkCancelOrdersResponse>
     */
    public function bulkCancelOrders(BulkCancelOrdersRequest $request): Result;
}