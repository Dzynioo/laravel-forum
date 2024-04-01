<?php

namespace TeamTeaTime\Forum\Events;

use Illuminate\Contracts\Events\ShouldDispatchAfterCommit;
use TeamTeaTime\Forum\Events\Types\CollectionEvent;

class UserBulkDeletedPosts extends CollectionEvent implements ShouldDispatchAfterCommit
{
}
