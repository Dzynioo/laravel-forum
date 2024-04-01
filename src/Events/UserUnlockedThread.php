<?php

namespace TeamTeaTime\Forum\Events;

use TeamTeaTime\Forum\Events\Types\ThreadEvent;

class UserUnlockedThread extends ThreadEvent
{
    public function broadcastAs(): string
    {
        return 'user-unlocked-thread';
    }
}
