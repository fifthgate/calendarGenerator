<?php

namespace Fifthgate\CalendarGenerator\Domain\Collection\Interfaces;

use \DateTimeInterface;
use Fifthgate\Objectivity\Core\Domain\Collection\Interfaces\DomainEntityCollectionInterface;

interface CalendarRenderableEventCollectionInterface
{
    public function filterBetweenDates(DateTimeInterface $start, DateTimeInterface $end, bool $includeEndPoints = true, bool $allowOverlaps = true) : ? CalendarRenderableEventCollectionInterface;
}
