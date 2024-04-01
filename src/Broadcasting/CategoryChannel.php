<?php

namespace TeamTeaTime\Forum\Broadcasting;

use Illuminate\Foundation\Auth\User;
use TeamTeaTime\Forum\Support\Access\CategoryAccess;

class CategoryChannel
{
    public function join(User $user, int $id): array|bool
    {
        return CategoryAccess::isAccessibleTo($user, $id);
    }
}
