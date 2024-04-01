<?php

namespace TeamTeaTime\Forum\Events;

use TeamTeaTime\Forum\Events\Types\PostEvent;

class UserCreatedPost extends PostEvent
{
    public function broadcastAs(): string
    {
        return 'user-created-post';
    }
}
