<?php

namespace TeamTeaTime\Forum\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use TeamTeaTime\Forum\Interfaces\FulfillableRequest;

class RestoreThread extends FormRequest implements FulfillableRequest
{
    public function authorize(): bool
    {
        $thread = $this->route('thread');
        return $this->user()->can('restore', $thread);
    }

    public function rules(): array
    {
        return [];
    }

    public function fulfill()
    {
        $thread = $this->route('thread');
        $thread->restoreWithoutTouch();

        return $thread;
    }
}
