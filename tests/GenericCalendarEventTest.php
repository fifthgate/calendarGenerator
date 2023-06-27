<?php

namespace Fifthgate\CalendarGenerator\Tests;

use Fifthgate\CalendarGenerator\Tests\CalendarServiceTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Fifthgate\CalendarGenerator\Domain\GenericCalendarEvent;
use \DateTimeInterface;

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
