<?php

namespace App\ServiceProviders;

use App\Subscribers\UserInSubscriber;
use Framework\App;
use Framework\Events\EventBus;
use Framework\ServiceProvider;
use Framework\Events\Subscriber;
use Framework\Support\Collection;

class EventServiceProvider extends ServiceProvider
{
    /**
     * @var Collection<string, Subscriber>
     */
    private $subscribers;

    public function __construct(App $app)
    {
        parent::__construct($app);

        $this->subscribers = new Collection([
            'user-in' => new UserInSubscriber($app),
        ]);
    }

    public function handle()
    {
        $this->passSubscribers();
    }

    private function passSubscribers()
    {
        /** @var EventBus $dispatcher */
        $dispatcher = $this->dependencies->resolve('event-dispatcher');
        $this->subscribers->foreach(function (Subscriber $subscriber, $key) use ($dispatcher) {
             $dispatcher->subscribe($key, $subscriber);
        });
    }
}