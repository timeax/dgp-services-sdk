<?php
declare(strict_types=1);

namespace Dgp\Sdk\Payloads\Requests\Refill;

use JsonSerializable;
use Dgp\Sdk\Support\Serialization\Arrayable;

final readonly class GetRefillStatusRequest implements Arrayable, JsonSerializable
{
    public function __construct(
        public string $providerRefillId,
    ) {}

    public function toArray(): array
    {
        return ['provider_refill_id' => $this->providerRefillId];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}