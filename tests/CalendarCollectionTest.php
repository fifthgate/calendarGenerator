<?php

namespace Tests\Feature\Calendar;

use Fifthgate\CalendarGenerator\Tests\CalendarServiceTestCase;
use Fifthgate\CalendarGenerator\Domain\Collection\AbstractCollection;

class CalendarCollectionTest extends CalendarServiceTestCase
{
    protected $calendarYear;

    public function setUp() : void
    {
        parent::setUp();
        $year = date('Y');
        $this->calendarYear = $this->calendarService->getCalendarForYear($year);
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCollection()
    {
        $collection = $this->calendarYear->getMonths();
        $this->assertEquals(0, $collection->key());
        $this->assertFalse($collection->isEmpty());
        $cutCollection = clone $collection;
        $cutCollection->delete(1);
        $this->assertEquals(11, $cutCollection->count());
        $this->assertFalse($cutCollection->delete(999));
        $cutCollection->flush();
        $this->assertTrue($cutCollection->isEmpty());
    }

    public function testArrayConstruction(): void {
        $items = [
            'a',
            'b',
            'c'
        ];
        $testClass = new class($items) extends AbstractCollection {};
        self::assertEquals($items, $testClass->toArray());
    }
}
