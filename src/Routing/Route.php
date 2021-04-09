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
        return $this->controller;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function getParameters()
    {
        return $this->parameters;
    }
}