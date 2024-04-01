<?php

namespace TeamTeaTime\Forum\Events;

use TeamTeaTime\Forum\Events\Types\CollectionEvent;

class UserBulkDeletedPosts extends CollectionEvent
{
    public function broadcastAs(): string
    {
        return 'user-bulk-deleted-posts';
    }
}
