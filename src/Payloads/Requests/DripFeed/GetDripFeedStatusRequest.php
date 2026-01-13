<?php
declare(strict_types=1);

namespace Dgp\Sdk\Payloads\Requests\DripFeed;

use JsonSerializable;
use Dgp\Sdk\Support\Serialization\Arrayable;

final readonly class GetDripFeedStatusRequest implements Arrayable, JsonSerializable
{
    public function __construct(
        public string $providerDripFeedId,
    ) {}

    public function toArray(): array
    {
        return ['provider_dripfeed_id' => $this->providerDripFeedId];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}