<?php

namespace TeamTeaTime\Forum\Events;

use TeamTeaTime\Forum\Events\Types\CollectionEvent;

class UserBulkUnlockedThreads extends CollectionEvent
{
    public function broadcastAs(): string
    {
        return 'user-bulk-unlocked-threads';
    }
}
