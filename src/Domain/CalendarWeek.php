<?php

namespace Fifthgate\CalendarGenerator\Domain;

use Fifthgate\CalendarGenerator\Domain\Interfaces\CalendarDayInterface;
use Fifthgate\CalendarGenerator\Domain\Interfaces\CalendarWeekInterface;
use Fifthgate\CalendarGenerator\Domain\AbstractCalendarPeriod;
use Fifthgate\CalendarGenerator\Domain\Collection\Interfaces\CalendarDayCollectionInterface;
use Fifthgate\CalendarGenerator\Domain\Collection\Interfaces\CalendarWeekCollectionInterface;
use Fifthgate\CalendarGenerator\Domain\Collection\Interfaces\CalendarRenderableEventCollectionInterface;

class CalendarWeek extends AbstractCalendarPeriod implements CalendarWeekInterface
{
    protected CalendarDayCollectionInterface $days;

    protected int $weekNumber;

    public function getPeriodType() : string
    {
        return 'week';
    }


    public function setDays(CalendarDayCollectionInterface $days)
    {
        $this->days = $days;
    }

    public function getDays() : CalendarDayCollectionInterface
    {
        return $this->days;
    }

    public function getDay(int $dayNumber) : ? CalendarDayInterface
    {
        foreach ($this->days as $day) {
            if ($day->getPeriodStart()->format('j') == $dayNumber) {
                return $day;
            }
        }
        return null;
    }

    public function injectEvents(CalendarRenderableEventCollectionInterface $events) : CalendarWeekInterface
    {
        $this->events = $events;

        foreach ($this->getDays() as $day) {
            $day->injectEvents($events->filterBetweenDates($day->getPeriodStart(), $day->getPeriodEnd()));
        }

        return $this;
    }

    public function getEvents() : ? CalendarRenderableEventCollectionInterface
    {
        return $this->events;
    }

    public function setISOWeekNumber(string $weekNumber)
    {
        $this->weekNumber = $weekNumber;
    }

    public function getISOWeekNumber(): string
    {
        return $this->weekNumber;
    }
}
