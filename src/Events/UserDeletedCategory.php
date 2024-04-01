<?php

namespace TeamTeaTime\Forum\Events;

use TeamTeaTime\Forum\Events\Types\CategoryEvent;

class UserDeletedCategory extends CategoryEvent
{
    public function broadcastAs(): string
    {
        return 'user-deleted-category';
    }
}
