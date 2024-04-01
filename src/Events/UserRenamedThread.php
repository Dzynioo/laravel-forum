<?php

namespace TeamTeaTime\Forum\Events;

use TeamTeaTime\Forum\Events\Types\ThreadEvent;

class UserRenamedThread extends ThreadEvent
{
    public function broadcastAs(): string
    {
        return 'user-renamed-thread';
    }
}
