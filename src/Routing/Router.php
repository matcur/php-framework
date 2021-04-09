<?php

namespace Framework\Routing;

use Framework\Request\Request;

class Router
{
    /**
     * @var Request
     */
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function resolveCurrentRoute()
    {
        return new Route(
            $this->resolveCurrentController(),
            $this->resolveCurrentAction(),
            $this->resolveCurrentParameters()
        );
    }

    public function resolveCurrentController()
    {
        $controllerName = $this->request->get('controller');
        if ($controllerName != '')
            $controllerName = ucfirst($controllerName) . 'Controller';

        return $controllerName;
    }

    public function resolveCurrentAction()
    {
        $actionName = $this->request->get('action');
        if ($actionName != '')
            $actionName = 'action' . ucfirst($actionName);

        return $actionName;
    }

    public function resolveCurrentParameters()
    {
        $result = [];
        $keys = array_diff(array_keys($_GET), ['action', 'controller']);
        foreach ($keys as $key)
            $result[$key] = $_GET[$key];

        return $result;
    }
}