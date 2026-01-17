<?php
declare(strict_types=1);

namespace Dgp\Sdk\Types\Driver;

use JsonSerializable;
use Dgp\Sdk\Support\Serialization\Arrayable;
use Dgp\Sdk\Support\Serialization\Normalizes;

final class DriverManifest implements Arrayable, JsonSerializable
{
    use Normalizes;

    /**
     * @param array<string,bool>|null $lanes
     * @param array<string,bool>|null $features
     * @param array<string,mixed>|null $meta
     */
    public function __construct(
        public readonly string $driver_key,              // stable key Host registers/resolves by
        public readonly string $name,                    // display name
        public readonly ?string $version = null,         // semantic version (optional)
        public readonly ?ProviderInfo $provider = null,  // who/where this provider is

        // minimal lane flags (Host can still verify via instanceof)
        public readonly ?array $lanes = null,            // e.g. ['lane_a' => true, 'lane_b' => false]

        // optional feature flags (cancel/refill/bulk/etc)
        public readonly ?array $features = null,         // e.g. ['refill' => true, 'bulk' => false]

        // optional: driver-level config schema (Host may validate/render)
        public readonly ?DriverConfigSchema $config_schema = null,

        public readonly ?array $meta = null,
    ) {}

    public function toArray(): array
    {
        return $this->normalize([
            'driver_key' => $this->driver_key,
            'name' => $this->name,
            'version' => $this->version,
            'provider' => $this->provider,
            'lanes' => $this->lanes,
            'features' => $this->features,
            'config_schema' => $this->config_schema,
            'meta' => $this->meta,
        ]);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}