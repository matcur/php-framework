<?php

namespace App;

use App\Middlewares\EventMiddleware;
use App\Middlewares\RouteMiddleware;
use Framework\App;
use Framework\BaseMiddleware;
use Framework\FileSystem\File;
use Framework\Logging\FileLogger;
use Framework\Logging\Logger;
use Framework\Support\Collection;

class Configuration
{
    /**
     * @var Collection<BaseMiddleware>
     */
    private $middlewares;

    /**
     * @var Logger
     */
    private $logger;

    public function __construct(App $app)
    {
        $this->middlewares = new Collection([
            new EventMiddleware($app),
            new RouteMiddleware($app),
        ]);
        $this->logger = new FileLogger(
            new File($_SERVER['DOCUMENT_ROOT'] . '/../private/log/today.txt')
        );
    }

    public function getLogger()
    {
        return $this->logger;
    }

    public function seedMiddlewares()
    {
        $this->middlewares->foreach(function (BaseMiddleware $middleware) {
            $middleware->handle();
        });
    }
}