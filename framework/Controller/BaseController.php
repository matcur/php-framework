<?php

namespace Framework\Controller;

use Framework\App;

abstract class BaseController
{
    /**
     * @var App
     */
    protected $app;

    public function __construct(App $app)
    {
        $this->app = $app;
    }
}