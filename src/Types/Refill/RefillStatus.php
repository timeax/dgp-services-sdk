<?php
declare(strict_types=1);

namespace Dgp\Sdk\Types\Refill;

use JsonSerializable;
use Dgp\Sdk\Support\Serialization\Arrayable;

final readonly class RefillStatus implements Arrayable, JsonSerializable
{
    /**
     * @param array<string, mixed>|null $meta
     */
    public function __construct(
        public RefillStatusCode $code,
        public ?string          $providerStatus = null,
        public ?string          $message = null,
        public ?array           $meta = null,
    ) {}

    public function toArray(): array
    {
        return array_filter([
            'code' => $this->code->value,
            'provider_status' => $this->providerStatus,
            'message' => $this->message,
            'meta' => $this->meta,
        ], static fn ($v) => $v !== null);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}