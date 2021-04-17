<?php

namespace Framework\Routing\Middleware;

use Framework\App;
use Framework\DependencyContainer;

abstract class Middleware
{
    /**
     * @var App
     */
    protected $app;

    /**
     * @var Middleware|null
     */
    protected $next;

    /**
     * @var DependencyContainer
     */
    protected $dependencies;

    public function __construct(App $app)
    {
        $this->app = $app;
        $this->dependencies = $app->getDependencyContainer();
    }

    public abstract function handle();

    public function setNext(?Middleware $value)
    {
        $this->next = $value;
    }

    public function runNext()
    {
        if ($this->next != null)
            $this->next->handle();
    }
}