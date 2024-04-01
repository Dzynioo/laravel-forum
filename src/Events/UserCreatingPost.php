<?php

namespace TeamTeaTime\Forum\Events;

use TeamTeaTime\Forum\Events\Types\ThreadEvent;

class UserCreatingPost extends ThreadEvent
{
    public function broadcastAs(): string
    {
        return 'user-creating-post';
    }
}
