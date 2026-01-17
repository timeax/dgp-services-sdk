<?php
declare(strict_types=1);

namespace Dgp\Sdk\Payloads\Requests\Infra;

use JsonSerializable;

final readonly class AuthApplyRequest implements JsonSerializable
{
    /**
     * @param array<string,mixed>|null $context
     */
    public function __construct(
        public string         $operation,
        public HttpRequestDto $httpRequest,
        public ?array         $context = null,
    ) {}

    public function jsonSerialize(): array
    {
        return array_filter([
            'operation' => $this->operation,
            'httpRequest' => $this->httpRequest,
            'context' => $this->context,
        ], static fn ($v) => $v !== null);
    }
}