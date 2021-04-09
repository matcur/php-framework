<?php

namespace Framework\Request;

use Framework\Support\Arr;

class InputBag
{
    /**
     * @var array
     */
    private $parameters;

    public function __construct(array $parameters)
    {
        $this->parameters = $parameters;
    }

    public function get($key, $default = null)
    {
        $parameters = $this->parameters;

        return Arr::hasKey($parameters, $key)? $parameters[$key]: $default;
    }
}