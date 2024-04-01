<?php

namespace TeamTeaTime\Forum\Events;

use TeamTeaTime\Forum\Events\Types\ThreadEvent;

class UserUnpinnedThread extends ThreadEvent
{
    public function broadcastAs(): string
    {
        return 'user-unpinned-thread';
    }
}
