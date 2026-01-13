<?php
declare(strict_types=1);

namespace Dgp\Sdk\Payloads\Requests\Subscription;

use JsonSerializable;
use Dgp\Sdk\Support\Serialization\Arrayable;

final readonly class GetSubscriptionStatusRequest implements Arrayable, JsonSerializable
{
    public function __construct(
        public string $providerSubscriptionId,
    ) {}

    public function toArray(): array
    {
        return ['provider_subscription_id' => $this->providerSubscriptionId];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}