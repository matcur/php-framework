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

    /**
     * Route constructor.
     * @param string $controller
     * @param string $action
     * @param array $parameters
     */
    public function __construct($controller, $action, $parameters)
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
}