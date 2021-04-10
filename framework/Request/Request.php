<?php

namespace Framework\Request;

use Framework\Routing\Route;

class Request
{
    /**
     * @var InputBag
     */
    private $query;

    /**
     * @var InputBag
     */
    private $post;

    /**
     * @var InputBag
     */
    private $server;

    /**
     * @var Route
     */
    private $currentRoute;

    public function __construct(InputBag $query, InputBag $post, InputBag $server)
    {
        $this->query = $query;
        $this->post = $post;
        $this->server = $server;
    }

    public function setCurrentRoute(Route $route)
    {
        $this->currentRoute = $route;

        return $this;
    }

    public function get($key, $default = null)
    {
        if ($result = $this->query->get($key))
            return $result;

        if ($result = $this->post->get($key))
            return $result;

        return $default;
    }

    public function getMethod()
    {
        return $this->server->get('REQUEST_METHOD', 'GET');
    }
}