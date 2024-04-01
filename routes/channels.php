<?php

use Illuminate\Support\Facades\Broadcast;
use TeamTeaTime\Forum\Broadcasting\CategoryChannel;
use TeamTeaTime\Forum\Broadcasting\ThreadChannel;

Broadcast::channel('Forum.Category.{id}', CategoryChannel::class);
Broadcast::channel('Forum.Thread.{id}', ThreadChannel::class);
