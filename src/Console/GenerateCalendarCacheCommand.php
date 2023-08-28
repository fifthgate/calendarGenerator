<?php

namespace Fifthgate\CalendarGenerator\Console;

use Fifthgate\CalendarGenerator\Service\Factories\CalendarGeneratorServiceFactory;
use Illuminate\Console\Command;
use Fifthgate\CalendarGenerator\Service\CalendarGeneratorService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
class GenerateCalendarCacheCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'calendarservice:generateyear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Prepopulate the cache for a calendar service.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $date = new \DateTime();
        $this->info(sprintf("CalendarYear cache rebuilding at %s", $date->format(CalendarGeneratorServiceFactory::CALENDAR_SERVICE_DATE_FORMAT)));

        $years = [];
        $currentYear = (int) $date->format('Y');

        //Generate Calendars for previous and future years.
        for ($year = $currentYear-1; $year <= ($currentYear + 1); $year++) {
            $this->info(sprintf("Generating cache for year %d",$year));
            $years[$year] = CalendarGeneratorService::generateCalendarYear($year);
        }
        Cache::set(CalendarGeneratorServiceFactory::CALENDAR_SERVICE_YEARS_CACHE, $years);
        return 0;
    }
}
