<?php
declare(strict_types=1);

namespace Dgp\Sdk\Contracts\Catalog;

use Dgp\Sdk\Support\Result;
use Dgp\Sdk\Payloads\Requests\Catalog\GetServiceSchemaCatalogRequest;
use Dgp\Sdk\Payloads\Responses\Catalog\GetServiceSchemaCatalogResponse;

interface ServiceSchemaCatalogContract
{
    /** @return Result<GetServiceSchemaCatalogResponse> */
    public function getServiceSchemaCatalog(GetServiceSchemaCatalogRequest $request): Result;
}