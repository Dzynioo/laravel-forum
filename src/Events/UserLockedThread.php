<?php

namespace TeamTeaTime\Forum\Events;

use TeamTeaTime\Forum\Events\Types\ThreadEvent;

class UserLockedThread extends ThreadEvent
{
    public function broadcastAs(): string
    {
        return 'user-locked-thread';
    }
}
