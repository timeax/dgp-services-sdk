<?php
declare(strict_types=1);

namespace Dgp\Sdk\Types\Orders;

enum OrderStatusCode: string
{
    case PENDING = 'pending';
    case PROCESSING = 'processing';
    case IN_PROGRESS = 'in_progress';
    case PARTIAL = 'partial';
    case COMPLETED = 'completed';

    case CANCELED = 'canceled';
    case REFUNDED = 'refunded';
    case FAILED = 'failed';

    case UNKNOWN = 'unknown';
}