<?php

namespace Framework\Routing;

use App\ServiceProviders\RouteServiceProvider;
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
        $controller = $this->makeController();
        $controller->seedMiddlewares(
            $this->route->getClearAction()
        );
        
        return $this->runController($controller);
    }

    private function runController(Controller $controller)
    {
        $route = $this->route;
        $action = $route->getAction();
        $parameters = $route->getParameters();

        return $controller->{$action}($parameters);
    }

    private function makeController(): Controller
    {
        $controllerClass = RouteServiceProvider::CONTROLLER_NAMESPACE . $this->route->getController();

        return new $controllerClass($this->app);
    }
}