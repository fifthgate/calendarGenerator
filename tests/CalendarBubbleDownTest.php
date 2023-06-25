<?php

namespace Fifthgate\CalendarGenerator\Tests;

use Fifthgate\CalendarGenerator\Domain\Interfaces\CalendarWeekInterface;
use Fifthgate\CalendarGenerator\Domain\Interfaces\CalendarDayInterface;

use \DateTimeInterface;

class CalendarBubbleDownTest extends CalendarServiceTestCase
{
    public function testCalendarBubbledown()
    {
        $year = date('Y');
        $calendarYear = $this->calendarService->getCalendarForYear($year);
        $events = $this->generateTestEvents($year);

        $calendarYear->injectEvents($events);

        //This month has one test event, from 1st to 2nd of January.
        $month = $calendarYear->getMonth(1);

        $this->assertTrue($month->hasEvents());
        $this->assertEquals(1, $month->getEvents()->count());

        //Now we drill down to the week.
        $week = $month->getNthWeek(1);

        $this->assertTrue($week->hasEvents());
        $this->assertEquals(1, $week->getEvents()->count());

        $isoWeek = $month->getWeekByISOWeekNumber("01");
        $this->assertInstanceOf(CalendarWeekInterface::class, $isoWeek);
        $this->assertNull($month->getWeekByISOWeekNumber("45"));

        $weekDay = $week->getDay(1);
        $this->assertInstanceOf(CalendarDayInterface::class, $weekDay);
        $this->assertNull($week->getDay(45));

        $this->assertInstanceOf(DateTimeInterface::class, $weekDay->getDate());
        $monthDay = $month->getDay(1);
        $this->assertEquals($weekDay, $monthDay);
        $this->assertNull($month->getDay(45));
        $this->assertNull($calendarYear->getMonth(13));
    }
}
