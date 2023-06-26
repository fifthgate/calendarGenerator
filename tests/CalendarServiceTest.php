<?php

declare(strict_types=1);

namespace Fifthgate\CalendarGenerator\Tests;

use Fifthgate\CalendarGenerator\Service\CalendarGeneratorService;

class CalendarServiceTest extends CalendarServiceTestCase
{
    public function provideFirstDayOfWeekData(): iterable {
        yield 'sunday' => [
            'dayOfWeek' => new \DateTime('2023-05-21'),
            'expectedFirstDay' => new \DateTime('2023-05-21')
        ];

        yield 'monday' => [
            'dayOfWeek' => new \DateTime('2022-12-12'),
            'expectedFirstDay' => new \DateTime('2022-12-11')
        ];

        yield 'tuesday' => [
            'dayOfWeek' => new \DateTime('2025-11-04'),
            'expectedFirstDay' => new \DateTime('2025-11-02')
        ];

        yield 'wednesday' => [
            'dayOfWeek' => new \DateTime('2023-06-07'),
            'expectedFirstDay' => new \DateTime('2023-06-04')
        ];

        yield 'thursday' => [
            'dayOfWeek' => new \DateTime('2022-06-09'),
            'expectedFirstDay' => new \DateTime('2022-06-05')
        ];

        yield 'friday' => [
            'dayOfWeek' => new \DateTime('2024-09-06'),
            'expectedFirstDay' => new \DateTime('2024-09-01')
        ];

        yield 'saturday' => [
            'dayOfWeek' => new \DateTime('2019-11-02'),
            'expectedFirstDay' => new \DateTime('2019-10-27')
        ];
    }

    /**
     * @dataProvider provideFirstDayOfWeekData
     *
     * @param \DateTimeInterface $dayOfWeek
     * @param \DateTimeInterface $expectedFirstDay
     * @return void
     */
    public function testGetFirstDayOfWeek(
        \DateTimeInterface $dayOfWeek,
        \DateTimeInterface $expectedFirstDay
    ): void {
       self::assertEquals($expectedFirstDay->format('Y-m-d'), CalendarGeneratorService::getFirstDayOfWeek($dayOfWeek)->format('Y-m-d'));
    }

    public function provideLastDayOfWeekData(): iterable {
        yield 'sunday' => [
            'dayOfWeek' => new \DateTime('2023-06-04'),
            'expectedLastDay' => new \DateTime('2023-06-10')
        ];

        yield 'monday' => [
            'dayOfWeek' => new \DateTime('2023-07-31'),
            'expectedLastDay' => new \DateTime('2023-08-05')
        ];

        yield 'tuesday' => [
            'dayOfWeek' => new \DateTime('2023-10-31'),
            'expectedLastDay' => new \DateTime('2023-11-04')
        ];

        yield 'wednesday' => [
            'dayOfWeek' => new \DateTime('2023-03-08'),
            'expectedLastDay' => new \DateTime('2023-03-11')
        ];

        yield 'thursday' => [
            'dayOfWeek' => new \DateTime('2023-02-09'),
            'expectedLastDay' => new \DateTime('2023-02-11')
        ];

        yield 'friday' => [
            'dayOfWeek' => new \DateTime('2023-05-05'),
            'expectedLastDay' => new \DateTime('2023-05-06')
        ];

        yield 'saturday' => [
            'dayOfWeek' => new \DateTime('2023-07-01'),
            'expectedLastDay' => new \DateTime('2023-07-01')
        ];

    }

    /**
     * @dataProvider provideLastDayOfWeekData
     * @param \DateTimeInterface $dayOfWeek
     * @param \DateTimeInterface $expectedLastDay
     * @return void
     */
    public function testGetLastDayOfWeek(
        \DateTimeInterface $dayOfWeek,
        \DateTimeInterface $expectedLastDay
    ): void {
        self::assertEquals($expectedLastDay->format('Y-m-d'), CalendarGeneratorService::getLastDayOfWeek($dayOfWeek)->format('Y-m-d'));
    }
}