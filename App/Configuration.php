<?php

namespace App;

use App\Middlewares\EventMiddleware;
use App\Middlewares\RouteMiddleware;
use Framework\App;
use Framework\BaseMiddleware;
use Framework\Support\Collection;

class Configuration
{
    /**
     * @var Collection<BaseMiddleware>
     */
    private $middlewares;

    public function __construct(App $app)
    {
        $this->middlewares = new Collection([
            new EventMiddleware($app),
            new RouteMiddleware($app),
        ]);
    }

    public function seedMiddlewares()
    {
        $this->middlewares->foreach(function (BaseMiddleware $middleware) {
            $middleware->handle();
        });
    }
}