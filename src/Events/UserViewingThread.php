<?php

namespace TeamTeaTime\Forum\Events;

use TeamTeaTime\Forum\Events\Types\ThreadEvent;

class UserViewingThread extends ThreadEvent
{
    public function broadcastAs(): string
    {
        return 'user-viewing-thread';
    }
}
