<?php
declare(strict_types=1);

namespace Dgp\Sdk\Contracts\Ops;

use Dgp\Sdk\Support\Result;
use Dgp\Sdk\Payloads\Requests\Ops\AuditRecordRequest;

interface AuditTrailContract
{
    /**
     * Record an audit snapshot/hook (request/response/error).
     *
     * @return Result<\Dgp\Sdk\Payloads\Responses\Ops\AuditRecordResponse>
     */
    public function recordAudit(AuditRecordRequest $request): Result;
}