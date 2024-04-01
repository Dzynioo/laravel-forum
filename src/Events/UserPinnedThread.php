<?php

namespace TeamTeaTime\Forum\Events;

use TeamTeaTime\Forum\Events\Types\ThreadEvent;

class UserPinnedThread extends ThreadEvent
{
    public function broadcastAs(): string
    {
        return 'user-pinned-thread';
    }
}
