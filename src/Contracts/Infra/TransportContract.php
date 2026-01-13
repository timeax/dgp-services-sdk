<?php
declare(strict_types=1);

namespace Dgp\Sdk\Contracts\Infra;

use Dgp\Sdk\Support\Result;
use Dgp\Sdk\Payloads\Requests\Infra\HttpRequestDto;
use Dgp\Sdk\Payloads\Responses\Infra\HttpResponseDto;

interface TransportContract
{
    /** @return Result<HttpResponseDto> */
    public function send(HttpRequestDto $request): Result;
}