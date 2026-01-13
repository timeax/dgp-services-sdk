<?php
declare(strict_types=1);

namespace Dgp\Sdk\Contracts\DripFeed;

use Dgp\Sdk\Support\Result;
use Dgp\Sdk\Payloads\Requests\DripFeed\CreateDripFeedRequest;
use Dgp\Sdk\Payloads\Requests\DripFeed\GetDripFeedStatusRequest;
use Dgp\Sdk\Payloads\Requests\DripFeed\CancelDripFeedRequest;
use Dgp\Sdk\Payloads\Responses\DripFeed\CreateDripFeedResponse;
use Dgp\Sdk\Payloads\Responses\DripFeed\GetDripFeedStatusResponse;
use Dgp\Sdk\Payloads\Responses\DripFeed\CancelDripFeedResponse;

interface DripFeedContract
{
    /** @return Result<CreateDripFeedResponse> */
    public function createDripFeed(CreateDripFeedRequest $request): Result;

    /** @return Result<GetDripFeedStatusResponse> */
    public function getDripFeedStatus(GetDripFeedStatusRequest $request): Result;

    /** @return Result<CancelDripFeedResponse> */
    public function cancelDripFeed(CancelDripFeedRequest $request): Result;
}