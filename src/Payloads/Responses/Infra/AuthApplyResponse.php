<?php
declare(strict_types=1);

namespace Dgp\Sdk\Payloads\Responses\Infra;

use JsonSerializable;
use Dgp\Sdk\Payloads\Requests\Infra\HttpRequestDto;

final readonly class AuthApplyResponse implements JsonSerializable
{
    public function __construct(
        public HttpRequestDto $httpRequest,
    ) {}

    public function jsonSerialize(): array
    {
        return [
            'httpRequest' => $this->httpRequest,
        ];
    }
}