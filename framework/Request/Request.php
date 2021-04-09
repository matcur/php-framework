<?php

namespace framework\Request;

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

    public function __construct(InputBag $query, InputBag $post, InputBag $server)
    {
        $this->query = $query;
        $this->post = $post;
        $this->server = $server;
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