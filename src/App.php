<?php

namespace Framework;

use Framework\Controller\Action;
use Framework\Routing\Router;

class App
{
    const CONTROLLERS_NAMESPACE = 'Blog\\Controllers\\';

    /**
     * @var Router
     */
    private $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    public function run()
    {
        $route = $this->router->resolveCurrentRoute();
        $actionResult = (new Action($route))->execute();

        echo $actionResult;
    }
}