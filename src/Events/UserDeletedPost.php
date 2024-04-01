<?php

namespace TeamTeaTime\Forum\Events;

use TeamTeaTime\Forum\Events\Types\PostEvent;

class UserDeletedPost extends PostEvent
{
    public function broadcastAs(): string
    {
        return 'user-deleted-post';
    }
}
