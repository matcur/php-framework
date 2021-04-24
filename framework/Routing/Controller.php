<?php

namespace Framework\Routing;

use Framework\App;
use Framework\DependencyContainer;
use Framework\Routing\Middleware\Chain;
use Framework\Routing\Middleware\Middleware;
use Framework\Support\Collection;

abstract class Controller
{
    /**
     * @var App
     */
    protected $app;

    /**
     * @var DependencyContainer
     */
    protected $dependencies;

    /**
     * @var Collection<string, Middleware[]>
     */
    protected $middlewares;

    /**
     * @var Collection<Middleware>
     */
    private $globalMiddlewares;

    public function __construct(App $app)
    {
        $this->app = $app;
        $this->dependencies = $app->getDependencyContainer();
        $this->middlewares = new Collection();
        $this->globalMiddlewares = $this->dependencies
            ->resolve('configuration')
            ->globalMiddlewares;
    }

    public function seedMiddlewares(string $action)
    {
        $this->seedGlobalMiddlewares();
        $this->seedOwnMiddlewares($action);
    }

    private function seedGlobalMiddlewares()
    {
        (new Chain($this->globalMiddlewares))->seed();
    }

    private function seedOwnMiddlewares(string $action)
    {
        $middlewares = $this->middlewares;
        if ($middlewares->hasKey('*'))
            (new Chain($middlewares->get('*')))->seed();

        if ($middlewares->hasKey($action))
            (new Chain($middlewares->get($action)))->seed();
    }
}