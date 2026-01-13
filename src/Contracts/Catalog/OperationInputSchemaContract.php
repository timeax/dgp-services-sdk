<?php
declare(strict_types=1);

namespace Dgp\Sdk\Contracts\Catalog;

use Dgp\Sdk\Payloads\Responses\Catalog\GetOperationInputSchemaResponse;
use Dgp\Sdk\Support\Result;
use Dgp\Sdk\Payloads\Requests\Catalog\GetOperationInputSchemaRequest;

interface OperationInputSchemaContract
{
    /**
     * Returns an input schema for a given operation (optionally scoped to a service).
     *
     * Examples:
     *  - operation: "order.create" (service_id required for most providers)
     *  - operation: "subscription.create" (service_id optional/required depending on provider)
     *
     * @return Result<GetOperationInputSchemaResponse>
     */
    public function getOperationInputSchema(GetOperationInputSchemaRequest $request): Result;
}