<?php

namespace App\Middlewares;

use Framework\Routing\Middleware\Middleware;

class SomeShit extends Middleware
{
    public function handle()
    {
        echo 'fuck you bitch';

        $this->runNext();
    }
}