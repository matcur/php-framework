<?php

namespace framework;

use framework\ActionResults\ActionResult;
use framework\Controller\Action;
use framework\Request\Request;
use framework\Routing\Router;

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
        $this->executeTargetAction();
    }

    private function executeTargetAction()
    {
        $route = $this->router->resolveCurrentRoute();
        /** @var $actionResult ActionResult */
        $actionResult = (new Action($route))->execute();
        $actionResult->execute();
    }
}