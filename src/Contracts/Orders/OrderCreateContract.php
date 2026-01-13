<?php
declare(strict_types=1);

namespace Dgp\Sdk\Contracts\Orders;

use Dgp\Sdk\Support\Result;
use Dgp\Sdk\Payloads\Requests\Orders\CreateOrderRequest;
use Dgp\Sdk\Payloads\Responses\Orders\CreateOrderResponse;

interface OrderCreateContract
{
    /** @return Result<CreateOrderResponse> */
    public function createOrder(CreateOrderRequest $request): Result;
}