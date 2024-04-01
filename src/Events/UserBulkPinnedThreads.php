<?php

namespace TeamTeaTime\Forum\Events;

use TeamTeaTime\Forum\Events\Types\CollectionEvent;

class UserBulkPinnedThreads extends CollectionEvent
{
    public function broadcastAs(): string
    {
        return 'user-bulk-pinned-threads';
    }
}
