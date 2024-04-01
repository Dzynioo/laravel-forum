<?php

namespace TeamTeaTime\Forum\Events;

use TeamTeaTime\Forum\Events\Types\CollectionEvent;

class UserBulkUnpinnedThreads extends CollectionEvent
{
    public function broadcastAs(): string
    {
        return 'user-bulk-unpinned-threads';
    }
}
