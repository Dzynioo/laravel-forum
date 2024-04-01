<?php

namespace TeamTeaTime\Forum\Events;

use TeamTeaTime\Forum\Events\Types\ThreadEvent;

class UserDeletedThread extends ThreadEvent
{
    public function broadcastAs(): string
    {
        return 'user-deleted-thread';
    }
}
