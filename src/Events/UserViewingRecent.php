<?php

namespace TeamTeaTime\Forum\Events;

use TeamTeaTime\Forum\Events\Types\CollectionEvent;

class UserViewingRecent extends CollectionEvent
{
    public function broadcastAs(): string
    {
        return 'user-viewing-recent';
    }
}
