<?php

namespace Fifthgate\CalendarGenerator\Domain\Collection\Interfaces;

use \DateTimeInterface;

interface CalendarRenderableEventCollectionInterface extends CollectionInterface
{
    public function filterBetweenDates(DateTimeInterface $start, DateTimeInterface $end, bool $includeEndPoints = true, bool $allowOverlaps = true) : ? CalendarRenderableEventCollectionInterface;
}
