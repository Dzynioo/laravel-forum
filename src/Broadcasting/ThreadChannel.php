<?php

namespace TeamTeaTime\Forum\Broadcasting;

use Illuminate\Foundation\Auth\User;
use TeamTeaTime\Forum\Models\Thread;

class ThreadChannel
{
    public function join(User $user, int $id): array|bool
    {
        $thread = Thread::find($id);
        if (!$thread->category->isAccessibleTo($user)) {
            return false;
        }

        return $user->can('view', $thread);
    }
}
