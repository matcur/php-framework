<?php

namespace Framework\Routing;

class Router
{
    public function resolveCurrentRoute()
    {
        return new Route(
            $this->resolveCurrentController(),
            $this->resolveCurrentAction(),
            $this->resolveCurrentParameters()
        );
    }

    private function resolveCurrentController()
    {
        $controllerName = $_GET['controller'];
        if ($controllerName != '')
            $controllerName = ucfirst($controllerName) . 'Controller';

        return $controllerName;
    }

    private function resolveCurrentAction()
    {
        $actionName = $_GET['action'];
        if ($actionName != '')
            $actionName = 'action' . ucfirst($actionName);

        return $actionName;
    }

    private function resolveCurrentParameters()
    {
        $result = [];
        $keys = array_diff(array_keys($_GET), ['action', 'controller']);
        foreach ($keys as $key)
            $result[$key] = $_GET[$key];

        return $result;
    }
}