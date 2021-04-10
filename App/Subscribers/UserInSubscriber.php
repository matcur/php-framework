<?php

namespace App\Subscribers;

use App\Models\User;
use Framework\Events\Event;
use Framework\Events\Subscriber;

class UserInSubscriber extends Subscriber
{
    public function act(Event $event)
    {
        /** @var User $user */
        $user = $event->getArguments();

        echo $user->name;
    }
}