<?php
declare(strict_types=1);

namespace Dgp\Sdk\Payloads\Responses\Ops;

use JsonSerializable;

final class AuditRecordResponse implements JsonSerializable
{
    public function __construct(
        public readonly bool $recorded = true,
        public readonly ?string $recordId = null,
    ) {}

    public function jsonSerialize(): array
    {
        return array_filter([
            'recorded' => $this->recorded,
            'recordId' => $this->recordId,
        ], static fn ($v) => $v !== null);
    }
}