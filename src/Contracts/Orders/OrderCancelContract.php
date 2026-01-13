<?php
declare(strict_types=1);

namespace Dgp\Sdk\Contracts\Orders;

use Dgp\Sdk\Support\Result;
use Dgp\Sdk\Payloads\Requests\Orders\CancelOrderRequest;
use Dgp\Sdk\Payloads\Responses\Orders\CancelOrderResponse;

interface OrderCancelContract
{
    /** @return Result<CancelOrderResponse> */
    public function cancelOrder(CancelOrderRequest $request): Result;
}