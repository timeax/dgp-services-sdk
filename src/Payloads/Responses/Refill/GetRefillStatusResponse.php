<?php
declare(strict_types=1);

namespace Dgp\Sdk\Payloads\Responses\Refill;

use JsonSerializable;
use Dgp\Sdk\Support\Serialization\Arrayable;
use Dgp\Sdk\Types\Refill\RefillStatus;

final readonly class GetRefillStatusResponse implements Arrayable, JsonSerializable
{
    public function __construct(
        public RefillStatus $status,
    ) {}

    public function toArray(): array
    {
        return ['status' => $this->status->toArray()];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}