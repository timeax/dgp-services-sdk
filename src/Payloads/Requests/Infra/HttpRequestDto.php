<?php
declare(strict_types=1);

namespace Dgp\Sdk\Payloads\Requests\Infra;

use JsonSerializable;
use Dgp\Sdk\Types\Infra\HttpMethod;
use Dgp\Sdk\Support\Serialization\Arrayable;

final readonly class HttpRequestDto implements Arrayable, JsonSerializable
{
    /**
     * @param array<string, string> $headers
     * @param array<string, mixed>|null $query
     * @param array<string, mixed>|string|null $body
     */
    public function __construct(
        public HttpMethod        $method,
        public string            $url,
        public array             $headers = [],
        public ?array            $query = null,
        public array|string|null $body = null,
        public ?int              $timeoutMs = null,
    ) {}

    public function toArray(): array
    {
        return array_filter([
            'method' => $this->method->value,
            'url' => $this->url,
            'headers' => $this->headers,
            'query' => $this->query,
            'body' => $this->body,
            'timeout_ms' => $this->timeoutMs,
        ], static fn ($v) => $v !== null);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}