<?php

namespace TeamTeaTime\Forum\Events;

use TeamTeaTime\Forum\Events\Types\CollectionEvent;

class UserBulkRestoredPosts extends CollectionEvent
{
    public function broadcastAs(): string
    {
        return 'user-bulk-restored-posts';
    }
}
