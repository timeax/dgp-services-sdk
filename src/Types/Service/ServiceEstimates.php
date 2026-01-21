<?php declare(strict_types=1);

namespace Dgp\Sdk\Types\Service;

use JsonSerializable;
use Dgp\Sdk\Support\Serialization\Arrayable;
use Dgp\Sdk\Support\Serialization\Normalizes;

final readonly class ServiceEstimates implements Arrayable, JsonSerializable
{
    use Normalizes;

    /**
     * @param array<string,mixed>|null $meta
     */
    public function __construct(
        public ?TimeRangeEstimate $start = null,
        public ?SpeedEstimate $speed = null,
        public ?TimeRangeEstimate $average = null,
        public ?array $meta = null,
    ) {}

    public function toArray(): array
    {
        return $this->normalize([
            'start' => $this->start,
            'speed' => $this->speed,
            'average' => $this->average,
            'meta' => $this->meta,
        ]);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}