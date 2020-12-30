<?php

namespace Fifthgate\CalendarGenerator\Domain\Collection;

use Fifthgate\CalendarGenerator\Domain\Collection\Interfaces\CalendarRenderableEventCollectionInterface;
use Fifthgate\CalendarGenerator\Domain\Collection\Traits\CalendarEventCollectionFilterTrait;
use Fifthgate\Objectivity\Domain\Collection\AbstractDomainEntityCollection;

class CalendarEventCollection extends AbstractDomainEntityCollection implements CalendarRenderableEventCollectionInterface
{
    use CalendarEventCollectionFilterTrait;
}
