<?php declare(strict_types=1);

namespace Dgp\Sdk\Types\Service;

use JsonSerializable;
use Dgp\Sdk\Support\Serialization\Arrayable;

final readonly class ServiceFlag implements Arrayable, JsonSerializable
{
    /**
     * @param array<string,mixed>|null $meta
     */
    public function __construct(
        public string $id,                // e.g. "refill", "cancel", "dripfeed"
        public bool   $enabled,
        public string $description,        // MUST (UI + docs)
        public ?array $meta = null,        // flag-specific extras (bag)
    )
    {
    }

    public function toArray(): array
    {
        return array_filter([
            'id' => $this->id,
            'enabled' => $this->enabled,
            'description' => $this->description,
            'meta' => $this->meta,
        ], static fn($v) => $v !== null);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}