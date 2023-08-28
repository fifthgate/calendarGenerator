<?php

declare(strict_types=1);

namespace Tests\Console;

use Fifthgate\CalendarGenerator\CalendarGeneratorServiceProvider;
use Fifthgate\CalendarGenerator\Service\Factories\CalendarGeneratorServiceFactory;
use Orchestra\Testbench\TestCase;

class GenerateCalendarCacheCommandTest extends TestCase
{
    public function testGenerateCalendarCacheCommand(): void {
        $date = new \DateTime();
        $year = (int) $date->format('Y');
        $this->artisan('calendarservice:generateyear')
            ->expectsOutput(sprintf("CalendarYear cache rebuilding at %s", $date->format(CalendarGeneratorServiceFactory::CALENDAR_SERVICE_DATE_FORMAT)))
            ->expectsOutput(sprintf("Generating cache for year %d", $year-1))
            ->expectsOutput(sprintf("Generating cache for year %d", $year))
            ->expectsOutput(sprintf("Generating cache for year %d", $year+1))
            ->assertExitCode(0);
    }


    protected function getPackageProviders($app)
    {
        return [CalendarGeneratorServiceProvider::class];
    }
}
