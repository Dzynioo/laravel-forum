<?php

namespace TeamTeaTime\Forum\Events;

use TeamTeaTime\Forum\Events\Types\CollectionEvent;

class UserViewingUnread extends CollectionEvent
{
    public function broadcastAs(): string
    {
        return 'user-viewing-unread';
    }
}
