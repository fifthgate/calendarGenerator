<?php

namespace Fifthgate\CalendarGenerator\Tests\Service;

use Carbon\Carbon;
use Fifthgate\CalendarGenerator\Domain\Collection\Interfaces\CalendarRenderableEventCollectionInterface;
use Fifthgate\CalendarGenerator\Domain\Interfaces\CalendarRenderableEventInterface;
use Fifthgate\CalendarGenerator\Service\CalendarGeneratorService;

class CalendarWeekTest extends CalendarServiceTestCase
{
    public function testCalendarWeek()
    {
        $startDate = new Carbon('2012-01-01');
        $endDate = CalendarGeneratorService::getLastDayOfWeek($startDate);

        $calendarWeek = CalendarGeneratorService::generateCalendarWeek($startDate);
        $this->assertEquals('week', $calendarWeek->getPeriodType());
        $events = $this->generateTestEvents('2012');
        $calendarWeek->injectEvents($events);
        $this->assertTrue($calendarWeek->isWithin($startDate, $endDate));
        $this->assertFalse($calendarWeek->isWithin($startDate, $endDate, false));
        $this->assertTrue($calendarWeek->hasEvents());
        $this->assertInstanceOf(CalendarRenderableEventCollectionInterface::class, $calendarWeek->getEvents());
        $this->assertEquals(2, $calendarWeek->getEvents()->count());
        foreach ($calendarWeek->getEvents() as $event) {
            $this->assertInstanceOf(CalendarRenderableEventInterface::class, $event);
        }
    }
}
