<?php

namespace Framework\Events;

use Framework\Support\Collection;

class Dispatcher
{
    /**
     * @var Collection<string, Subscriber>
     */
    private $subscribers = [];

    public function subscribe(string $eventName, Subscriber $handler)
    {
        $this->subscribers->put($eventName, $handler);
    }

    public function fire(string $eventName, ...$parameters)
    {
        $subscribers = $this->subscribers->get($eventName);
        $subscribers->foreach(function (Subscriber $subscriber) use ($parameters) {
            $subscriber->act(...$parameters);
        });
    }
}