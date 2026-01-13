<?php
declare(strict_types=1);

namespace Dgp\Sdk\Types\Infra;

enum HttpMethod: string
{
    case GET = 'GET';
    case POST = 'POST';
    case PUT = 'PUT';
    case PATCH = 'PATCH';
    case DELETE = 'DELETE';
}