<?php

namespace App\Middlewares;

use App\Subscribers\UserInSubscriber;
use Framework\App;
use Framework\BaseMiddleware;
use Framework\Events\Subscriber;
use Framework\Support\Collection;

class EventMiddleware extends BaseMiddleware
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
        $dispatcher = $this->app->getEventDispatcher();
        $this->subscribers->foreach(function (Subscriber $subscriber, $key) use ($dispatcher) {
             $dispatcher->subscribe($key, $subscriber);
        });
    }
}