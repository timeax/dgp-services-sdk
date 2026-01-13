<?php
declare(strict_types=1);

namespace Dgp\Sdk\Payloads\Responses\Refill;

use JsonSerializable;
use Dgp\Sdk\Support\Serialization\Arrayable;
use Dgp\Sdk\Types\Refill\RefillRef;

final readonly class CreateRefillResponse implements Arrayable, JsonSerializable
{
    public function __construct(
        public RefillRef $refill,
    ) {}

    public function toArray(): array
    {
        return ['refill' => $this->refill->toArray()];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}