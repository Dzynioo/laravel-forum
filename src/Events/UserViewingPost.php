<?php

namespace TeamTeaTime\Forum\Events;

use TeamTeaTime\Forum\Events\Types\PostEvent;

class UserViewingPost extends PostEvent
{
    public function broadcastAs(): string
    {
        return 'user-viewing-post';
    }
}
