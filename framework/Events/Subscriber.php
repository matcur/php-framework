<?php

namespace Framework\Events;

use Framework\App;

abstract class Subscriber
{
    /**
     * @var App
     */
    protected $app;

    public function __construct(App $app)
    {
        $this->app = $app;
    }

    public abstract function act(Event $event);
}