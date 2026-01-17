<?php
declare(strict_types=1);

namespace Dgp\Sdk\Types\Driver;

use JsonSerializable;
use Dgp\Sdk\Support\Serialization\Arrayable;
use Dgp\Sdk\Support\Serialization\Normalizes;

final class ProviderInfo implements Arrayable, JsonSerializable
{
    use Normalizes;

    /**
     * @param array<string,mixed>|null $meta
     */
    public function __construct(
        public readonly ?string $vendor = null,
        public readonly ?string $website = null,
        public readonly ?string $docs = null,
        public readonly ?string $support = null,
        public readonly ?array $meta = null,
    ) {}

    public function toArray(): array
    {
        return $this->normalize([
            'vendor' => $this->vendor,
            'website' => $this->website,
            'docs' => $this->docs,
            'support' => $this->support,
            'meta' => $this->meta,
        ]);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}