<?php

namespace Fifthgate\CalendarGenerator\Domain;

use Fifthgate\CalendarGenerator\Domain\Collection\CalendarHourCollection;
use Fifthgate\CalendarGenerator\Domain\Collection\Interfaces\CalendarHourCollectionInterface;
use Fifthgate\CalendarGenerator\Domain\Interfaces\CalendarDayInterface;
use Fifthgate\CalendarGenerator\Domain\AbstractCalendarPeriod;
use Fifthgate\CalendarGenerator\Domain\Collection\Interfaces\CalendarRenderableEventCollectionInterface;
use \DateTimeInterface;

class CalendarDay extends AbstractCalendarPeriod implements CalendarDayInterface
{
    protected $events;

    protected $hours;

    public function __construct(DateTimeInterface $periodStart, DateTimeInterface $periodEnd, string $machineName)
    {
        parent::__construct($periodStart, $periodEnd, $machineName);
        $hours = new CalendarHourCollection();

    }

    public function getPeriodType() : string
    {
        return 'day';
    }

    public function getDate() : DateTimeInterface
    {
        return $this->getPeriodStart();
    }

    public function injectEvents(CalendarRenderableEventCollectionInterface $events)
    {
        $this->events = $events;
    }

    public function getEvents() : ? CalendarRenderableEventCollectionInterface
    {
        return $this->events;
    }

    public function getHours(): CalendarHourCollectionInterface
    {
        return $this->hours;
    }
}
