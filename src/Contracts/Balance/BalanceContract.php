<?php
declare(strict_types=1);

namespace Dgp\Sdk\Contracts\Balance;

use Dgp\Sdk\Support\Result;
use Dgp\Sdk\Payloads\Requests\Balance\GetBalanceRequest;
use Dgp\Sdk\Payloads\Responses\Balance\GetBalanceResponse;

interface BalanceContract
{
    /** @return Result<GetBalanceResponse> */
    public function getBalance(GetBalanceRequest $request): Result;
}