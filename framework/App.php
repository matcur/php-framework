<?php

namespace Framework;

use Framework\ActionResults\ActionResult;
use Framework\Controller\Action;
use Framework\Request\Request;
use Framework\Routing\Route;
use Framework\Routing\Router;

class App
{
    const CONTROLLERS_NAMESPACE = 'App\\Controllers\\';

    /**
     * @var Router
     */
    private $router;

    /**
     * @var Request
     */
    private $request;

    public function __construct(Router $router, Request $request)
    {
        $this->router = $router;
        $this->request = $request;
    }

    public function run()
    {
        $route = $this->router->resolveCurrentRoute();
        $this->executeTargetAction($route);

    }

    private function executeTargetAction(Route $route)
    {
        $actionResult = (new Action($route, $this))->execute();
        $actionResult->execute();
    }
}