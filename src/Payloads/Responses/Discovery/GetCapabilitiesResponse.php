<?php
declare(strict_types=1);

namespace Dgp\Sdk\Payloads\Responses\Discovery;

use JsonSerializable;
use Dgp\Sdk\Support\Serialization\Arrayable;
use Dgp\Sdk\Types\Infra\CapabilityMap;

final readonly class GetCapabilitiesResponse implements Arrayable, JsonSerializable
{
    public function __construct(
        public CapabilityMap $capabilities,
    ) {}

    public function toArray(): array
    {
        return ['capabilities' => $this->capabilities->toArray()];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}