<?php

namespace Framework\Controller;

use Framework\ActionResults\ActionResult;
use Framework\App;
use Framework\Routing\Route;

class Action
{
    /**
     * @var Route
     */
    private $route;

    /**
     * @var App
     */
    private $app;

    public function __construct(Route $route, App $app)
    {
        $this->route = $route;
        $this->app = $app;
    }

    public function execute(): ActionResult
    {
        $route = $this->route;
        $controller = App::CONTROLLERS_NAMESPACE . $route->getController();
        $action = $route->getAction();
        $parameters = $route->getParameters();
        
        return (new $controller($this->app))->{$action}($parameters);
    }
}