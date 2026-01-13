<?php
declare(strict_types=1);

namespace Dgp\Sdk\Payloads\Responses\Infra;

use JsonSerializable;
use Dgp\Sdk\Support\Serialization\Arrayable;

final readonly class HttpResponseDto implements Arrayable, JsonSerializable
{
    /**
     * @param array<string, string> $headers
     * @param array<string, mixed>|string|null $body
     */
    public function __construct(
        public int               $status,
        public array             $headers = [],
        public array|string|null $body = null,
    )
    {
    }

    public function toArray(): array
    {
        return array_filter([
            'status' => $this->status,
            'headers' => $this->headers,
            'body' => $this->body,
        ], static fn($v) => $v !== null);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}