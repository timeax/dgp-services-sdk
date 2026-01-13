<?php
declare(strict_types=1);

namespace Dgp\Sdk\Payloads\Requests\Balance;

use JsonSerializable;
use Dgp\Sdk\Support\Serialization\Arrayable;

final class GetBalanceRequest implements Arrayable, JsonSerializable
{
    public function toArray(): array
    {
        return [];
    }

    public function jsonSerialize(): array
    {
        return [];
    }
}