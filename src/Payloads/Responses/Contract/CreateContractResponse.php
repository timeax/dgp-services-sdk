<?php declare(strict_types=1);

namespace Dgp\Sdk\Payloads\Responses\Contract;

use JsonSerializable;
use Dgp\Sdk\Support\Serialization\Normalizes;
use Dgp\Sdk\Types\Contract\ContractRef;
use Dgp\Sdk\Types\Contract\ContractStatus;

final readonly class CreateContractResponse implements JsonSerializable
{
    use Normalizes;

    /**
     * @param array<string,mixed>|null $meta
     */
    public function __construct(
        public ContractRef $contract,
        public ContractStatus $status,
        public ?array $meta = null,
    ) {}

    public function jsonSerialize(): array
    {
        return $this->normalize([
            'contract' => $this->contract,
            'status' => $this->status,
            'meta' => $this->meta,
        ]);
    }
}