<?php declare(strict_types=1);

namespace Dgp\Sdk\Types\Service;

use JsonSerializable;
use Dgp\Sdk\Support\Serialization\Arrayable;
use Dgp\Sdk\Support\Serialization\Normalizes;

final readonly class TimeRangeEstimate implements Arrayable, JsonSerializable
{
    use Normalizes;

    /**
     * @param int $min_seconds Minimum estimate in seconds (machine)
     * @param int $max_seconds Maximum estimate in seconds (machine)
     * @param string|null $label Human hint (e.g. "instant", "5-30 mins", "1-2 hrs")
     * @param array<string,mixed>|null $meta
     */
    public function __construct(
        public int     $min_seconds,
        public int     $max_seconds,
        public ?string $label = null,
        public ?array  $meta = null,
    )
    {
    }

    public function toArray(): array
    {
        return $this->normalize([
            'min_seconds' => $this->min_seconds,
            'max_seconds' => $this->max_seconds,
            'label' => $this->label,
            'meta' => $this->meta,
        ]);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}