<?php

namespace Framework\Routing\Middleware;

use Framework\Support\Collection;

class Chain
{
    /**
     * @var Collection<Middleware>
     */
    private $middlewares;

    public function __construct($middlewares)
    {
        $this->middlewares = new Collection($middlewares);
    }

    public function seed()
    {
        if ($this->middlewares->count() == 0)
            return;

        $this->initialize();

        $this->middlewares[0]->handle();
    }

    private function initialize()
    {
        $middlewares = $this->middlewares;
        for ($i = 0; $i < $middlewares->count(); $i++) {
            /** @var Middleware $next */
            $next = $middlewares[$i + 1];
            $middlewares[$i]->setNext($next);
        }
    }
}