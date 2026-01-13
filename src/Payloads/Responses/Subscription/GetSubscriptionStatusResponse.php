<?php
declare(strict_types=1);

namespace Dgp\Sdk\Payloads\Responses\Subscription;

use JsonSerializable;
use Dgp\Sdk\Support\Serialization\Arrayable;
use Dgp\Sdk\Types\Subscription\SubscriptionStatus;

final readonly class GetSubscriptionStatusResponse implements Arrayable, JsonSerializable
{
    public function __construct(
        public SubscriptionStatus $status,
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