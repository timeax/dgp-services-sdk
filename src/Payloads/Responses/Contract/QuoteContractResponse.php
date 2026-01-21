<?php declare(strict_types=1);

namespace Dgp\Sdk\Payloads\Responses\Contract;

use JsonSerializable;
use Dgp\Sdk\Support\Serialization\Normalizes;
use Dgp\Sdk\Types\Contract\ContractQuote;

final readonly class QuoteContractResponse implements JsonSerializable
{
    use Normalizes;

    /**
     * @param array<string,mixed>|null $meta
     */
    public function __construct(
        public ContractQuote $quote,
        public ?array $meta = null,
    ) {}

    public function jsonSerialize(): array
    {
        return $this->normalize([
            'quote' => $this->quote,
            'meta' => $this->meta,
        ]);
    }
}