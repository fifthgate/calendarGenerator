<?php

namespace Fifthgate\CalendarGenerator\Domain\Collection;

use Fifthgate\CalendarGenerator\Domain\Collection\Interfaces\CalendarRenderableEventCollectionInterface;
use Fifthgate\CalendarGenerator\Domain\Collection\Traits\CalendarEventCollectionFilterTrait;
use Fifthgate\CalendarGenerator\Domain\Collection\AbstractCollection;

class CalendarEventCollection extends AbstractCollection implements CalendarRenderableEventCollectionInterface
{
    use CalendarEventCollectionFilterTrait;
}
