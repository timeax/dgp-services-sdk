<?php declare(strict_types=1);

namespace Dgp\Sdk\Types\Contract;

enum ContractStatusCode: string
{
    case submitted = 'submitted';
    case reviewing = 'reviewing';
    case accepted = 'accepted';
    case rejected = 'rejected';

    case in_progress = 'in_progress';
    case delivered = 'delivered';
    case completed = 'completed';

    case cancelled = 'cancelled';
    case failed = 'failed';

    public function isTerminal(): bool
    {
        return match ($this) {
            self::rejected,
            self::completed,
            self::cancelled,
            self::failed => true,
            default => false,
        };
    }
}