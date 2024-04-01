<?php

namespace TeamTeaTime\Forum\Events;

use TeamTeaTime\Forum\Events\Types\PostEvent;

class UserEditingPost extends PostEvent
{
    public function broadcastAs(): string
    {
        return 'user-editing-category';
    }
}
