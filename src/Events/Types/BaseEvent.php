<?php

namespace TeamTeaTime\Forum\Events\Types;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;

class BaseEvent implements ShouldBroadcast
{
    use Dispatchable;

    public function broadcastOn(): Channel
    {
        return new PrivateChannel("Forum");
    }
}
