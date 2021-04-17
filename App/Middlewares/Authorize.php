<?php

namespace App\Middlewares;

use Framework\Routing\Middleware\Middleware;

class Authorize extends Middleware
{
    public function handle()
    {
        if (rand(0, 3) > 1)
            throw new \Exception();

        $this->runNext();
    }
}