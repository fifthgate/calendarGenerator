<?php

declare(strict_types=1);

namespace Fifthgate\CalendarGenerator\Domain;

use Fifthgate\CalendarGenerator\Domain\Collection\Interfaces\CalendarRenderableEventCollectionInterface;

class CalendarHour extends AbstractCalendarPeriod
{

    protected CalendarRenderableEventCollectionInterface $events;

    public function injectEvents(CalendarRenderableEventCollectionInterface $events)
    {
        $this->events = $events;
    }

    public function getEvents(): ?CalendarRenderableEventCollectionInterface
    {
        return $this->events;
    }

    public function getPeriodType(): string
    {
        return 'hour';
    }
}