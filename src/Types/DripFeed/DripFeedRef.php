<?php
declare(strict_types=1);

namespace Dgp\Sdk\Types\DripFeed;

use JsonSerializable;
use Dgp\Sdk\Support\Serialization\Arrayable;

final readonly class DripFeedRef implements Arrayable, JsonSerializable
{
    /**
     * @param array<string, mixed>|null $meta
     */
    public function __construct(
        public string      $providerDripFeedId,
        public string|int|null $serviceId = null,
        public ?array      $meta = null,
    ) {}

    public function toArray(): array
    {
        return array_filter([
            'provider_dripfeed_id' => $this->providerDripFeedId,
            'service_id' => $this->serviceId,
            'meta' => $this->meta,
        ], static fn ($v) => $v !== null);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}