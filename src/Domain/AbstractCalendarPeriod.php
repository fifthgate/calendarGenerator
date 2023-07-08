<?php

namespace Fifthgate\CalendarGenerator\Domain;

use Fifthgate\CalendarGenerator\Domain\Interfaces\CalendarPeriodInterface;
use Fifthgate\CalendarGenerator\Domain\Collection\Interfaces\CalendarRenderableEventCollectionInterface;
use \DateTimeInterface;

abstract class AbstractCalendarPeriod implements CalendarPeriodInterface
{
    protected string $name;

    protected \DateTimeInterface $periodStart;

    protected \DateTimeInterface $periodEnd;

    protected CalendarRenderableEventCollectionInterface $events;

    protected string $machineName;

    public function __construct(
        DateTimeInterface $periodStart,
        DateTimeInterface $periodEnd,
        string $machineName
    ) {
        $this->periodStart = $periodStart;
        $this->periodEnd = $periodEnd;
        $this->machineName = $machineName;
    }

    public function setPeriodName(string $name)
    {
        $this->name = $name;
    }

    public function getPeriodName() : string
    {
        return $this->name;
    }

    public function getMachineName() : string
    {
        return $this->machineName;
    }

    public function getPeriodStart() : DateTimeInterface
    {
        return $this->periodStart;
    }

    public function getPeriodEnd() : DateTimeInterface
    {
        return $this->periodEnd;
    }

    abstract public function injectEvents(CalendarRenderableEventCollectionInterface $events);

    abstract public function getEvents() : ? CalendarRenderableEventCollectionInterface;

    public function isWithin(DateTimeInterface $start, DateTimeInterface $end, bool $inclusive = true): bool
    {
        return $inclusive ? $this->getPeriodStart() >= $start && $this->getPeriodEnd() <= $end : $this->getPeriodStart() > $start && $this->getPeriodEnd() < $end;
    }

    public function hasEvents() : bool
    {
        return (isset($this->events) && !$this->events->isEmpty());
    }
}
