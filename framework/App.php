<?php

namespace Framework;

use App\Configuration;
use Framework\Routing\Action;
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
     * @var Configuration
     */
    private $configuration;

    /**
     * @var DependencyContainer
     */
    private $dependencyContainer;

    public function __construct(Router $router, Request $request)
    {
        $this->router = $router;
        $this->request = $request;
        $this->dependencyContainer = new DependencyContainer();
        $this->configuration = new Configuration($this);
    }

    public function getDependencyContainer(): DependencyContainer
    {
        return $this->dependencyContainer;
    }

    public function run()
    {
        $this->initDependencies();

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
        $this->configuration->seedServiceProviders();
    }

    private function initDependencies()
    {
        $dependencies = $this->dependencyContainer;
        $dependencies->addSingleton('event-dispatcher', function () {
            return new Dispatcher();
        });
        $dependencies->addSingleton('request', function () {
            return $this->request;
        });
        $dependencies->addSingleton('configuration', function () {
            return $this->configuration;
        });
    }
}