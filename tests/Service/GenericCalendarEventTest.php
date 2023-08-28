<?php

namespace Fifthgate\CalendarGenerator\Tests\Service;

use DateTimeInterface;
use Fifthgate\CalendarGenerator\Domain\GenericCalendarEvent;

class GenericCalendarEventTest extends CalendarServiceTestCase
{
    public function testGenericCalendarEvent()
    {
        $testTitle = "Test Title";
        $testBody = "Test Body";
        $testStartDate = new \DateTime("2020-12-01");
        $testEndDate = new \DateTime("2020-12-12");
        $trimmedBody = strip_tags(substr($testBody, 0, 200)).'...';

        $genericCalendarEvent = new GenericCalendarEvent(
            $testTitle,
            $testBody,
            $testStartDate,
            $testEndDate
        );

        $this->assertEquals($testTitle, $genericCalendarEvent->getTitle());
        $this->assertEquals($testBody, $genericCalendarEvent->getBody());
        $this->assertEquals($testStartDate, $genericCalendarEvent->getStartDate());
        $this->assertEquals($testEndDate, $genericCalendarEvent->getEndDate());
        $this->assertInstanceOf(DateTimeInterface::class, $genericCalendarEvent->getStartDate());
        $this->assertInstanceOf(DateTimeInterface::class, $genericCalendarEvent->getEndDate());
    }
}
