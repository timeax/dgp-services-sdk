<?php declare(strict_types=1);

namespace Dgp\Sdk\Contracts\Contract;

use Dgp\Sdk\Payloads\Requests\Contract\QuoteContractRequest;
use Dgp\Sdk\Payloads\Responses\Contract\QuoteContractResponse;
use Dgp\Sdk\Support\Result;

interface ContractQuoteContract
{
    /** @return Result<QuoteContractResponse> */
    public function quoteContract(QuoteContractRequest $request): Result;
}