<?php

namespace App;

use App\ServiceProviders\EventServiceProvider;
use App\ServiceProviders\RouteServiceProvider;
use Framework\App;
use Framework\FileSystem\TodayFile;
use Framework\ServiceProvider;
use Framework\FileSystem\File;
use Framework\Logging\FileLogger;
use Framework\Logging\Logger;
use Framework\Support\Collection;

class Configuration
{
    /**
     * @var Collection<ServiceProvider>
     */
    private $serviceProviders;

    /**
     * @var Logger
     */
    private $logger;

    public function __construct(App $app)
    {
        $this->serviceProviders = new Collection([
            new EventServiceProvider($app),
            new RouteServiceProvider($app),
        ]);
        $this->logger = new FileLogger(
            new TodayFile($_SERVER['DOCUMENT_ROOT'] . '/../private/log')
        );
    }

    public function getLogger()
    {
        return $this->logger;
    }

    public function seedServiceProviders()
    {
        $this->serviceProviders->foreach(function (ServiceProvider $serviceProvider) {
            $serviceProvider->handle();
        });
    }
}