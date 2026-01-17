<?php
declare(strict_types=1);

namespace Dgp\Sdk\Types\Ops;

use DateTimeInterface;
use JsonSerializable;
use Dgp\Sdk\Support\DgpError;
use Dgp\Sdk\Support\Serialization\Arrayable;
use Dgp\Sdk\Support\Serialization\Normalizes;
use Dgp\Sdk\Payloads\Requests\Infra\HttpRequestDto;
use Dgp\Sdk\Payloads\Responses\Infra\HttpResponseDto;

final class AuditRecord implements Arrayable, JsonSerializable
{
    use Normalizes;

    public const LEVEL_INFO = 'info';
    public const LEVEL_WARN = 'warn';
    public const LEVEL_ERROR = 'error';

    public const KIND_REQUEST = 'request';
    public const KIND_RESPONSE = 'response';
    public const KIND_WEBHOOK = 'webhook';
    public const KIND_HEALTH = 'health';
    public const KIND_INTERNAL = 'internal';

    /**
     * @param array<string,mixed>|null $context
     * @param array<string,mixed>|null $meta
     */
    public function __construct(
        public readonly string             $operation,                    // e.g. "order.create"
        public readonly string             $kind = self::KIND_INTERNAL,    // request/response/webhook/...
        public readonly string             $level = self::LEVEL_INFO,      // info/warn/error

        public readonly ?DateTimeInterface $at = null,         // when it happened (ISO via Normalizes)
        public readonly ?string            $driverKey = null,             // driver identifier (if known)
        public readonly string|int|null    $serviceId = null,     // optional: provider service id
        public readonly ?string            $providerRef = null,           // optional: provider order/refill id, etc.

        public readonly ?HttpRequestDto    $httpRequest = null,
        public readonly ?HttpResponseDto   $httpResponse = null,

        public readonly array|string|null  $providerPayload = null, // decoded json (array) or raw body (string)
        public readonly ?DgpError          $error = null,                   // normalized error (if any)

        public readonly ?array             $context = null, // safe context (currency, country, account tier...) - redacted
        public readonly ?array             $meta = null,    // safe extras - redacted
    )
    {
    }

    public function toArray(): array
    {
        // NOTE: explicit keys; do not rely on property names for stable external serialization.
        return $this->normalize([
            'operation' => $this->operation,
            'kind' => $this->kind,
            'level' => $this->level,

            'at' => $this->at,
            'driver_key' => $this->driverKey,
            'service_id' => $this->serviceId,
            'provider_ref' => $this->providerRef,

            'http_request' => $this->httpRequest,
            'http_response' => $this->httpResponse,

            'provider_payload' => $this->providerPayload,
            'error' => $this->error,

            'context' => $this->context,
            'meta' => $this->meta,
        ]);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}