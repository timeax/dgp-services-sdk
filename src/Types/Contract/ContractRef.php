<?php declare(strict_types=1);

namespace Dgp\Sdk\Types\Contract;

use JsonSerializable;
use Dgp\Sdk\Support\Serialization\Arrayable;
use Dgp\Sdk\Support\Serialization\Normalizes;

final readonly class ContractRef implements Arrayable, JsonSerializable
{
    use Normalizes;

    /**
     * @param string|int $id Provider contract id
     * @param array<string,mixed>|null $meta
     */
    public function __construct(
        public string|int $id,
        public ?array $meta = null,
    ) {}

    public function toArray(): array
    {
        return $this->normalize([
            'id' => $this->id,
            'meta' => $this->meta,
        ]);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}