<?php

namespace Framework\Controller;

use Framework\App;
use Framework\Routing\Route;

class Action
{
    /**
     * @var Route
     */
    private $route;

    public function __construct(Route $route)
    {
        $this->route = $route;
    }

    public function execute()
    {
        $route = $this->route;
        $controller = App::CONTROLLERS_NAMESPACE . $route->getController();
        $action = $route->getAction();
        $parameters = $route->getParameters();
        
        return (new $controller)->{$action}($parameters);
    }
}