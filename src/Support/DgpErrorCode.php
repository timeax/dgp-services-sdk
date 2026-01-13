<?php
declare(strict_types=1);

namespace Dgp\Sdk\Support;

enum DgpErrorCode: string
{
    case UNKNOWN            = 'unknown';

    // request/validation
    case INVALID_PARAMS     = 'invalid_params';
    case VALIDATION_FAILED  = 'validation_failed';
    case UNSUPPORTED        = 'unsupported';

    // auth / config
    case AUTH_FAILED        = 'auth_failed';
    case MISCONFIGURED      = 'misconfigured';

    // provider/business
    case INSUFFICIENT_FUNDS = 'insufficient_funds';
    case PROVIDER_ERROR     = 'provider_error';

    // infra/flow control
    case RATE_LIMITED       = 'rate_limited';
    case TEMPORARY_FAILURE  = 'temporary_failure';
    case TRANSPORT_ERROR    = 'transport_error';
}