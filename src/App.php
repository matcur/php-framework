<?php

namespace Framework;

use Framework\Controller\Action;
use Framework\Request\Request;
use Framework\Routing\Router;

class App
{
    const CONTROLLERS_NAMESPACE = 'Blog\\Controllers\\';

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
        $actionResult = (new Action($route))->execute();

        echo $actionResult;
    }
}