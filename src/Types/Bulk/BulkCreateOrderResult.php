<?php
declare(strict_types=1);

namespace Dgp\Sdk\Types\Bulk;

use JsonSerializable;
use Dgp\Sdk\Support\DgpError;
use Dgp\Sdk\Support\Serialization\Arrayable;
use Dgp\Sdk\Types\Orders\OrderRef;

final readonly class BulkCreateOrderResult implements Arrayable, JsonSerializable
{
    public function __construct(
        public int       $index,
        public bool      $ok,
        public ?OrderRef $order = null,
        public ?DgpError $error = null,
    ) {}

    public function toArray(): array
    {
        return array_filter([
            'index' => $this->index,
            'ok' => $this->ok,
            'order' => $this->order?->toArray(),
            'error' => $this->error?->toArray(),
        ], static fn ($v) => $v !== null);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}