<?php
declare(strict_types=1);

namespace Dgp\Sdk\Contracts\Orders;

use Dgp\Sdk\Support\Result;
use Dgp\Sdk\Payloads\Requests\Orders\GetOrderStatusRequest;
use Dgp\Sdk\Payloads\Responses\Orders\GetOrderStatusResponse;

interface OrderStatusContract
{
    /** @return Result<GetOrderStatusResponse> */
    public function getOrderStatus(GetOrderStatusRequest $request): Result;
}