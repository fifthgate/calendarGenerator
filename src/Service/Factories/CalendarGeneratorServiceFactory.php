<?php

namespace Fifthgate\CalendarGenerator\Service\Factories;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Foundation\Application as ApplicationContract;
use Fifthgate\CalendarGenerator\Service\CalendarGeneratorService;

class CalendarGeneratorServiceFactory
{
    private const CACHEKEY = 'calendar_service_years_cache';

    private const DATEFORMAT = 'Y-m-d H:i:s';

    private ApplicationContract $app;

    public function __construct(ApplicationContract $app)
    {
        $this->app = $app;
    }

    public function __invoke(bool $testMode = false): CalendarGeneratorService
    {
        $years = Cache::get(self::CACHEKEY);
        /**
         * Rebuild the index if there isn't a cached version available.
         */
        if (!$years or $testMode) {
            $date = new \DateTime();
            Log::info(sprintf("CalendarYear cache rebuilt at %s", $date->format(self::DATEFORMAT)));

            $years = [];
            $currentYear = $date->format('Y');
            
            //Generate Calendars for previous and future years.
            for ($year = $currentYear-3; $year <= ($currentYear + 3); $year++) {
                $years[$year] = CalendarGeneratorService::generateCalendarYear($year);
            }
            Cache::set(self::CACHEKEY, $years);
        }

        return new CalendarGeneratorService($years);
    }
}
