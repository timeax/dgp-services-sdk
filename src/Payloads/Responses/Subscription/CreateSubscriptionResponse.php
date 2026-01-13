<?php
declare(strict_types=1);

namespace Dgp\Sdk\Payloads\Responses\Subscription;

use JsonSerializable;
use Dgp\Sdk\Support\Serialization\Arrayable;
use Dgp\Sdk\Types\Subscription\SubscriptionRef;

final readonly class CreateSubscriptionResponse implements Arrayable, JsonSerializable
{
    public function __construct(
        public SubscriptionRef $subscription,
    ) {}

    public function toArray(): array
    {
        return ['subscription' => $this->subscription->toArray()];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}