<?php
declare(strict_types=1);

namespace Dgp\Sdk\Payloads\Requests\Infra;

use JsonSerializable;
use Dgp\Sdk\Payloads\Responses\Infra\HttpResponseDto;

final class RateLimitHintRequest implements JsonSerializable
{
    /**
     * @param array<string,mixed>|null $context
     */
    public function __construct(
        public readonly string $operation,
        public readonly ?HttpResponseDto $lastResponse = null,
        public readonly ?array $context = null,
    ) {}

    public function jsonSerialize(): array
    {
        return array_filter([
            'operation' => $this->operation,
            'lastResponse' => $this->lastResponse,
            'context' => $this->context,
        ], static fn ($v) => $v !== null);
    }
}