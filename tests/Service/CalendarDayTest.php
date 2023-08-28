<?php

namespace Fifthgate\CalendarGenerator\Tests\Service;

use Fifthgate\CalendarGenerator\Domain\Collection\Interfaces\CalendarRenderableEventCollectionInterface;
use Fifthgate\CalendarGenerator\Domain\Interfaces\CalendarRenderableEventInterface;
use Fifthgate\CalendarGenerator\Service\CalendarGeneratorService;


class CalendarDayTest extends CalendarServiceTestCase
{
    public function testCalendarDay()
    {
        $startDate = new \DateTime('2012-01-01');
        $endDate = clone $startDate;
        $endDate->setTime(23, 59, 59);
        $calendarDay = CalendarGeneratorService::generateCalendarDay($startDate);
        $this->assertEquals('day', $calendarDay->getPeriodType());
        $this->assertTrue($calendarDay->isWithin($startDate, $endDate));
        $this->assertFalse($calendarDay->isWithin($startDate, $endDate, false));
        $events = $this->generateTestEvents('2012');
        $calendarDay->injectEvents($events);
        $this->assertTrue($calendarDay->hasEvents());
        $this->assertInstanceOf(CalendarRenderableEventCollectionInterface::class, $calendarDay->getEvents());
        $this->assertEquals(2, $calendarDay->getEvents()->count());

        foreach ($calendarDay->getEvents() as $event) {
            $this->assertInstanceOf(CalendarRenderableEventInterface::class, $event);
        }
    }

    public function testGetHours(): void {
        $startDate = new \DateTime('2023-06-27');
        $calendarDay = CalendarGeneratorService::generateCalendarDay($startDate);
        self::assertEquals(24, count($calendarDay->getHours()));
    }
}
