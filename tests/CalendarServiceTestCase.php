<?php

namespace Fifthgate\CalendarGenerator\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use Fifthgate\CalendarGenerator\CalendarGeneratorServiceProvider;
use Fifthgate\CalendarGenerator\Service\Interfaces\CalendarGeneratorServiceInterface;
use Fifthgate\CalendarGenerator\Domain\Collection\CalendarEventCollection;
use Fifthgate\CalendarGenerator\Domain\GenericCalendarEvent;
use Fifthgate\CalendarGenerator\Domain\Collection\Interfaces\CalendarRenderableEventCollectionInterface;

class CalendarServiceTestCase extends BaseTestCase
{
    protected $calendarService;

    protected function generateTestEvents(int $year) : CalendarRenderableEventCollectionInterface
    {
        $eventCollection = new CalendarEventCollection;
        $testData = [
            [
                'title' => 'Event 1',
                'body' => '<p>Lorem Ipsum Dolor sit amet</p>',
                'startDate' => '01-01-'.$year,
                'endDate' => '02-01-'.$year
            ],
            [
                'title' => 'Event 2',
                'body' => '<p>Lorem Ipsum Dolor sit amet</p>',
                'startDate' => '12-12-'.$year,
                'endDate' => '21-12-'.$year
            ],
        ];

        foreach ($testData as $testDatum) {
            $eventCollection->add(new GenericCalendarEvent(
                $testDatum['title'],
                $testDatum['body'],
                new \DateTime($testDatum['startDate']),
                new \DateTime($testDatum['endDate'])
            ));
        }
        return $eventCollection;
    }

    public $baseUrl = 'http://localhost';

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('key', 'base64:j84cxCjod/fon4Ks52qdMKiJXOrO5OSDBpXjVUMz61s=');
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }

    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        
        parent::setUp();
        $this->loadLaravelMigrations();
        $this->calendarService = $this->app->get(CalendarGeneratorServiceInterface::class);
    }

    protected function getPackageProviders($app)
    {
        return [CalendarGeneratorServiceProvider::class];
    }
}
