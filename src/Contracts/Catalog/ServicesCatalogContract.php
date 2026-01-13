<?php
declare(strict_types=1);

namespace Dgp\Sdk\Contracts\Catalog;

use Dgp\Sdk\Support\Result;
use Dgp\Sdk\Payloads\Requests\Catalog\ListServicesRequest;
use Dgp\Sdk\Payloads\Responses\Catalog\ListServicesResponse;

interface ServicesCatalogContract
{
    /** @return Result<ListServicesResponse> */
    public function listServices(ListServicesRequest $request): Result;
}