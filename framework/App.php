<?php

namespace Framework;

use App\Configuration;
use App\Middlewares\EventMiddleware;
use Framework\ActionResults\ActionResult;
use Framework\Controller\Action;
use Framework\Events\Dispatcher;
use Framework\Request\Request;
use Framework\Routing\Route;
use Framework\Routing\Router;

class App
{
    /**
     * @var Router
     */
    private $router;

    /**
     * @var Request
     */
    private $request;

    /**
     * @var Dispatcher
     */
    private $eventDispatcher;

    /**
     * @var Configuration
     */
    private $configuration;

    public function __construct(Router $router, Request $request)
    {
        $this->router = $router;
        $this->request = $request;
        $this->eventDispatcher = new Dispatcher();
        $this->configuration = new Configuration($this);
    }

    public function getEventDispatcher(): Dispatcher
    {
        return $this->eventDispatcher;
    }

    public function run()
    {
        $route = $this->router->resolveCurrentRoute();
        $this->request->setCurrentRoute($route);

        $this->bootstrapConfiguration();
        $this->executeTargetAction($route);
    }

    private function executeTargetAction(Route $route)
    {
        $actionResult = (new Action($route, $this))->execute();
        $actionResult->execute();
    }

    private function bootstrapConfiguration()
    {
        $this->configuration->seedMiddlewares();
    }
}