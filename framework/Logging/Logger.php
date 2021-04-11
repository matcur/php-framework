<?php

namespace Framework\Logging;

interface Logger
{
    public function warning(string $message);

    public function info(string $message);

    public function error(string $message);

    public function critical(string $message);
}