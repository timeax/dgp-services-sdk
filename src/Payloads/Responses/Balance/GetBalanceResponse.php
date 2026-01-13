<?php
declare(strict_types=1);

namespace Dgp\Sdk\Payloads\Responses\Balance;

use JsonSerializable;
use Dgp\Sdk\Support\Serialization\Arrayable;
use Dgp\Sdk\Types\Balance\ProviderBalance;

final readonly class GetBalanceResponse implements Arrayable, JsonSerializable
{
    public function __construct(
        public ProviderBalance $balance,
    ) {}

    public function toArray(): array
    {
        return ['balance' => $this->balance->toArray()];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}