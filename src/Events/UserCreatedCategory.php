<?php

namespace TeamTeaTime\Forum\Events;

use TeamTeaTime\Forum\Events\Types\CategoryEvent;

class UserCreatedCategory extends CategoryEvent
{
    public function broadcastAs(): string
    {
        return 'user-created-category';
    }
}
