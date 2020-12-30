<?php

namespace Tests\Feature\Calendar;

use Fifthgate\CalendarGenerator\Tests\CalendarServiceTestCase;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Services\CalendarGenerator\Domain\Interfaces\CalendarYearInterface;
use Services\CalendarGenerator\Domain\Collection\Interfaces\CalendarMonthCollectionInterface;
use Services\CalendarGenerator\Domain\Collection\CalendarEventCollection;
use Services\CalendarGenerator\Domain\Collection\Interfaces\CalendarRenderableEventCollectionInterface;
use Services\CalendarGenerator\Domain\Interfaces\CalendarRenderableEventInterface;

class CalendarYearTest extends CalendarServiceTestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetCalendarForCurrentYear()
    {
        $year = date('Y');
        $calendarYear = $this->calendarService->getCalendarForYear($year);
        $this->assertInstanceOf(CalendarYearInterface::class, $calendarYear);
        $this->assertInstanceOf(CalendarMonthCollectionInterface::class, $calendarYear->getMonths());
        $this->assertEquals('year', $calendarYear->getPeriodType());
        $this->assertEquals($year, $calendarYear->getPeriodName());
        $this->assertEquals("year_{$year}", $calendarYear->getMachineName());
    }

    public function testInjectEvents()
    {
        $year = date('Y');
        $calendarYear = $this->calendarService->getCalendarForYear($year);
        $events = $this->generateTestEvents($year);

        $calendarYear->injectEvents($events);
        $this->assertInstanceOf(CalendarRenderableEventCollectionInterface::class, $calendarYear->getEvents());
        $this->assertEquals(2, $calendarYear->getEvents()->count());
        foreach ($calendarYear->getEvents() as $event) {
            $this->assertInstanceOf(CalendarRenderableEventInterface::class, $event);
        }
    }

    public function testGetCalendarForFutureYear()
    {
        $year = date('Y');
        $year = $year + 20;
        $calendarYear = $this->calendarService->getCalendarForYear($year);
        $this->assertInstanceOf(CalendarYearInterface::class, $calendarYear);
        $this->assertInstanceOf(CalendarMonthCollectionInterface::class, $calendarYear->getMonths());
        $this->assertEquals('year', $calendarYear->getPeriodType());
    }
}
