<?php

namespace Framework\Routing;

class Route
{
    /**
     * @var string
     */
    private $controller;

    /**
     * @var string
     */
    private $action;

    /**
     * @var array
     */
    private $parameters;

    public function __construct(string $controller, string $action, array $parameters)
    {
        $this->controller = $controller;
        $this->action = $action;
        $this->parameters = $parameters;
    }

    public function getController()
    {
        $controllerName = $this->controller;
        if ($controllerName != '')
            $controllerName = ucfirst($controllerName) . 'Controller';

        return $controllerName;
    }

    public function getAction()
    {
        $actionName = $this->action;
        if ($actionName != '')
            $actionName = 'action' . ucfirst($actionName);

        return $actionName;
    }

    public function getParameters()
    {
        return $this->parameters;
    }

    public function getClearAction()
    {
        return $this->action;
    }
}