<?php
declare(strict_types=1);

namespace Dgp\Sdk\Types\Ops;

enum HealthState: string
{
    case OK = 'ok';
    case DEGRADED = 'degraded';
    case DOWN = 'down';
    case UNKNOWN = 'unknown';
}