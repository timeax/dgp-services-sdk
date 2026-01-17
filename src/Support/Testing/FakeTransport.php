<?php
declare(strict_types=1);

namespace Dgp\Sdk\Support\Testing;

use Closure;
use RuntimeException;
use Dgp\Sdk\Support\Result;
use Dgp\Sdk\Payloads\Requests\Infra\HttpRequestDto;
use Dgp\Sdk\Payloads\Responses\Infra\HttpResponseDto;
use Throwable;

/**
 * Simple queue-based transport fake.
 *
 * You can push:
 * - HttpResponseDto (auto wrapped into Result::ok)
 * - Result<HttpResponseDto>
 * - callable(HttpRequestDto): (HttpResponseDto|Result<HttpResponseDto>)
 * - Throwable (will be thrown)
 */
final class FakeTransport
{
    /** @var list<mixed> */
    private array $queue = [];

    /** @var list<HttpRequestDto> */
    private array $requests = [];

    public function push(HttpResponseDto|Result|Closure|Throwable $next): void
    {
        $this->queue[] = $next;
    }

    /**
     * @return list<HttpRequestDto>
     */
    public function requests(): array
    {
        return $this->requests;
    }

    public function lastRequest(): ?HttpRequestDto
    {
        return $this->requests ? $this->requests[array_key_last($this->requests)] : null;
    }

    public function reset(): void
    {
        $this->queue = [];
        $this->requests = [];
    }

    /**
     * Typical signature used by TransportContract implementations.
     *
     * @return Result<HttpResponseDto>
     * @throws Throwable
     * @throws Throwable
     */
    public function send(HttpRequestDto $request): Result
    {
        $this->requests[] = $request;

        if (!$this->queue) {
            throw new RuntimeException('FakeTransport queue is empty. Push a response before calling send().');
        }

        $next = array_shift($this->queue);

        if ($next instanceof Throwable) {
            throw $next;
        }

        if ($next instanceof Closure) {
            $next = $next($request);
        }

        if ($next instanceof Result) {
            return $next;
        }

        if ($next instanceof HttpResponseDto) {
            // Convention: Result::ok($value) exists in the SDK foundation.
            return Result::ok($next);
        }

        throw new RuntimeException('FakeTransport received an unsupported queued item.');
    }
}