<?php

namespace TeamTeaTime\Forum\Events;

use TeamTeaTime\Forum\Events\Types\ThreadEvent;

class UserCreatedThread extends ThreadEvent
{
    public function broadcastAs(): string
    {
        return 'user-created-thread';
    }
}
