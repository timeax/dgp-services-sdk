<?php
declare(strict_types=1);

namespace Dgp\Sdk\Payloads\Responses\Discovery;

use JsonSerializable;
use Dgp\Sdk\Support\Serialization\Normalizes;
use Dgp\Sdk\Types\Driver\DriverManifest;

final class GetDriverManifestResponse implements JsonSerializable
{
    use Normalizes;

    public function __construct(
        public readonly DriverManifest $manifest,
    ) {}

    public function jsonSerialize(): array
    {
        return $this->normalize([
            'manifest' => $this->manifest,
        ]);
    }
}