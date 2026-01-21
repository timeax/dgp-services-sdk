<?php declare(strict_types=1);

namespace Dgp\Sdk\Types\Contract;

use JsonSerializable;
use Dgp\Sdk\Support\Serialization\Arrayable;
use Dgp\Sdk\Support\Serialization\Normalizes;

final readonly class ContractQuote implements Arrayable, JsonSerializable
{
    use Normalizes;

    /**
     * @param array<string,mixed>|null $meta
     * @param list<string>|null $warnings
     */
    public function __construct(
        public ContractQuoteRef $quote,
        public string|int       $service_id,

        public ?float           $estimated_total = null,     // provider-centric; host can convert to Money
        public ?string          $currency = null,           // optional hint (host may ignore)
        public ?string          $expires_at = null,         // ISO string (optional)
        public ?array           $warnings = null,            // non-fatal warnings
        public ?array           $meta = null,
    )
    {
    }

    public function toArray(): array
    {
        return $this->normalize([
            'quote' => $this->quote,
            'service_id' => $this->service_id,
            'estimated_total' => $this->estimated_total,
            'currency' => $this->currency,
            'expires_at' => $this->expires_at,
            'warnings' => $this->warnings,
            'meta' => $this->meta,
        ]);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}