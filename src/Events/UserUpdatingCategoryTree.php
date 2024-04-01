<?php

namespace TeamTeaTime\Forum\Events;

use TeamTeaTime\Forum\Events\Types\BaseEvent;

class UserUpdatingCategoryTree extends BaseEvent
{
    /** @var mixed */
    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function broadcastAs(): string
    {
        return 'user-updating-category-tree';
    }
}
