<?php

namespace TeamTeaTime\Forum\Events;

use TeamTeaTime\Forum\Events\Types\CategoryEvent;

class UserViewingCategory extends CategoryEvent
{
    public function broadcastAs(): string
    {
        return 'user-viewing-category';
    }
}
