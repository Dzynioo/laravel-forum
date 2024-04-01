<?php

namespace TeamTeaTime\Forum\Events\Types;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use TeamTeaTime\Forum\Models\Post;

class PostEvent extends BaseEvent
{
    /** @var mixed */
    public $user;

    public Post $post;

    public function __construct($user, Post $post)
    {
        $this->user = $user;
        $this->post = $post;
    }

    public function broadcastOn(): Channel
    {
        $channel = "Forum.Thread.{$this->post->thread_id}";
        return new PrivateChannel($channel);
    }

    public function broadcastWith(): array
    {
        return [
            'user_id' => $this->user->id,
            'post' => $this->post
        ];
    }
}
