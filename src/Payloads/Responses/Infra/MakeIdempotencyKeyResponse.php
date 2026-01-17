<?php
declare(strict_types=1);

namespace Dgp\Sdk\Payloads\Responses\Infra;

use JsonSerializable;
use Dgp\Sdk\Types\Infra\IdempotencyKey;

final class MakeIdempotencyKeyResponse implements JsonSerializable
{
    public function __construct(
        public readonly IdempotencyKey $key,
    ) {}

    public function jsonSerialize(): array
    {
        return [
            'key' => $this->key,
        ];
    }
}