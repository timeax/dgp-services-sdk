<?php
declare(strict_types=1);

namespace Dgp\Sdk\Contracts\Catalog;

use Dgp\Sdk\Support\Result;
use Dgp\Sdk\Payloads\Requests\Catalog\GetServiceInputSchemaRequest;
use Dgp\Sdk\Payloads\Responses\Catalog\GetServiceInputSchemaResponse;

interface ServiceInputSchemaContract
{
    /** @return Result<GetServiceInputSchemaResponse> */
    public function getServiceInputSchema(GetServiceInputSchemaRequest $request): Result;
}