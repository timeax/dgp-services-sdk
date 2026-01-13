<?php
declare(strict_types=1);

namespace Dgp\Sdk\Payloads\Responses\DripFeed;

use JsonSerializable;
use Dgp\Sdk\Support\Serialization\Arrayable;
use Dgp\Sdk\Types\DripFeed\DripFeedStatus;

final readonly class GetDripFeedStatusResponse implements Arrayable, JsonSerializable
{
    public function __construct(
        public DripFeedStatus $status,
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