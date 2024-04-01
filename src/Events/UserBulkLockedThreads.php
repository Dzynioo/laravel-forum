<?php

namespace TeamTeaTime\Forum\Events;

use TeamTeaTime\Forum\Events\Types\CollectionEvent;

class UserBulkLockedThreads extends CollectionEvent
{
    public function broadcastAs(): string
    {
        return 'user-bulk-locked-threads';
    }
}
