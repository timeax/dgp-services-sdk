<?php
declare(strict_types=1);

namespace Dgp\Sdk\Payloads\Requests\Infra;

use JsonSerializable;
use Dgp\Sdk\Support\DgpError;

final class RetryDecisionRequest implements JsonSerializable
{
    /**
     * @param array<string,mixed>|null $context
     */
    public function __construct(
        public readonly string $operation,
        public readonly int $attempt,
        public readonly DgpError $error,
        public readonly ?array $context = null,
    ) {}

    public function jsonSerialize(): array
    {
        return array_filter([
            'operation' => $this->operation,
            'attempt' => $this->attempt,
            'error' => $this->error,
            'context' => $this->context,
        ], static fn ($v) => $v !== null);
    }
}