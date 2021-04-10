<?php

namespace Framework;

use Framework\Routing\Route;

abstract class BaseMiddleware
{
    /**
     * @var App
     */
    protected $app;

    public function __construct(App $app)
    {
        $this->app = $app;
    }

    public abstract function handle();
}