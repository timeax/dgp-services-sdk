<?php declare(strict_types=1);

namespace Dgp\Sdk\Payloads\Requests\Contract;

use JsonSerializable;
use Dgp\Sdk\Support\Serialization\Normalizes;
use Dgp\Sdk\Types\Contract\ContractQuoteRef;

final class CreateContractRequest implements JsonSerializable
{
    use Normalizes;

    /**
     * @param string|int $service_id Provider service id from ServiceDefinition::id
     * @param array<string,mixed> $inputs Same inputs used to generate the quote (host should reuse)
     * @param array<string,mixed>|null $meta Optional extras (bag)
     */
    public function __construct(
        public readonly string|int       $service_id,
        public readonly ContractQuoteRef $quote,
        public readonly array            $inputs,
        public readonly ?array           $meta = null,
    )
    {
    }

    public function jsonSerialize(): array
    {
        return $this->normalize([
            'service_id' => $this->service_id,
            'quote' => $this->quote,
            'inputs' => $this->inputs,
            'meta' => $this->meta,
        ]);
    }
}