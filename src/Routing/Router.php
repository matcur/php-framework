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
            $this->request->get('controller', ''),
            $this->request->get('action', ''),
            $this->resolveCurrentParameters()
        );
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