<?php

namespace Services\CalendarGenerator\Domain\Collection;

use Services\CalendarGenerator\Domain\Collection\Interfaces\CalendarPeriodCollectionInterface;
use Services\CalendarGenerator\Domain\Collection\Interfaces\CalendarMonthCollectionInterface;
use Services\CalendarGenerator\Domain\Collection\AbstractCalendarPeriodCollection;
use Services\CalendarGenerator\Domain\Collection\Interfaces\CalendarDayCollectionInterface;

class CalendarMonthCollection extends AbstractCalendarPeriodCollection implements CalendarMonthCollectionInterface
{
}