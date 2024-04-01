<?php

namespace TeamTeaTime\Forum\Events;

use TeamTeaTime\Forum\Events\Types\PostEvent;

class UserEditedPost extends PostEvent
{
    public function broadcastAs(): string
    {
        return 'user-edited-post';
    }
}
