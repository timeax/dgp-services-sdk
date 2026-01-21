<?php declare(strict_types=1);

namespace Dgp\Sdk\Payloads\Requests\Contract;

use JsonSerializable;
use Dgp\Sdk\Support\Serialization\Normalizes;

final class QuoteContractRequest implements JsonSerializable
{
    use Normalizes;

    /**
     * @param string|int $service_id Provider service id from ServiceDefinition::id
     * @param array<string,mixed> $inputs Provider-specific inputs for this contract service
     * @param array<string,mixed>|null $meta Optional extras (bag)
     */
    public function __construct(
        public readonly string|int $service_id,
        public readonly array      $inputs,
        public readonly ?array     $meta = null,
    )
    {
    }

    public function jsonSerialize(): array
    {
        return $this->normalize([
            'service_id' => $this->service_id,
            'inputs' => $this->inputs,
            'meta' => $this->meta,
        ]);
    }
}