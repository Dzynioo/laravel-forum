<?php

namespace TeamTeaTime\Forum\Events\Types;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use TeamTeaTime\Forum\Models\Thread;

class ThreadEvent extends BaseEvent
{
    /** @var mixed */
    public $user;

    public Thread $thread;

    public function __construct($user, Thread $thread)
    {
        $this->user = $user;
        $this->thread = $thread;
    }

    public function broadcastOn(): Channel
    {
        $channel = "Forum.Category.{$this->thread->category_id}";
        return new PrivateChannel($channel);
    }
}
