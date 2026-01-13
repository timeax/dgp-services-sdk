<?php
declare(strict_types=1);

namespace Dgp\Sdk\Types\Subscription;

use JsonSerializable;
use Dgp\Sdk\Support\Serialization\Arrayable;

final readonly class SubscriptionRef implements Arrayable, JsonSerializable
{
    /**
     * @param array<string, mixed>|null $meta
     */
    public function __construct(
        public string      $providerSubscriptionId,
        public string|int|null $serviceId = null,
        public ?array      $meta = null,
    ) {}

    public function toArray(): array
    {
        return array_filter([
            'provider_subscription_id' => $this->providerSubscriptionId,
            'service_id' => $this->serviceId,
            'meta' => $this->meta,
        ], static fn ($v) => $v !== null);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}