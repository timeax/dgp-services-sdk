<?php
declare(strict_types=1);

namespace Dgp\Sdk\Payloads\Responses\DripFeed;

use JsonSerializable;
use Dgp\Sdk\Support\Serialization\Arrayable;
use Dgp\Sdk\Types\DripFeed\DripFeedRef;

final readonly class CreateDripFeedResponse implements Arrayable, JsonSerializable
{
    public function __construct(
        public DripFeedRef $dripfeed,
    ) {}

    public function toArray(): array
    {
        return ['dripfeed' => $this->dripfeed->toArray()];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}