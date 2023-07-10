<?php

namespace Fifthgate\CalendarGenerator\Service\Interfaces;

use Fifthgate\CalendarGenerator\Domain\Interfaces\CalendarYearInterface;
use Fifthgate\CalendarGenerator\Domain\Interfaces\CalendarMonthInterface;
use Fifthgate\CalendarGenerator\Domain\Interfaces\CalendarWeekInterface;
use Fifthgate\CalendarGenerator\Domain\Interfaces\CalendarDayInterface;
use Fifthgate\CalendarGenerator\Domain\Collection\Interfaces\CalendarHourCollectionInterface;
use \DateTimeInterface;

interface CalendarGeneratorServiceInterface
{
    public static function generateCalendarYear(int $year) : CalendarYearInterface;

    public static function getTopOfCurrentHour(): \DateTimeInterface;

    public static function getFirstDayOfWeek(\DateTimeInterface $day): \DateTimeInterface;

    public static function getLastDayOfWeek(\DateTimeInterface $day): \DateTimeInterface;

    public static function generateCalendarMonth(DateTimeInterface $monthStart) : CalendarMonthInterface;

    public static function generateCalendarWeek(DateTimeInterface $weekStart) : CalendarWeekInterface;

    public static function generateCalendarDay(DateTimeInterface $dayStart) : CalendarDayInterface;

    public static function generateCalendarHours(\DateTimeInterface $dayStart): CalendarHourCollectionInterface;
}
