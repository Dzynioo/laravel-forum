<?php

namespace TeamTeaTime\Forum\Events;

use TeamTeaTime\Forum\Events\Types\CategoryEvent;

class UserCreatingThread extends CategoryEvent
{
    public function broadcastAs(): string
    {
        return 'user-creating-thread';
    }
}
