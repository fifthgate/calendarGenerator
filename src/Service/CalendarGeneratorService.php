<?php

namespace Fifthgate\CalendarGenerator\Service;

use Carbon\CarbonInterface;
use Fifthgate\CalendarGenerator\Service\Interfaces\CalendarGeneratorServiceInterface;
use Fifthgate\CalendarGenerator\Domain\Interfaces\CalendarYearInterface;
use Fifthgate\CalendarGenerator\Domain\Interfaces\CalendarMonthInterface;
use Fifthgate\CalendarGenerator\Domain\Interfaces\CalendarWeekInterface;
use Fifthgate\CalendarGenerator\Domain\Interfaces\CalendarDayInterface;
use Fifthgate\CalendarGenerator\Domain\Collection\CalendarMonthCollection;
use Fifthgate\CalendarGenerator\Domain\Collection\CalendarWeekCollection;
use Fifthgate\CalendarGenerator\Domain\Collection\CalendarHourCollection;
use Fifthgate\CalendarGenerator\Domain\CalendarYear;
use Fifthgate\CalendarGenerator\Domain\CalendarMonth;
use Fifthgate\CalendarGenerator\Domain\CalendarDay;
use Fifthgate\CalendarGenerator\Domain\CalendarWeek;
use \DateInterval;
use \DatePeriod;
use \DateTimeInterface;
use Carbon\Carbon;

class CalendarGeneratorService implements CalendarGeneratorServiceInterface
{
    protected array $yearsCache;

    public function __construct(array $yearsCache)
    {
        $this->yearsCache = $yearsCache;
    }

    public static function getFirstDayOfWeek(\DateTimeInterface $day): DateTimeInterface {

        $firstDayOfWeek = new Carbon($day);
        return $firstDayOfWeek->startOfWeek(CarbonInterface::SUNDAY);
    }

    public static function getLastDayOfWeek(\DateTimeInterface $day): DateTimeInterface {
        $lastDayOfWeek = new Carbon($day);
        $lastDayOfWeek->endOfWeek(CarbonInterface::SATURDAY);
        return $lastDayOfWeek;
    }

    public static function generateCalendarYear(int $year) : CalendarYearInterface
    {
        $yearStart = new \DateTime("01-01-{$year} 00:00:00");
        $yearEnd = new \DateTime("31-12-{$year} 23:59:59");
        
        $monthInterval = new DateInterval('P1M');
        $months = new DatePeriod($yearStart, $monthInterval, $yearEnd);

        $calendarYear = new CalendarYear($yearStart, $yearEnd, "year_{$year}");
        $calendarYear->setPeriodName($year);
        $monthCollection = new CalendarMonthCollection;

        foreach ($months as $monthStart) {
            $monthCollection->add(self::generateCalendarMonth($monthStart));
        }

        $calendarYear->setMonths($monthCollection);
        return $calendarYear;
    }

    public static function generateCalendarMonth(DateTimeInterface $monthStart) : CalendarMonthInterface
    {
        $monthStart = new Carbon($monthStart);
        $monthEnd = clone $monthStart;
        $monthEnd->lastOfMonth();
        $dayCollection = new CalendarHourCollection;
        
        $weekCollection = new CalendarWeekCollection;
        
        $machineName = strtolower($monthStart->format('M')).'_'.$monthStart->format('Y');
        $calendarMonth = new CalendarMonth($monthStart, $monthEnd, $machineName);
        
        $dayInterval = new DateInterval('P1D');
        $weekInterval = new DateInterval('P7D');

        $firstWeekDayOfMonth = self::getFirstDayOfWeek($monthStart);


        $lastWeekDayOfMonth = self::getLastDayOfWeek($monthEnd);


        $calendarMonth->setPeriodName($monthStart->format('F'));

        $days = new DatePeriod($monthStart, $dayInterval, $monthEnd);
        $weeks = new DatePeriod($firstWeekDayOfMonth, $weekInterval, $lastWeekDayOfMonth);

        foreach ($weeks as $weekStart) {
            $weekCollection->add(self::generateCalendarWeek($weekStart));
        }

        foreach ($days as $day) {
            $dayCollection->add(self::generateCalendarDay($day));
        }
        $calendarMonth->setDays($dayCollection);
        $calendarMonth->setWeeks($weekCollection);
        return $calendarMonth;
    }

    public static function generateCalendarWeek(DateTimeInterface $weekStart) : CalendarWeekInterface
    {
        $weekEnd = self::getLastDayOfWeek($weekStart);
        $machineName = 'week_'.$weekStart->format('W').'_'.$weekStart->format('Y');
        $calendarWeek = new CalendarWeek($weekStart, $weekEnd, $machineName);
        $calendarWeek->setISOWeekNumber($weekStart->format('W'));
        $dayInterval = new DateInterval('P1D');
        $days = new DatePeriod($weekStart, $dayInterval, $weekEnd);
        $dayCollection = new CalendarHourCollection;
        foreach ($days as $day) {
            $dayCollection->add(self::generateCalendarDay($day));
        }
        $calendarWeek->setDays($dayCollection);
        return $calendarWeek;
    }
    
    public static function generateCalendarDay(DateTimeInterface $dayStart) : CalendarDayInterface
    {
        $dayEnd = clone $dayStart;
        $dayEnd->setTime(23, 59, 59);
        $machineName = $dayStart->format('Y-m-d');
        $calendarDay = new CalendarDay($dayStart, $dayEnd, $machineName);
        $calendarDay->setPeriodName($dayStart->format('d'));
        return $calendarDay;
    }

    public function getCalendarForYear(int $year) : CalendarYearInterface
    {
        return isset($this->yearsCache[$year]) ? $this->yearsCache[$year] : self::generateCalendarYear($year);
    }
}
