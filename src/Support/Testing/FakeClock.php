<?php
declare(strict_types=1);

namespace Dgp\Sdk\Support\Testing;

use DateInterval;
use DateTimeImmutable;

final class FakeClock
{
    private DateTimeImmutable $now;

    public function __construct(?DateTimeImmutable $now = null)
    {
        $this->now = $now ?? new DateTimeImmutable('now');
    }

    public function now(): DateTimeImmutable
    {
        return $this->now;
    }

    public function setNow(DateTimeImmutable $now): void
    {
        $this->now = $now;
    }

    public function travel(DateInterval $interval): void
    {
        $this->now = $this->now->add($interval);
    }

    public function travelSeconds(int $seconds): void
    {
        $this->now = $this->now->modify(($seconds >= 0 ? '+' : '') . $seconds . ' seconds');
    }

    public function travelMinutes(int $minutes): void
    {
        $this->now = $this->now->modify(($minutes >= 0 ? '+' : '') . $minutes . ' minutes');
    }
}