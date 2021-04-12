<?php

namespace Framework\Controller;

use Framework\App;
use Framework\DependencyContainer;

abstract class BaseController
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
}