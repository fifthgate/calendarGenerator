<?php

namespace Fifthgate\CalendarGenerator\Tests\Service;

use Fifthgate\CalendarGenerator\Domain\Collection\Interfaces\CalendarRenderableEventCollectionInterface;
use Fifthgate\CalendarGenerator\Domain\Interfaces\CalendarRenderableEventInterface;
use Fifthgate\CalendarGenerator\Service\CalendarGeneratorService;
use Tests\TestCase;

class CalendarMonthTest extends CalendarServiceTestCase
{
    public function testCalendarMonth()
    {
        $startDate = new \DateTime('2012-01-01');
        $endDate = clone $startDate;
        $endDate = $endDate->modify('last day of this month');
        $calendarMonth = CalendarGeneratorService::generateCalendarMonth($startDate, $endDate);
        $this->assertEquals('month', $calendarMonth->getPeriodType());
        $events = $this->generateTestEvents('2012');
        $calendarMonth->injectEvents($events);
        $this->assertTrue($calendarMonth->isWithin($startDate, $endDate));
        
        $this->assertTrue($calendarMonth->hasEvents());
        $this->assertTrue($calendarMonth->isWithin($startDate, $endDate));
        $this->assertFalse($calendarMonth->isWithin($startDate, $endDate, false));
        $this->assertInstanceOf(CalendarRenderableEventCollectionInterface::class, $calendarMonth->getEvents());
        $this->assertEquals(2, $calendarMonth->getEvents()->count());
        foreach ($calendarMonth->getEvents() as $event) {
            $this->assertInstanceOf(CalendarRenderableEventInterface::class, $event);
        }
    }
}
