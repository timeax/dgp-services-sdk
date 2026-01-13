<?php
declare(strict_types=1);

namespace Dgp\Sdk\Contracts\Catalog;

use Dgp\Sdk\Support\Result;
use Dgp\Sdk\Payloads\Requests\Catalog\GetServiceSchemaSnapshotRequest;
use Dgp\Sdk\Payloads\Requests\Catalog\GetServiceSchemaForServiceRequest;
use Dgp\Sdk\Payloads\Responses\Catalog\GetServiceSchemaSnapshotResponse;
use Dgp\Sdk\Payloads\Responses\Catalog\GetServiceSchemaForServiceResponse;

interface ServiceSchemaContract
{
    /** @return Result<GetServiceSchemaSnapshotResponse> */
    public function getServiceSchemaSnapshot(GetServiceSchemaSnapshotRequest $request): Result;

    /** @return Result<GetServiceSchemaForServiceResponse> */
    public function getServiceSchemaForService(GetServiceSchemaForServiceRequest $request): Result;
}