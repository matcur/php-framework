<?php

namespace Framework\Events;

use Framework\Support\Collection;

class EventBus
{
    /**
     * @var Collection<string, Subscriber>
     */
    private $subscribers;

    public function __construct()
    {
        $this->subscribers = new Collection();
    }

    public function subscribe(string $eventName, Subscriber $subscriber)
    {
        $this->subscribers->push($subscriber, $eventName);
    }

    public function fire(Event $event)
    {
        $subscribers = $this->subscribers->get($event->getName());
        $subscribers->foreach(function (Subscriber $subscriber) use ($event) {
            $subscriber->act($event);
        });
    }
}