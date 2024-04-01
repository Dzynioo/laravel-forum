<?php

namespace TeamTeaTime\Forum\Events;

use TeamTeaTime\Forum\Events\Types\CategoryEvent;

class UserEditingCategory extends CategoryEvent
{
    public function broadcastAs(): string
    {
        return 'user-editing-category';
    }
}
