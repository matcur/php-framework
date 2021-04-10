<?php

namespace Framework\Events;

interface Subscriber
{
    public function act(...$parameters);
}