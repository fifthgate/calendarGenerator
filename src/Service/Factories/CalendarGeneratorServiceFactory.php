<?php

namespace Fifthgate\CalendarGenerator\Service\Factories;

use Fifthgate\CalendarGenerator\Service\Factories\Exceptions\CalendarCacheNotPresentException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Foundation\Application as ApplicationContract;
use Fifthgate\CalendarGenerator\Service\CalendarGeneratorService;

class CalendarGeneratorServiceFactory
{
    public const CALENDAR_SERVICE_YEARS_CACHE = 'calendar_service_years_cache';

    public const CALENDAR_SERVICE_DATE_FORMAT = 'Y-m-d H:i:s';

    private ApplicationContract $app;

    public function __construct(ApplicationContract $app)
    {
        $this->app = $app;
    }

    /**
     * @throws CalendarCacheNotPresentException
     */
    public function __invoke(bool $testMode = false): CalendarGeneratorService
    {
        $years = Cache::get(self::CALENDAR_SERVICE_YEARS_CACHE);
        /**
         * Rebuild the index if there isn't a cached version available.
         */
        if (!$years) {
            throw new CalendarCacheNotPresentException();
        }

        return new CalendarGeneratorService($years);
    }
}
