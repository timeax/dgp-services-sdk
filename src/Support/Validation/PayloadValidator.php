<?php
declare(strict_types=1);

namespace Dgp\Sdk\Support\Validation;

use Dgp\Sdk\Support\Exceptions\ValidationException;

final class PayloadValidator
{
    /**
     * Pre-flight validation hook.
     * Keep it strict: throw ValidationException for invariant issues.
     */
    public function assertValid(mixed $dto): void
    {
        // TODO: implement per-DTO rules or attribute-based constraints.
        // This is intentionally a stub in Step 1.
        if ($dto === null) {
            throw new ValidationException('DTO must not be null');
        }
    }
}