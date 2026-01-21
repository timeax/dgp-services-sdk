<?php declare(strict_types=1);

namespace Dgp\Sdk\Contracts\Contract;

use Dgp\Sdk\Payloads\Requests\Contract\CreateContractRequest;
use Dgp\Sdk\Payloads\Responses\Contract\CreateContractResponse;
use Dgp\Sdk\Support\Result;

interface ContractCreateContract
{
    /** @return Result<CreateContractResponse> */
    public function createContract(CreateContractRequest $request): Result;
}