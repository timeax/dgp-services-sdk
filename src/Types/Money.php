<?php
declare(strict_types=1);

namespace Dgp\Sdk\Types;

use JsonSerializable;
use Dgp\Sdk\Support\Serialization\Arrayable;

final readonly class Money implements Arrayable, JsonSerializable
{
    public function __construct(
        public int      $amountMinor,      // minor units: cents, kobo, etc
        public Currency $currency,
    )
    {
    }

    public function toArray(): array
    {
        return [
            'amount_minor' => $this->amountMinor,
            'currency' => $this->currency->toArray(),
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}