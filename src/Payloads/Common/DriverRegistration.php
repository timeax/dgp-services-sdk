<?php
declare(strict_types=1);

namespace Dgp\Sdk\Payloads\Common;

use Dgp\Sdk\Contracts\Driver\DriverLinkContract;
use JsonSerializable;

final readonly class DriverRegistration implements JsonSerializable
{
    /**
     * @param int|string $handlerId Host identifier (typically your dgp_handler id)
     * @param string $driverKey Registered driver key
     * @param class-string<DriverLinkContract> $linkClass Host adapter class to instantiate from handlerId
     * @param array<string,mixed> $meta Optional host metadata (label, group, etc.)
     */
    public function __construct(
        public int|string $handlerId,
        public string $driverKey,
        public string $linkClass,
        public array $meta = [],
    ) {}

    public function jsonSerialize(): array
    {
        return array_filter([
            'handlerId' => $this->handlerId,
            'driverKey' => $this->driverKey,
            'linkClass' => $this->linkClass,
            'meta' => $this->meta ?: null,
        ], static fn ($v) => $v !== null);
    }
}