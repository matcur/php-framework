<?php

namespace App\ServiceProviders;

use App\Subscribers\UserInSubscriber;
use Framework\App;
use Framework\Events\Dispatcher;
use Framework\FileSystem\TodayFile;
use Framework\Logging\FileLogger;
use Framework\ServiceProvider;
use Framework\Events\Subscriber;
use Framework\Support\Collection;

class AppServiceProvider extends ServiceProvider
{
    public function handle()
    {
        $dependencies = $this->app->getDependencyContainer();
        $dependencies->addSingleton('logger', function () {
            return new FileLogger(
                new TodayFile($_SERVER['DOCUMENT_ROOT'] . '/../private/log')
            );
        });
    }
}