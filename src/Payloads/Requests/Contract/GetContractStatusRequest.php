<?php declare(strict_types=1);

namespace Dgp\Sdk\Payloads\Requests\Contract;

use JsonSerializable;
use Dgp\Sdk\Support\Serialization\Normalizes;
use Dgp\Sdk\Types\Contract\ContractRef;

final class GetContractStatusRequest implements JsonSerializable
{
    use Normalizes;

    /**
     * @param array<string,mixed>|null $meta Optional extras (bag)
     */
    public function __construct(
        public readonly ContractRef $contract,
        public readonly ?array $meta = null,
    ) {}

    public function jsonSerialize(): array
    {
        return $this->normalize([
            'contract' => $this->contract,
            'meta' => $this->meta,
        ]);
    }
}