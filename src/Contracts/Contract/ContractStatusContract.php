<?php declare(strict_types=1);

namespace Dgp\Sdk\Contracts\Contract;

use Dgp\Sdk\Payloads\Requests\Contract\GetContractStatusRequest;
use Dgp\Sdk\Payloads\Responses\Contract\GetContractStatusResponse;
use Dgp\Sdk\Support\Result;

interface ContractStatusContract
{
    /** @return Result<GetContractStatusResponse> */
    public function getContractStatus(GetContractStatusRequest $request): Result;
}