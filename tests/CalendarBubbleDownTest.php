<?php

namespace Fifthgate\CalendarGenerator\Tests;

use Fifthgate\CalendarGenerator\Domain\Collection\CalendarEventCollection;
use Fifthgate\CalendarGenerator\Domain\GenericCalendarEvent;
use Fifthgate\CalendarGenerator\Domain\Interfaces\CalendarWeekInterface;
use Fifthgate\CalendarGenerator\Domain\Interfaces\CalendarDayInterface;

use \DateTimeInterface;

class CalendarBubbleDownTest extends CalendarServiceTestCase
{
    public function testCalendarBubbledown()
    {
        $year = 2023;
        
        $calendarYear = $this->calendarService->getCalendarForYear(2023);
        

        $events = new CalendarEventCollection();
        $event = new GenericCalendarEvent("Test Title", "Test Body", new \DateTime("2023-01-01"), new \DateTime("2023-01-02"));
        $events->add($event);
        $calendarYear->injectEvents($events);



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
