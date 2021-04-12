<?php

namespace Framework;

abstract class ServiceProvider
{
    /**
     * @var App
     */
    protected $app;

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
}