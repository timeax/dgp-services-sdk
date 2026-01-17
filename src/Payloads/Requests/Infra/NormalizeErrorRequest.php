<?php
declare(strict_types=1);

namespace Dgp\Sdk\Payloads\Requests\Infra;

use JsonSerializable;
use Dgp\Sdk\Payloads\Responses\Infra\HttpResponseDto;

/**
 * Carrier for “anything that went wrong” so a driver can normalize consistently.
 */
final class NormalizeErrorRequest implements JsonSerializable
{
    /**
     * @param array<string,mixed>|null $context
     * @param array<string,mixed>|null $providerPayload Parsed provider response payload if available
     * @param array<string,mixed>|null $meta Extra safe metadata (already redacted)
     */
    public function __construct(
        public readonly string $operation,                 // e.g. "catalog.list", "order.create"
        public readonly ?string $driverKey = null,         // optional: for logging/trace
        public readonly ?HttpRequestDto $httpRequest = null,
        public readonly ?HttpResponseDto $httpResponse = null,

        // provider payload (decoded json) or raw body (string) if decoding failed
        public readonly array|string|null $providerPayload = null,

        // exception info (for transport/system errors)
        public readonly ?string $exceptionClass = null,
        public readonly ?string $exceptionMessage = null,

        public readonly ?array $context = null,
        public readonly ?array $meta = null,
    ) {}

    public function jsonSerialize(): array
    {
        return array_filter([
            'operation' => $this->operation,
            'driverKey' => $this->driverKey,
            'httpRequest' => $this->httpRequest,
            'httpResponse' => $this->httpResponse,
            'providerPayload' => $this->providerPayload,
            'exceptionClass' => $this->exceptionClass,
            'exceptionMessage' => $this->exceptionMessage,
            'context' => $this->context,
            'meta' => $this->meta,
        ], static fn ($v) => $v !== null);
    }
}