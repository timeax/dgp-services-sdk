<?php
declare(strict_types=1);

namespace Dgp\Sdk\Types\DripFeed;

enum DripFeedStatusCode: string
{
    case PENDING   = 'pending';
    case ACTIVE    = 'active';
    case PAUSED    = 'paused';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';
    case FAILED    = 'failed';
    case UNKNOWN   = 'unknown';
}