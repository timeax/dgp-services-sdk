<?php declare(strict_types=1);

namespace Dgp\Sdk\Types\Contract;

use JsonSerializable;
use Dgp\Sdk\Support\Serialization\Arrayable;
use Dgp\Sdk\Support\Serialization\Normalizes;

final readonly class ContractStatus implements Arrayable, JsonSerializable
{
    use Normalizes;

    /**
     * @param array<string,mixed>|null $meta
     */
    public function __construct(
        public ContractStatusCode $code,
        public ?string $message = null,          // human-readable hint (optional)
        public ?string $raw_status = null,       // provider status string (optional)
        public ?int $progress = null,            // 0..100 (optional)
        public ?string $updated_at = null,       // ISO string (optional)
        public ?array $meta = null,              // provider extras (bag)
    ) {}

    public function isTerminal(): bool
    {
        return $this->code->isTerminal();
    }

    public function toArray(): array
    {
        return $this->normalize([
            'code' => $this->code->value,
            'message' => $this->message,
            'raw_status' => $this->raw_status,
            'progress' => $this->progress,
            'updated_at' => $this->updated_at,
            'meta' => $this->meta,
        ]);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}