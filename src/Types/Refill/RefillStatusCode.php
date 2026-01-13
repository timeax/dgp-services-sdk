<?php
declare(strict_types=1);

namespace Dgp\Sdk\Types\Refill;

enum RefillStatusCode: string
{
    case PENDING = 'pending';
    case PROCESSING = 'processing';
    case IN_PROGRESS = 'in_progress';
    case COMPLETED = 'completed';

    case REJECTED = 'rejected';
    case FAILED = 'failed';

    case UNKNOWN = 'unknown';
}