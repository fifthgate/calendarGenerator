<?php

declare(strict_types=1);

namespace Fifthgate\CalendarGenerator\Domain\Interfaces;

use Fifthgate\CalendarGenerator\Domain\Collection\Interfaces\CalendarHourCollectionInterface;

use \DateTimeInterface;

interface CalendarDayInterface extends CalendarPeriodInterface
{
    public function getDate() : DateTimeInterface;

    public function getHours(): CalendarHourCollectionInterface;
}
