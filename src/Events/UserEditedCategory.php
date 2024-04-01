<?php

namespace TeamTeaTime\Forum\Events;

use Illuminate\Contracts\Events\ShouldDispatchAfterCommit;
use TeamTeaTime\Forum\Events\Types\CategoryEvent;

class UserEditedCategory extends CategoryEvent implements ShouldDispatchAfterCommit
{
    public function broadcastAs(): string
    {
        return 'user-edited-category';
    }
}
