<?php

namespace App;

use App\Middlewares\Authorize;
use App\ServiceProviders\AppServiceProvider;
use App\ServiceProviders\EventServiceProvider;
use App\ServiceProviders\RouteServiceProvider;
use Framework\App;
use Framework\Routing\Middleware\Middleware;
use Framework\ServiceProvider;
use Framework\Support\Collection;

class Configuration
{
    /**
     * @var Collection<Middleware>
     */
    public $globalMiddlewares;

    /**
     * @var Collection<ServiceProvider>
     */
    private $serviceProviders;

    public function __construct(App $app)
    {
        $this->serviceProviders = new Collection([
            new AppServiceProvider($app),
            new EventServiceProvider($app),
            new RouteServiceProvider($app),
        ]);
        $this->globalMiddlewares = new Collection([
        ]);
    }

    public function seedServiceProviders()
    {
        $this->serviceProviders->foreach(function (ServiceProvider $serviceProvider) {
            $serviceProvider->handle();
        });
    }
}