<?php

namespace TeamTeaTime\Forum\Events;

use TeamTeaTime\Forum\Events\Types\CategoryEvent;

class UserEditedCategory extends CategoryEvent
{
    public function broadcastAs(): string
    {
        return 'user-edited-category';
    }
}
