<?php
declare(strict_types=1);

namespace Dgp\Sdk\Types\Bulk;

use JsonSerializable;
use Dgp\Sdk\Support\DgpError;
use Dgp\Sdk\Support\Serialization\Arrayable;
use Dgp\Sdk\Types\Orders\OrderStatus;

final readonly class BulkOrderStatusResult implements Arrayable, JsonSerializable
{
    public function __construct(
        public string       $providerOrderId,
        public bool         $ok,
        public ?OrderStatus $status = null,
        public ?DgpError    $error = null,
    ) {}

    public function toArray(): array
    {
        return array_filter([
            'provider_order_id' => $this->providerOrderId,
            'ok' => $this->ok,
            'status' => $this->status?->toArray(),
            'error' => $this->error?->toArray(),
        ], static fn ($v) => $v !== null);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}