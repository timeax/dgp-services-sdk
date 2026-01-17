<?php
declare(strict_types=1);

namespace Dgp\Sdk\Payloads\Requests\Ops;

use Dgp\Sdk\Types\Infra\HttpMethod;
use JsonSerializable;

final readonly class ParseWebhookRequest implements JsonSerializable
{
    /**
     * @param array<string,string> $headers
     * @param array<string,mixed>|string|null $body
     */
    public function __construct(
        public HttpMethod            $method,
        public array             $headers,
        public array|string|null $body,
        public ?string           $rawBody = null, // if you want exact bytes for signature verification
    ) {}

    public function jsonSerialize(): array
    {
        return array_filter([
            'method' => $this->method->value,
            'headers' => $this->headers,
            'body' => $this->body,
            'rawBody' => $this->rawBody,
        ], static fn ($v) => $v !== null);
    }
}