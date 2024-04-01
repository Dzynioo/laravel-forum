<?php

namespace TeamTeaTime\Forum\Events;

use TeamTeaTime\Forum\Events\Types\CollectionEvent;

class UserBulkRestoredThreads extends CollectionEvent
{
    public function broadcastAs(): string
    {
        return 'user-bulk-restored-threads';
    }
}
