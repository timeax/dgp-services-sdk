<?php declare(strict_types=1);

namespace Dgp\Sdk\Types\Service;

use JsonSerializable;
use Dgp\Sdk\Support\Serialization\Arrayable;
use Dgp\Sdk\Support\Serialization\Normalizes;

final readonly class SpeedEstimate implements Arrayable, JsonSerializable
{
    use Normalizes;

    /**
     * @param float $amount Throughput amount (e.g. 500)
     * @param string $per Unit window (e.g. "minute"|"hour"|"day"|"week"|"month")
     * @param string $unit What the amount refers to (e.g. "followers", "likes", "units") (optional)
     * @param string|null $label Human hint (e.g. "500/day", "fast", "slow")
     * @param array<string,mixed>|null $meta
     */
    public function __construct(
        public float  $amount,
        public string $per,
        public string $unit,
        public ?string $label = null,
        public ?array  $meta = null,
    )
    {
    }

    public function toArray(): array
    {
        return $this->normalize([
            'amount' => $this->amount,
            'per' => $this->per,
            'unit' => $this->unit,
            'label' => $this->label,
            'meta' => $this->meta,
        ]);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}