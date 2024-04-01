<?php

namespace TeamTeaTime\Forum\Events;

use TeamTeaTime\Forum\Events\Types\PostEvent;

class UserRestoredPost extends PostEvent
{
    public function broadcastAs(): string
    {
        return 'user-restored-post';
    }
}
